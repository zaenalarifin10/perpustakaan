@extends('layouts.app')
@section('title', 'Book | Tambah Genre')

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
    <form action="/admin/genre/book" method="POST" enctype="multipart/form-data">
        {{-- @method("put") --}}
        @csrf
        <h1>TAMBAH GENRE</h1>

        <!-- Judul Buku -->
        <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Judul Buku:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Judul Buku" value="{{ old('name') }}">
                @error('name')
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
