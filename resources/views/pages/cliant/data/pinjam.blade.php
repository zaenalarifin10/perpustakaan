<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronicshop | View</title>
    <link rel="stylesheet" href="{{ asset('css/view.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-content">
                <form action="{{ Route('cliant.store') }}" method="POST">
                    @csrf
                <h2 class="product-code"><span class="code">{{ $book->isbn }}</span></h2>
<img class="img" src="{{ asset('storage/'.$book->cover) }}" alt="">

                <h3 class="product-name">Nama book: <span class="name">{{ $book->judul_buku }}</span></h3>
                <input type="hidden" name="id_book" value="{{ $book->id }}">
                <p class="product-stock">Stok book:  {{ $book->stok }}<p class="product-stock">
                    Jumlah book Yang ingin di beli:
                    <input
                      type="number"
                      class="form-controls"
                      id="stock-number"
                      value="1"
                      min="0"
                      max="{{ $book->stok }}"
                      step="1"
                      name="dipinjam"
                    />
                  </p></p>
                    <button type="submit" class="btn btn-outline-primary">Beli</button>
                    <a href="{{route('cliant.tables')}}" class="badge">Kembali</a>

                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/view.js') }}"></script>
</body>
</html>
