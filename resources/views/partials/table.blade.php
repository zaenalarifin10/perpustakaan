<!-- resources/views/partials/table.blade.php -->
@forelse ($books as $book)
<tr>

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
@empty
<tr>
    <td colspan="9" class="text-danger text-center">Data buku tidak ada.</td>
</tr>
@endforelse
