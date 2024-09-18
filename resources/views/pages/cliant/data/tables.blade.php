@extends('layouts.client')
@section('title', 'Books | Dashboard')
@section('content')

        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
              <div class="row g-2 align-items-center">
                <div class="col">
                  <h2 class="page-title">
                    Music components
                  </h2>
                </div>
              </div>
            </div>
          </div>
          <!-- Page body -->
        @foreach ($books as $book)

          <div class="page-body" style="margin-top:20px;">
            <div class="container-xl">
              <div class="row">
                  <div class="card">
                    <div class="list-group card-list-group">
                      <div class="list-group-item" >
                        <div class="row g-2 align-items-center" style="height: 200px;">
                          <div class="col-auto">
                            @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover Image" class="rounded" width="130" height="170">
                        @else
                            <p>No cover image available.</p>
                        @endif
                          </div>
                        <div class="col" >
                                <h2 class="text-uppercase">{{ $book->judul_buku }}</h2>
                            <div class="text-secondary">
                                <h5 class="text-capitalize">Penulis: {{ $book->penulis }}</h5>
                            <div class="text-secondary">
                                <h5 class="text-capitalize">Genre: {{ $book->genre }}</span></h5>
                            <div class="col text-secondary">
                                <h5>Stok: {{ $book->stok }}</h5>
                            </div>
                        </div>
                        <a href="{{route("cliant.show", $book->id)}}" class="btn btn-dark" style="">
                        Detail
                        </a>
                        <a href="{{route("cliant.pinjam", $book->id)}}" class="btn btn-success" style="">
                        Pinjam
                        </a>
                    </div>
                </div>
            </div>


                      </div>
                </div>
              </div>

            </div>
          </div>
          @endforeach

        </div>
      </div>

    </body>
  </html>
@endsection
