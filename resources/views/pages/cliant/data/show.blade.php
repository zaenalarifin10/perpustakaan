<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    <script href="{{asset('/js/script.js')}}"></script>
</body>
</html>
<div class="cover">
    <div class="book">
    <label for="page-1"  class="book__page book__page--1">
    @if($book->cover)
        <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover Image">
    @else
        <p>No cover image available.</p>
    @endif
    </label>

    <label for="page-2" class="book__page book__page--4">

    </label>

    <!-- Resets the page -->
    <input type="radio" name="page" id="page-1"/>

    <!-- Goes to the second page -->
    <input type="radio" name="page" id="page-2"/>
    <label class="book__page book__page--2">
      <div class="book__page-front">
        <div class="page__content">
          <h1 class="page__content-book-title">{{ $book->judul_buku }}</h1>
          <h2 class="page__content-author">{{ $book->penulis }}</h2>

          <p class="page__content-credits">
            Penerbit
            <span>{{ $book->penerbit }}</span>
          </p>

          <p class="page__content-credits">
            Genres
            <span>{{ $book->genre }}</span>
          </p>

          <div class="page__content-copyright">
            <p>ISBN</p>
            <p>{{ $book->isbn }}</p>
          </div>
        </div>
      </div>
      <div class="book__page-back">
        <div class="page__content">
          <h1 class="page__content-title">Sinopsis</h1>
          <table class="page__content-table">
            <tr>
              <td align="left">{{ $book->sinopsis }}</td>
            </tr>
          </table>

          <div class="page__number">2</div>
        </div>
      </div>
    </label>
  </div>
  </div>
</head>
<a href="{{ Route('admin.tables') }}"><button style="margin-top: 10px; background-color:grey; padding:5px 15px; color:white; border:0.3px solid black; border-radius:10px;">BACK</button></a>
<body>
