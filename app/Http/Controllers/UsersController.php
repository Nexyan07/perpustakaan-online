<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $users = User::Filter(request(['keyword']))->latest()->paginate(20)->withQueryString();

        return view('admin/users', ['users' => $users, 'keyword' => $keyword]); // Kirim data ke view
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'telepon' => 'required|string|min:10|max:15|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,member'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator) // Mengirimkan error default Laravel
                ->withInput()
                ->with('status', 'error') // Menambahkan status secara khusus
                ->with('message', 'Validasi Gagal. Periksa kembali data yang Anda masukkan.');
        }
        
        try {
            // validate foto
            $foto = $request->file('foto');
            $originalName = $foto->getClientOriginalName();
            $fotoName = time() . '_' . $originalName;
            $foto->move(public_path('img/users'), $fotoName);

            User::create([
                'foto' => $fotoName,
                'name' => $request['name'],
                'address' => $request['address'],
                'telepon' => $request['telepon'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'role' => $request['role'],
            ]);
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Ditambahkan');
        } catch(\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Ditambahkan: ' . $e->getMessage());
        }
    }
    
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'telepon' => ['required','string','min:10','max:15',Rule::unique('users')->ignore($user->id)],
            'email' => ['required','string','email','max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable',
            'role' => 'required|string|in:admin,member'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator) // Mengirimkan error default Laravel
                ->withInput()
                ->with('status', 'error') // Menambahkan status secara khusus
                ->with('message', 'Validasi Gagal. Periksa kembali data yang Anda masukkan.');
        }
        
        try {
            if ($request->hasFile('foto')) {
                // hapus gambar lama
                if ($user->foto && file_exists(public_path('img/users/' . $user->foto))) {
                    unlink(public_path('img/users/' . $user->foto));
                }

                // simpan gambar baru
                $foto = $request->file('foto');
                $originalName = $foto->getClientOriginalName();
                $fotoName = time() . '_' . $originalName;
                $foto->move(public_path('img/users'), $fotoName);
                $user->foto = $fotoName; //simpan foto ke database
            } else {
                $user->foto = $user->foto;
            }

            $user->update([
                'name' => $request['name'],
                'address' => $request['address'],
                'telepon' => $request['telepon'],
                'email' => $request['email'],
                'role' => $request['role'],
            ]);

            if($request->filled('password') && $request['password'] !== Str::limit($user->password, 20, '')) {
                $user->update([
                    'password' => bcrypt($request->password)
                ]);
            }

            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Di Update');
        } catch(\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Di Update' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            // hapus img dari folder
            if($user->foto && file_exists(public_path('img/users/' . $user->foto))){
                unlink(public_path('img/users/' . $user->foto));
            }

            $user->delete();
            
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Di Hapus');
        } catch(\Exception $e){
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Di Update' . $e->getMessage());
        }
    }
}
