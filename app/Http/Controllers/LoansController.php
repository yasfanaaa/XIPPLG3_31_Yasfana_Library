<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loans;
use App\Models\User;
use App\Models\Books;

class LoansController extends Controller
{
    // Menampilkan semua data peminjaman
    public function index()
    {
        $loans = Loans::with(['user', 'book'])->get();
        return response()->json($loans);
    }

    // Menyimpan data peminjaman baru
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'loans_date' => 'required|date',
            'return_date' => 'required|date',
            'status' => 'required|string',
        ]);

        $loan = Loans::create($request->all());
        return response()->json($loan, 201);
    }

    // Menampilkan detail peminjaman tertentu
    public function show($id)
    {
        $loan = Loans::with(['user', 'book'])->findOrFail($id);
        return response()->json($loan);
    }

    // Mengupdate data peminjaman
    public function update(Request $request, $id)
    {
        $request->validate([
            'book_id' => 'sometimes|exists:books,id',
            'user_id' => 'sometimes|exists:users,id',
            'loans_date' => 'sometimes|date',
            'return_date' => 'sometimes|date',
            'status' => 'sometimes|string',
        ]);

        $loan = Loans::findOrFail($id);
        $loan->update($request->all());

        return response()->json($loan);
    }

    // Menghapus peminjaman
    public function destroy($id)
    {
        $loan = Loans::findOrFail($id);
        $loan->delete();
        return response()->json(['message' => 'Loan deleted successfully']);
    }
}
