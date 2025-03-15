<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Books;
use App\Models\Ratings;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $books = Books::all();
        $users = User::all();
        $ratings = Ratings::Filter(request(['keyword']))->latest()->paginate(20)->withQueryString();

        return view('admin.rating', ['ratings' => $ratings, 'books' => $books, 'users' => $users, 'keyword' => $keyword]);
    }

    public function store(Request $request, $book_id)
    {
        Ratings::create([
            'user_id' => Auth::id(),
            'book_id' => $book_id,
            'rating' => $request->rating,
        ]);

        $peminjam = Peminjam::where('user_id', Auth::id())->where('book_id', $book_id)->latest()->first();
        $peminjam->dirating = true;
        $peminjam->save();

        return redirect()->back()->with('status', 'success')->with('message', "Terima kasih😊");
    }

    public function destroy($id)
    {
        try {
            $rating = Ratings::findOrFail($id);
            $rating->delete();
            
            return redirect()->back()->with('status', 'success')->with('message', 'Data Berhasil Di Hapus');
        } catch(\Exception $e){
            return redirect()->back()->with('status', 'error')->with('message', 'Data Gagal Di Update' . $e->getMessage());
        }
    }
}
