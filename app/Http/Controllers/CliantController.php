<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Genres;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CliantController extends Controller
{
    public function index()
    {
        $books = Books::with('user')->get();

        return view('pages.cliant.data.tables', compact('books'));
    }
    public function genre(Request $request)
    {
        $genres = Genres::all();
        $books = Books::query();

        if ($request->has('genre') && $request->genre != '') {
            $selectedGenre = $request->genre;
            $books = $books->where('genre', 'like', '%' . $selectedGenre . '%');
        }

        $books = $books->latest()->get();

        return view('pages.cliant.data.genre', compact('books', 'genres'));
    }

    public function jenis(Request $request)
    {
        $books = Books::query();

        // Check if 'jenis' is selected and filter accordingly
        if ($request->filled('jenis')) {
            $selectedJenis = $request->jenis;
            $books->where('jenis', 'like', '%' . $selectedJenis . '%');
        }

        // Retrieve the latest books
        $books = $books->latest()->get();

        return view('pages.cliant.data.jenis', compact('books'));
    }

    public function show($id)
    {
        // Mengambil data barang berdasarkan ID
        $book = Books::find($id);

        // Jika barang tidak ditemukan, bisa ditangani di sini
        if (!$book) {
            abort(404);
        }

        // Mengirimkan data barang ke view
        return view('pages.cliant.data.show', ['book' => $book]);
    }

    public function pinjam($id)
    {
        // Mengambil data barang berdasarkan ID
        $book = Books::find($id);

        // Jika barang tidak ditemukan, bisa ditangani di sini
        if (!$book) {
            abort(404);
        }

        // Mengirimkan data barang ke view
        return view('pages.cliant.data.pinjam', ['book' => $book]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_book' => 'required|exists:book,id', // Pastikan id_barang ada di tabel barangs
            'dipinjam' => 'required|integer'
        ]);


        // Simpan data ke tabel barangjuals
        Pinjam::create([
            'id_book' => $validated['id_book'],
            'dipinjam' => $validated['dipinjam'],
            'id_user' => Auth::id(),
            'status' => 'buku_di_pesan'
        ]);

        return redirect()->route('cliant.tables')->with('message', 'Order berhasil');
    }
}
