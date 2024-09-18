<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="{{asset('/css/profile.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="card-container">
    <img class="round" src="{{asset('img/profile.png')}}" height="100" width="100" alt="user" />
    <h3>{{$pinjam->user->name}}</h3>
    <h6>{{$pinjam->user->telepon}}</h6>
    <p>{{$pinjam->user->email}}</p>
    <div class="buttons">
        <button class="primary" id="messageButton">
            Message
        </button>
    </div>
    <div class="skills">
        <h6>Buku yang di pinjam</h6>
        <ul>
            <li>{{$pinjam->book->judul_buku}}</li>
            <li>{{$pinjam->book->genre}}</li>
            <li>{{$pinjam->book->jenis}}</li>
        </ul>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#messageButton').click(function() {
        var phoneNumber = "{{$pinjam->user->telepon}}";
        var message = encodeURIComponent("Hello, Di sini admin perpustakaan, Sekarang sudah waktu tenggat peminjaman buku ");
        var buku = "{{$pinjam->book->judul_buku}}";
        var genre = " dengan genre ";
        var genres = "{{$pinjam->book->genre}}";
        var whatsappUrl = "https://api.whatsapp.com/send?phone=" + phoneNumber + "&text=" + message + buku + genre + genres;
        window.open(whatsappUrl, '_blank');
    });
});
</script>
</body>
</html>
