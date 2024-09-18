<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Electronicshop | Login</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
  <div class="wrapper">
    <!-- Start of the login form -->
    <form action="{{ route('post.login') }}" method="POST">
      @csrf
      <h2>Login</h2>

  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

      <!-- Email field -->
      <div class="input-field">
        <input type="email" name="email" required>
        <label for="email">Enter your email</label>
      </div>

      <!-- Password field -->
      <div class="input-field">
        <input type="password"  name="password" required>
        <label for="password">Enter your password</label>
      </div>

      <div class="input-field">
        <input type="telepon"  name="telepon" required>
        <label for="telepon">Enter your telepon</label>
      </div>

      <!-- Remember me and forgot password links -->
      <div class="forget">
        <a href="#">Forgot password?</a>
      </div>

      <!-- Submit button -->
      <button type="submit">Log In</button>

      <!-- Register link -->
      <div class="register">
        <p>Tidak punya akun? <a href="{{ route('create') }}">Daftar</a></p>
      </div>
    </form>
    <!-- End of the login form -->
  </div>
</body>
</html>
