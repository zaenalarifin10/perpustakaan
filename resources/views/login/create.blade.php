<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronicshop | Registration </title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
   </head>
<body>
  <div class="wrapper">
    <h2>Registration</h2>
    <form action="{{route('post.store')}}" method="POST">
        @csrf
      <div class="input-field">
        <input type="text" name="name"  class="form-control" placeholder="Enter your name" required>
      </div>

      <div class="input-field">
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
        </div>
      </div>

      <div class="input-field">
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
        </div>
      </div>

      <div class="input-field">
        <div class="form-group">
            <input type="telepon" name="telepon" class="form-control" placeholder="Enter your telepon" required>
        </div>
      </div>

      <!-- Submit button -->
      <button type="submit">Register</button>

      <!-- Register link -->
      <div class="register">
        <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
      </div>
    </form>
  </div>
</body>
</html>
Lo
