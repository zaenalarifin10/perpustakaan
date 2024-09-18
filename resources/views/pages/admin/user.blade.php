@extends('layouts.app')
@section('title', 'Books | Dashboard')
@section('content')

<div class="row row-cards">
    @foreach ($users as $user)
    <div class="col-md-6 col-lg-3">
        <div class="card">
          <div class="card-body p-4 text-center">
            <span class="avatar avatar-xl mb-3 rounded" style="background-image: url({{ asset('storage/profile_pictures/'.$user->profile_picture) }})"></span>
            <h3 class="m-0 mb-1"><a href="#">{{$user->name}}</a></h3>
            <h5 class="text-secondary">{{$user->email}}</h5>
            <div class="mt-3">
                <span class="badge @if ($user->role == 1) bg-red-lt @elseif ($user->role == 2) bg-blue-lt @else bg-grey @endif">
                    @if ($user->role == 1)
                        Admin
                    @elseif ($user->role == 2)
                        Member
                    @else
                        Role tidak dikenali
                    @endif
                </span>
            </div>

          </div>
          <div class="d-flex">
            <a href="mailto:{!! $user->email !!}" class="card-btn"><!-- Download SVG icon from http://tabler-icons.io/i/mail -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
              Email</a>
              <a href="javascript:void(0);" class="messageButton card-btn" data-telepon="{{ $user->telepon }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                </svg>
                Call
            </a>
          </div>
        </div>
      </div>
      @endforeach
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.messageButton').click(function() {
            var phoneNumber = $(this).data('telepon'); // Ambil nomor telepon dari atribut data
            console.log(phoneNumber);
            var message = encodeURIComponent("Hello, Di sini admin perpustakaan, Sekarang sudah waktu tenggat peminjaman buku ");
            var whatsappUrl = "https://api.whatsapp.com/send?phone=" + phoneNumber + "&text=" + message;
            window.open(whatsappUrl, '_blank');
        });
    });
</script>
@endsection
