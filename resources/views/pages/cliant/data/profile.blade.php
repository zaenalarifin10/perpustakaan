@extends('layouts.client')
@section('title', 'Electronicshop | Profile')
@section('content')


        <div class="main-content">
            <a href="dashboard.html" class="back-link">Kembali ke halaman utama</a>
            <div class="profile">
                <div class="profile-header">


                    <img class="img" src="{{ asset('storage/profile_pictures/'.auth()->user()->profile_picture) }}" alt="">


                    <div class="profile-info-main">
                        <h1>{{auth()->user()->name}}</h1>
                        <button class="change-photo" onclick="openUploadPopup()">Change photo</button>
                    </div>
                </div>
                <div class="profile-details">
                    <p><strong>Name:</strong> {{auth()->user()->name}}</p>
                    <p><strong>Email:</strong> {{auth()->user()->email}}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pop-up for image upload -->
    <div id="upload-popup" class="popup">
        <div class="popup-content">
            <form action="{{ route('cliant.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                <label for="profile_picture">Upload Foto Profil:</label>
                <input type="file" id="profile_picture" name="profile_picture">
            </div>

            <button type="submit">Simpan</button>
        </form>
        </div>
    </div>
    <script>
        function openUploadPopup() {
            document.getElementById('upload-popup').style.display = 'block';
        }

        function closeUploadPopup() {
            document.getElementById('upload-popup').style.display = 'none';
        }

        // Optionally, close popup if user clicks outside of the popup content
        window.onclick = function(event) {
            if (event.target === document.getElementById('upload-popup')) {
                closeUploadPopup();
            }
        }
    </script>
@endsection
