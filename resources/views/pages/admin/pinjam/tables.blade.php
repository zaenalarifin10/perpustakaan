@extends('layouts.app')
@section('title', 'books | Tables')
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
                            <tr class="text-center">
                                <th class="w-1">No</th>
                                <th>Judul Buku</th>
                                <th>Nama Peminjam</th>
                                <th>Telepon</th>
                                <th>Dipinjam</th>
                                <th>Status</th>
                                <th>Approve</th>
                                <th>Detail</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="results-container">
                            @foreach ($pinjams as $pinjam)
                            <tr class="text-center">
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $pinjam->book->judul_buku }}</td>
                                <td>{{ $pinjam->user->name }}</td>
                                <td>{{ $pinjam->user->telepon }}</td>
                                <td>{{ $pinjam->dipinjam }}</td>
                                <td>{{ $pinjam->status }}</td>

                                <td>
                                    <form action="{{ route('admin.pinjam.approve', $pinjam->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button class="btn btn-outline-warning w-100" type="submit">
                                            approve
                                        </button>
                                    </form>
                                </td>
                                <td>
                                  <div class="col-6 col-sm-4 col-md-2 col-xl py-3 w-100">
                                    <a href="{{route("admin.pinjam.show", $pinjam->id)}}" class="btn btn-outline-primary w-100" style="">
                                      view
                                    </a>
                                  </div>
                                </td>
                                <td>
                                    <div class="col-6 col-sm-4 col-md-2 col-xl py-3 w-100">
                                      <a href="{{route("admin.pinjam.edit", $pinjam->id)}}" class="btn btn-outline-success w-100">
                                        edit
                                      </a>
                                    </div>
                                  </td>
                                  <td>
                                    <form action="{{ route('admin.pinjam.delete', $pinjam->id) }}" method="POST" id="delete-form-{{ $pinjam->id }}">
                                        @csrf
                                        @method('DELETE')
                                    <div class="col-6 col-sm-4 col-md-2 col-xl py-3 w-100">
                                        <button type="button" onclick="confirmDelete({{ $pinjam->id }})"class="btn btn-outline-danger w-100" style="margin-top: 9px; margin-bottom:-10px;">
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
