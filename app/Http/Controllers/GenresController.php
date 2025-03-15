<?php

namespace App\Http\Controllers;

use App\Models\Genres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenresController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $genres = Genres::Filter(request(['keyword']))->latest()->paginate(20)->withQueryString();

        return view('admin/genres', ['genres' => $genres, 'keyword' => $keyword]); // Kirim data ke view
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'color' => 'required|max:255',
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
            Genres::create([
                'name' => $request->name,
                'color' => $request->color,
            ]);
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Ditambahkan');
        } catch(\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Ditambahkan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'color'=> 'required|max:255',
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
            $validated = $validator->validated();
            $genre = Genres::findOrFail($id);

            $genre->update([
                'name' => $validated['name'],
                'color' => $validated['color'],
            ]);
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Di Update');
        } catch(\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Di Update' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $genre = Genres::findOrFail($id);
            $genre->delete();
            
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Di Hapus');
        } catch(\Exception $e){
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Di Update' . $e->getMessage());
        }
    }

}
