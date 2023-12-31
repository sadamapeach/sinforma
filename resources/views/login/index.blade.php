<style type="text/css">
    *{
      font-family: 'Poppins', sans-serif;
    }
  
    .form {
        height: 100vh;
    }
  
    .header h1 {
        font-style: normal;
        font-weight: 600;
        font-size: 32px;
        line-height: 48px;
        margin-top: 50px;
  
        color: black;
    }
  
    .header p {
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 21px;
        margin-bottom: 5px;
  
        color: #737373;
    }
  
    .form-form label {
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        margin-top: 15px;
  
        color: black;
    }
  
    .form-form input {
        background: #FFFFFF;
        border: 1px solid #BCBCBC;
        box-sizing: border-box;
        border-radius: 8px;
    }
  
    .form-form .signin {
        width: 100%;
        height: 42px;
        background: #363674;
        border-radius: 8px;
        color: white;
        border: none;
        margin-top: 30px;
        margin-bottom: 50px;
        display: block;
    }
  
    .form-form span {
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 21px;
  
        color: #737373;
    }
  </style>
  
  <!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" type="image/x-icon" href="assets/logo.png">
  
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
      {{-- Fonts Google --}}
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
      
      <title>SIPRESMA Diskominfo | Login</title>
    </head>
  
    <body>
      <section class="form d-flex">
        {{-- Left --}}
        <div class="login-left w-50 h-100">
          <div class="row justify-content-center align-items-center h-100">
            <div class="col-lg-8">
  
              {{-- Alert Success--}}
              @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
  
              {{-- Alert Logout --}}
              @if(session()->has('logoutSuccess'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('logoutSuccess') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
  
              {{-- Alert Error --}}
              @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
  
              <div class="header">
                <h1>SIPRESMA Diskominfo</h1>
                <p>Welcome! Please enter your details.</p>
              </div>
              
              <form action="/login" method="post">
                @csrf
                {{-- Username --}}
                <div class="form-form">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Enter your username" autofocus required value="{{ old('username') }}">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
  
                {{-- Password --}}
                <div class="form-form">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter your password" required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
  
                {{-- Button --}}
                <div class="form-form">
                    <button id="loginButton" class="signin" type="submit"><b>Sign In</b></button>           
                </div>
              </form>
            </div>
          </div>
        </div>
  
        {{-- Right --}}
        <div class="login-right w-50 h-100" style="position:fixed; margin-left:50%">
            <img src="assets/magang_1.png" class="img-fluid" alt="">
        </div> 

        {{-- <div class="login-right w-50 h-100">
            <div class="row justify-content-center align-items-center h-100">
              <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner"> --}}
                  {{-- Gambar 1 --}}
                  {{-- <div class="carousel-item active">
                    <img src="assets/login_1.png" class="d-block w-100" alt="">
                  </div> --}}
                  {{-- Gambar 2 --}}
                  {{-- <div class="carousel-item">
                    <img src="assets/login_2.png" class="d-block w-100" alt="">
                  </div> --}}
                  {{-- Gambar 3 --}}
                  {{-- <div class="carousel-item">
                    <img src="assets/login_3.png" class="d-block w-100" alt="">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
          </div> --}}
      </section>
  
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
  </html>