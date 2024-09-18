@extends('layouts.app')
@section('title', 'Book | Tambah Buku')

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
<div class="container mt-4">
    <form action="{{ route('admin.book.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h1>TAMBAH BUKU</h1>

        <!-- Judul Buku -->
        <div class="form-group row">
            <label for="judul_buku" class="col-sm-3 col-form-label">Judul Buku:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="judul_buku" name="judul_buku" placeholder="Masukkan Judul Buku" value="{{ old('judul_buku') }}">
                @error('judul_buku')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Penulis Buku -->
        <div class="form-group row">
            <label for="penulis" class="col-sm-3 col-form-label">Penulis Buku:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Masukkan Penulis Buku" value="{{ old('penulis') }}">
                @error('penulis')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Penerbit Buku -->
        <div class="form-group row">
            <label for="penerbit" class="col-sm-3 col-form-label">Penerbit Buku:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Masukkan Penerbit Buku" value="{{ old('penerbit') }}">
                @error('penerbit')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- ISBN -->
        <div class="form-group row">
            <label for="isbn" class="col-sm-3 col-form-label">ISBN:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Masukkan ISBN Buku" value="{{ old('isbn') }}">
                @error('isbn')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="jenis" class="col-sm-3 col-form-label">Jenis Buku:</label>
            <div class="col-sm-9">
               <select name="jenis" id="jenis"class="form-control">
                <option value="">Masukkan Jenis Buku</option>
                <option value="fiksi">Fiksi</option>
                <option value="non-fiksi">Non-Fiksi</option>
                <option value="sastra">Sastra</option>
                <option value="buku anak anak">Buku Anak Anak</option>
                <option value="buku panduan">Buku Panduan</option>
               </select>
                @error('jenis')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Stok Buku -->
        <div class="form-group row">
            <label for="stok" class="col-sm-3 col-form-label">Stok Buku:</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan Stok Buku" value="{{ old('stok') }}">
                @error('stok')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <input type="hidden" name="terpinjam" id="terpinjam" value="0">

        <div class="form-group row">
            <label for="sinopsis" class="col-sm-3 col-form-label">Sinopsis:</label>
            <div class="col-sm-9">
                <textarea name="sinopsis" id="sinopsis" cols="30" rows="5" class="form-control" placeholder="Masukkan sinopsis Buku"></textarea>
                @error('sinopsis')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Pilih Genre -->
        <div class="form-group row">
            <label for="genres" class="col-sm-3 col-form-label">Pilih Genre:</label>
            <div class="col-sm-9">
                @foreach($genres as $genre)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="genre_{{ $genre->id }}" name="genre[]" value="{{ $genre->name }}"
                            {{ in_array($genre->name, old('genre', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="genre_{{ $genre->id }}">{{ $genre->name }}</label>
                    </div>
                @endforeach
                <a class="btn btn-outline-dark mb-1" href="{{ Route('admin.genre.create') }}">+</a>
                @error('genre')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Upload Cover Buku -->
        <div class="form-group row">
            <label for="cover" class="col-sm-3 col-form-label">Cover Buku (PNG, JPG, JPEG):</label>
            <div class="col-sm-9">
                <input type="file" class="form-control-file" id="cover" name="cover" accept=".png, .jpg, .jpeg">
                @error('cover')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="form-group row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a class="btn btn-warning ml-2" href="{{ route('admin.tables') }}">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection
