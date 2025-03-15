<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class KatalogsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $books = Books::withAvg('ratings', 'rating')->withCount('ratings')->Filter(['keyword' => $keyword])->orderBy('created_at', 'desc')->take(20)->get();
        $totalBooks = Books::Filter(['keyword' => $keyword])->count();
        $bukuYangMauDirating = Books::select('title')->get();

        return view('katalogs', ['books' => $books, 'keyword' => $keyword, 'totalBooks' => $totalBooks]);
    }

    public function loadMoreBooks(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = 20;

        $books = Books::Filter($request->only('keyword'))->orderBy('created_at', 'desc')->skip($offset)->take($limit)->get();
        $totalBooks = Books::Filter($request->only('keyword'))->count();

        $hasMore = ($offset + $limit < $totalBooks);

        // Render Partial Blade untuk setiap buku
        $html = "";
        foreach ($books as $book) {
            $html .= view('partials.book-card', compact('book'))->render();
        }

        return response()->json(['html' => $html, 'hasMore' => $hasMore]);
    }

}
