<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Category;
use App\Models\User;

class BooksController extends Controller
{
    // Menampilkan semua buku
    public function index()
    {
        $books = Books::with(['user', 'category'])->get();
        return response()->json($books);
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'writer' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'publisher' => 'required|string',
            'year' => 'required|integer',
        ]);

        $book = Books::create($request->all());
        return response()->json($book, 201);
    }

    // Menampilkan detail buku tertentu
    public function show($id)
    {
        $book = Books::with(['user', 'category'])->findOrFail($id);
        return response()->json($book);
    }

    // Mengupdate buku
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|string',
            'writer' => 'sometimes|string',
            'user_id' => 'sometimes|exists:users,id',
            'category_id' => 'sometimes|exists:categories,id',
            'publisher' => 'sometimes|string',
            'year' => 'sometimes|integer',
        ]);

        $book = Books::findOrFail($id);
        $book->update($request->all());
        return response()->json($book);
    }

    // Menghapus buku
    public function destroy($id)
    {
        $book = Books::findOrFail($id);
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully']);
    }
}
