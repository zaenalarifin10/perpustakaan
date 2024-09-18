@extends('layouts.app')
@section('title', 'Books | Tables')
@section('content')
<div class="container-fluid">
    @if (Session('success'))
    <div class="alert alert-success" role="alert">
        {{ Session('success') }}
    </div>
    @endif

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Invoices</h3>
            </div>
            <div class="card-body border-bottom py-3">
                <div class="ms-auto text-secondary">
                    <form id="search-form" class="mb-3">
                        <input type="search" id="search-query" name="query" placeholder="Cari buku..." class="form-control" aria-label="Search">
                        <button type="submit" class="btn btn-primary mt-2">Cari</button>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1">No.
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
                                </th>
                                <th>ISBN</th>
                                <th>Judul Buku</th>
                                <th>Jenis Buku</th>
                                <th>Stok Buku</th>
                                <th>Terpinjam</th>
                                <th>Sisa buku</th>
                                <th>Sisa buku</th>
                                <th>Sisa buku</th>
                                <th>Sisa buku</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="results-container">
                            @foreach ($books as $book)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $book->isbn }}</td>
                                <td>{{ $book->judul_buku }}</td>
                                <td>
                                    {{ $book->jenis }}
                                </td>
                                @php
                                    $sisaBuku = $book->stok - $book->terpinjam;
                                @endphp

                                <td>{{ $book->stok }}</td>
                                <td>{{ $book->terpinjam }}</td>
                                <td>
                                    <span class="badge {{ $book->sisa_buku > 0 ? 'bg-success' : 'bg-danger' }} me-1"></span>
                                    {{ $book->sisa_buku }}
                                </td>

                                <td>
                                  <div class="col-6 col-sm-4 col-md-2 col-xl py-3 w-100">
                                    <a href="{{route("admin.book.show", $book->id)}}" class="btn btn-outline-primary w-100" style="">
                                      view
                                    </a>
                                  </div>
                                </td>
                                <td>
                                    <div class="col-6 col-sm-4 col-md-2 col-xl py-3 w-100">
                                      <a href="{{route("admin.book.edit", $book->id)}}" class="btn btn-outline-success w-100">
                                        edit
                                      </a>
                                    </div>
                                  </td>
                                  <td>
                                    <form action="{{ route('admin.book.delete', $book->id) }}" method="POST" id="delete-form-{{ $book->id }}">
                                        @csrf
                                        @method('DELETE')
                                    <div class="col-6 col-sm-4 col-md-2 col-xl py-3 w-100">
                                        <button type="button" onclick="confirmDelete({{ $book->id }})"class="btn btn-outline-danger w-100" style="margin-top: 9px; margin-bottom:-10px;">
                                        Delete
                                        </button>
                                    </div>
                                    </form>

                                  </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#search-form').on('submit', function(e) {
            e.preventDefault();
            var query = $('#search-query').val();

            $.ajax({
                url: '{{ route('admin.search') }}',
                method: 'GET',
                data: { query: query },
                success: function(response) {
                    if (response.noResults) {
                        $('#results-container').html('<tr><td colspan="9" class="text-danger text-center">Data buku tidak ada.</td></tr>');
                    } else {
                        $('#results-container').html(response.html);
                    }
                },
                error: function(xhr) {
                    console.log('An error occurred:', xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
