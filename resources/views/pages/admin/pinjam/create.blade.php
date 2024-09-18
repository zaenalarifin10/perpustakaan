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
    <form action="{{ route('admin.pinjam.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h1>TAMBAH BUKU</h1>

        @foreach($users as $user)
           <input type="hidden" class="form-control" id="id_user" name="id_user" value="{{ $user->id ?? 'No email' }}">       
    @endforeach
        <div class="form-group row">
            <label for="kode" class="col-sm-3 col-form-label">judul buku:</label>
            <div class="col-sm-9">
               <select name="id_book" id="id_book"class="form-control">
                @foreach ($books as $book)
                <option value="{{$book->id}}" >{{$book->judul_buku}}</option>
                @endforeach
               </select>
                @error('id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- Buku Terpinjam -->
        <div class="form-group row">
            <label for="terpinjam" class="col-sm-3 col-form-label">Buku dipinjam:</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="dipinjam" name="dipinjam" placeholder="Masukkan Jumlah Buku dipinjam" value="{{ old('dipinjam') }}">
                @error('dipinjam')
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
