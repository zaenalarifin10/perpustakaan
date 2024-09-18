<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Books;
use App\Models\Genres;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;

class TablesController extends Controller
{
    public function index()
    {
        $books = Books::all();

        return view('pages.admin.book.tables', compact('books'));
    }
    public function users()
    {
        $users = User::all();

        return view('pages.admin.user', compact('users'));
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
        return view('pages.admin.book.show', ['book' => $book]);
    }
    public function edit($id)
    {
        // Mengambil data barang berdasarkan ID
        $book = Books::find($id);

        // Jika barang tidak ditemukan, bisa ditangani di sini
        if (!$book) {
            abort(404);
        }

        // Mengirimkan data barang ke view
        return view('pages.admin.book.edit', ['book' => $book]);
    }
    public function update(Request $request, $id)
    {
        // Validasi data input
        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'isbn' => 'required|string|max:255',
            'sinopsis' => 'required|string', // Validasi sinopsis jika ada
            'jenis' => 'required|string|max:255',
            'stok' => 'required|numeric',
            'terpinjam' => 'required|numeric',
            'genre' => 'array',
            'genre.*' => 'string|exists:genres,name',
        ]);

        // Cari buku berdasarkan ID
        $book = Books::find($id);

        if (!$book) {
            return redirect()->route('admin.tables')->withErrors(['book' => 'Buku tidak ditemukan.']);
        }

        // Menghitung sisa_buku
        $stok = $validated['stok'];
        $terpinjam = $validated['terpinjam'];
        $sisaBuku = $stok - $terpinjam;

        if ($sisaBuku < 0) {
            return redirect()->back()->withErrors(['terpinjam' => 'Stok tidak mencukupi.'])->withInput();
        }

        // Mengambil genre yang dipilih dan menggabungkannya menjadi string yang dipisahkan koma
        $genres = $request->input('genre', []);
        $genreString = implode(', ', $genres);

        // Update data buku
        $book->update([
            'judul_buku' => $validated['judul_buku'],
            'penulis' => $validated['penulis'],
            'penerbit' => $validated['penerbit'],
            'isbn' => $validated['isbn'],
            'sinopsis' => $validated['sinopsis'],
            'jenis' => $validated['jenis'],
            'stok' => $stok,
            'terpinjam' => $terpinjam,
            'sisa_buku' => $sisaBuku,
            'genre' => $genreString,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.tables')->with('success', 'Data berhasil diperbarui.');
    }

public function destroy($id)
{
    $book = Books::findOrFail($id); // Temukan data barang berdasarkan ID
    $book->delete(); // Hapus data barang

    // Redirect atau tindakan lain setelah berhasil dihapus
    return redirect()->route('admin.tables')->with('success', 'Barang terhapus!');

}

    public function create()
    {
        $genres = Genres::all();
        return view('pages.admin.book.create', compact('genres'));
    }

    public function store(Request $request)
    {
        // Validasi permintaan masuk
        $validated = $request->validate([
            'judul_buku' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'isbn' => 'required',
            'sinopsis' => 'required',
            'jenis' => 'required',
            'stok' => 'required|numeric',
            'terpinjam' => 'required',
            'genre' => 'array',
            'genre.*' => 'string|exists:genres,name',
            'cover' => 'nullable|mimes:png,jpg,jpeg,gif|max:2048', // Validasi file upload
        ]);

        // Menghitung sisa_buku
        $stok = $validated['stok'];
        $terpinjam = $validated['terpinjam'];
        $sisaBuku = $stok - $terpinjam;

        // Cek apakah stok cukup
        if ($sisaBuku < 0) {
            return redirect()->back()->withErrors(['terpinjam' => 'Stok tidak mencukupi.'])->withInput();
        }

        // Mengambil genre yang dipilih dan menggabungkannya menjadi string yang dipisahkan koma
        $genres = $request->input('genre', []);
        $genreString = implode(', ', $genres);

        // Menangani upload file cover
        $coverPath = null;
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverPath = $cover->store('covers', 'public');
        }

        // Tambahkan sisa_buku dan genreString ke data yang akan disimpan
        $validated['sisa_buku'] = $sisaBuku;
        $validated['genre'] = $genreString;
        $validated['cover'] = $coverPath;

        // Buat record buku baru
        Books::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.tables')->with('success', 'Buku tersimpan!');
    }
    public function genre()
    {
        $genres = Genres::all();
        return view('pages.admin.book.genre');
    }

    public function genres(Request $request)
    {
        // dd($request);
        // Validasi permintaan masuk
        $validated = $request->validate([
            'name' => 'required',
        ]);

        // Buat record buku baru
        Genres::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.book.create')->with('success', 'Buku tersimpan!');
    }
public function search(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $books = Books::where('judul_buku', 'LIKE', "%$query%")
                ->orWhere('isbn', 'LIKE', "%$query%")
                ->orWhere('jenis', 'LIKE', "%$query%")
                ->get();
        } else {
            $books = Books::all();
        }

        if ($request->ajax()) {
            $view = view('partials.table', compact('books'))->render();
            $noResults = $books->isEmpty();
            return response()->json(['html' => $view, 'noResults' => $noResults]);
        }

        return view('pages.admin.book.tables', compact('books'));
    }

    public function profile() {
        return view('pages.admin.profile');
    }    public function upload(Request $request)
    {
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $user = User::find(Auth::user()->id);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/profile_pictures', $filename);

            // Hapus foto profil lama jika ada
            if ($user->profile_picture) {
                Storage::delete('public/profile_pictures/' . $user->profile_picture);
            }

            $user->profile_picture = $filename;
            $user->update(['profile_picture'=>$filename]);

        }

        return redirect()->back()->with('success', 'Profile picture updated successfully!');
    }


}

