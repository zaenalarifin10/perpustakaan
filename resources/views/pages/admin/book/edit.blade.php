@extends('layouts.app')
@section('title', 'book | Edit Barang')

@section('style')
<style>
    .container {
        max-width: 600px; /* Lebar maksimum kontainer */
    }
    .form-group.row {
        margin-bottom: 20px; /* Jarak antar baris form */
    }
    .btn-primary, .btn-warning {
        width: 100px; /* Lebar tombol */
    }
    /* Stylize input fields if needed */
    .form-control {
        /* Misalnya, menambahkan border-radius */
        border-radius: 5px;
    }
    h1{
        text-align: center;
        margin-bottom: 25px;
    }
</style>
@endsection
@section('content')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

                    <!-- Page Heading -->
                    <div class="container mt-4">
                        <form action="{{ route('admin.book.update', $book->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Pastikan metode POST diubah menjadi PUT untuk update -->

                            <div class="form-group">
                                <label for="judul_buku">Judul Buku</label>
                                <input type="text" name="judul_buku" class="form-control" value="{{ old('judul_buku', $book->judul_buku) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="penulis">penulis</label>
                                <input type="text" name="penulis" class="form-control" value="{{ old('penulis', $book->penulis) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="penerbit">penerbit</label>
                                <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit', $book->penerbit) }}" required>
                            </div>

                            <!-- Input fields for ISBN, penerbit, jenis, stok, terpinjam -->
                            <div class="form-group">
                                <label for="isbn">ISBN</label>
                                <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis" class="col-sm-3 col-form-label">Jenis Buku:</label>
                                   <select name="jenis" id="jenis"class="form-control">
                                    <option {{( $book->jenis == "fiksi" ? 'selected' : "" )}} value="fiksi">Fiksi</option>
                                    <option {{( $book->jenis == "non-fiksi" ? 'selected' : "" )}} value="non-fiksi">Non-Fiksi</option>
                                    <option {{( $book->jenis == "sastra" ? 'selected' : "" )}} value="sastra">Sastra</option>
                                    <option {{( $book->jenis == "buku anak anak" ? 'selected' : "" )}} value="buku anak anak">Buku Anak Anak</option>
                                    <option {{( $book->jenis == "buku panduan" ? 'selected' : "" )}} value="buku panduan">Buku Panduan</option>
                                   </select>
                                    @error('jenis')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" name="stok" class="form-control" value="{{ old('stok', $book->stok) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="terpinjam">Terpinjam</label>
                                <input type="number" name="terpinjam" class="form-control" value="{{ old('terpinjam', $book->terpinjam) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="sinopsis">sinopsis</label>
                                <textarea name="sinopsis" id="sinopsis" cols="30" rows="5" class="form-control" required>{{ old('sinopsis', $book->sinopsis) }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                    </div>
            </div>
@endsection
