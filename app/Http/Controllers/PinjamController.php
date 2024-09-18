<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Books;
use App\Models\Genres;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PinjamController extends Controller
{
    public function index()
    {
        $pinjams = Pinjam::with('book', 'user')->get();

        return view('pages.admin.pinjam.tables', compact('pinjams'));
    }

    public function show($id)
    {
        // Mengambil data barang berdasarkan ID
        $book = Pinjam::with('user')->find($id);

        // Jika barang tidak ditemukan, bisa ditangani di sini
        if (!$book) {
            abort(404);
        }

        // Mengirimkan data barang ke view
        return view('pages.admin.pinjam.show', ['pinjam' => $book]);
    }
    public function edit($id)
    {
        // Mengambil data barang berdasarkan ID
        $book = Pinjam::find($id);

        // Jika barang tidak ditemukan, bisa ditangani di sini
        if (!$book) {
            abort(404);
        }

        // Mengirimkan data barang ke view
        return view('pages.admin.pinjam.edit', ['pinjam' => $book]);
    }
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'isbn' => 'required|string|max:255',
            'judul_buku' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'stok' => 'required|integer',
            'terpinjam' => 'required|integer',
        ]);

        $book = Pinjam::find($id);

        $sisaBuku = $request->stok - $request->terpinjam;

        if ($sisaBuku < 0) {
            return redirect()->back()->withErrors(['terpinjam' => 'Stok tidak mencukupi.'])->withInput();
        } else {
            $array = [
            'isbn' => $request->isbn,
            'judul_buku' => $request->judul_buku,
            'jenis' => $request->jenis,
            'stok' => $request->stok,
            'sinopsis' => $request->sinopsis,
            'terpinjam' => $request->terpinjam,
            'cover' => $request->cover,
            'sisa_buku' => $sisaBuku
        ];

        // Menangani upload file cover
        $coverPath = null;
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverPath = $cover->store('covers', 'public');
        }

        $book->update($array);
        }

        return redirect()->route('admin.tables')->with('success', 'Data berhasil diperbarui.');
    }

public function destroy($id)
{
    $book = Pinjam::findOrFail($id); // Temukan data barang berdasarkan ID
    $book->delete(); // Hapus data barang

    // Redirect atau tindakan lain setelah berhasil dihapus
    return redirect()->route('admin.tables')->with('success', 'Barang terhapus!');

}

    public function create()
    {
        $users = User::all();
        // Ambil semua buku yang tersedia
        $books = Books::all();

        // Kirim data buku ke tampilan
        return view('pages.admin.pinjam.create', compact('users','books'));
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'dipinjam' => 'required|integer|min:1', // Ensure 'dipinjam' is a positive integer
            'id_book' => 'required|exists:book,id', // Ensure 'id_book' exists in the books table
            'id_user' => 'required|exists:users,id',

        ]);

        // Calculate remaining stock
        // $stock = $book->stock - $validated['dipinjam'];

        // Check if stock is sufficient
        // if ($stock < 0) {
        //     return redirect()->back()->with('error', 'Stok buku tidak mencukupi');
        // }

        // Update book stock
        // $book->update(['stok' => $stock]);
        // Record the book borrowing
        pinjam::create([
            'id_book' => $validated['id_book'],
            'id_user' => $validated['id_user'],
            'dipinjam' => $validated['dipinjam'],
        ]);

        // Redirect with success message
        return redirect()->route('admin.pinjam.tables')->with('success', 'Buku berhasil dipinjam!');
    }



    // public function genre()
    // {
    //     $genres = Genres::all();
    //     return view('pages.admin.pinjam.genre');
    // }

    // public function genres(Request $request)
    // {
    //     // dd($request);
    //     // Validasi permintaan masuk
    //     $validated = $request->validate([
    //         'name' => 'required',
    //     ]);

    //     // Buat record buku baru
    //     Genres::create($validated);

    //     // Redirect dengan pesan sukses
    //     return redirect()->route('admin.pinjam.create')->with('success', 'Buku tersimpan!');
    // }
// public function search(Request $request)
//     {
//         $query = $request->input('query');

//         if ($query) {
//             $pinjam = pinjam::where('judul_buku', 'LIKE', "%$query%")
//                 ->orWhere('isbn', 'LIKE', "%$query%")
//                 ->orWhere('jenis', 'LIKE', "%$query%")
//                 ->get();
//         } else {
//             $pinjam = pinjam::all();
//         }

//         if ($request->ajax()) {
//             $view = view('partials.table', compact('pinjam'))->render();
//             $noResults = $pinjam->isEmpty();
//             return response()->json(['html' => $view, 'noResults' => $noResults]);
//         }

//         return view('pages.admin.pinjam.tables', compact('pinjam'));
//     }
public function approve($id)
{
    $pinjam = pinjam::find($id);

    if ($pinjam) {
        $pinjam->status = 'buku berhasil di pinjam'; // Ganti dengan status yang sesuai
        $pinjam->save();
        $book=Books::find($pinjam->id_book);
        $stok=$book->stok-$pinjam->dipinjam;
        if($stok < 0){
            // dd('stok tidak mencukupi');
        return redirect()->back()->with('error', 'stok book tidak mencukupi');

        }
        $book->update(['stok'=>$stok]);

        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }

}}
