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
        margin-top: 50%;
  
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
        border-radius: 8px;
        color: white;
        border: none;
        margin-top: 30px;
        margin-bottom: 10px;
        display: block;
    }

    .form-form .back {
        width: 100%;
        border-radius: 8px;
        color: white;
        border: none;
        display: block;
    }
  
    .form-form span {
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 21px;
  
        color: #737373;
    }

    .reset-alert {
        margin-top: 25px;
        font-size: 13px;
    }
  
    #loginButton {
      /* Gaya normal tombol */
      background: #363674;
      color: #ffffff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  
    #loginButton:active {
      /* Gaya saat tombol ditekan */
      background-color: #738CF2;
    }
  </style>
  
  <!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.png') }}">
  
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
      {{-- Fonts Google --}}
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
      
      <title>SINFORMA | Reset Password</title>
    </head>
  
    <body>
      <section class="form d-flex">
        {{-- Left --}}
        <div class="login-left w-50 h-100" style="position: fixed">
          <div class="row justify-content-center align-items-center h-100">
            <div class="col-lg-8">
  
            {{-- Alert --}}
            @if ($errors->any())
                <div class="reset-alert alert alert-danger" role="alert">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            @if (session()->has('status'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('status') }}
                </div>
            @endif
  
              <div class="header mt-5">
                <img src="{{ asset('assets/logo.png') }}" style="width: 8%; margin-bottom: 2.5%" alt="">
                <span class="h2">
                  <strong>SINFORMA Diskominfo</strong>
                </span>
                <p>Update your password! Please enter your new password.</p>
              </div>
              
              <form action="{{ route('update_password') }}" method="post">
                @csrf
                <input type="hidden" name="token" value="{{ request()->token }}">
                <input type="hidden" name="email" value="{{ request()->email }}">
                {{-- Password --}}
                <div class="form-form">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                </div>

                {{-- Password Confirmation--}}
                <div class="form-form">
                    <label for="password_confirmation" class="form-label">Password Confirmation</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Enter your password confirmation">
                </div>
  
                {{-- Button --}}
                <div class="form-form">
                    <button id="loginButton" class="signin fw-bold" type="submit">Update Password</button>           
                </div>
              </form>
            </div>
          </div>
        </div>
  
        {{-- Right --}}
        <div class="login-right w-50 h-100" style="position:fixed; margin-left:50%">
          <img src="{{ asset('assets/magang_4.png') }}" class="img-fluid" alt="">
        </div> 
      </section>
  
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
  </html>