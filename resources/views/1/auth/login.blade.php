<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Document</title>
</head>
<body>
<div class="container">
  <div class="loginForm col-lg-5 col-md-8 col-sm-8 p-4">
    <div class="loginHeader pt-3 pb-4">
      <h4>LOGIN</h4>
      <p>Login to access Kasirku App!</p>
    </div>
    <div class="loginBody">
      <form method="POST" action="{{ route('auth.auth') }}">
        @csrf
      <div class="form-group">
        <div class="input-group mb-3">
          <input type="text" class="form-control form-control-lg" name="email" placeholder="Email...">
        </div>
      </div>
      <div class="form-group">
        <div class="input-group mb-3">
          <input type="password" class="form-control form-control-lg" name="password" placeholder="Password...">
        </div>
      </div>
      <div class="text-right form-group">
        <a href="#">Forgot password ?</a>
      </div>
      <div class="form-group">
        <button class="btn btn-block btn-lg btn-primary">Login</button>
      </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>