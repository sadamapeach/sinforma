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
        color: #FFFFFF;
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

    #formButton {
      /* Gaya normal tombol */
      background: #363674;
      color: #ffffff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    #formButton:active {
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
      <link rel="icon" type="image/x-icon" href="assets/logo.png">
  
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
      {{-- Fonts Google --}}
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
      
      <title>SIPRESMA | Form</title>
    </head>
  
    <body>
      <section class="form d-flex">
        {{-- Left --}}
        <div class="login-left w-50 h-100">
          <div class="row justify-content-center align-items-center h-100">
            <div class="col-lg-8">
  
              {{-- Header --}}
              <div class="header" style="margin-top: 12%">
                <div  style="display: flex; align-items: center">
                  <div><img src="assets/logo.png" alt="logo_diskominfo" class="mb-2" style="width: 25%"></div>
                  <h2 style="margin-left: -20%;"><b>SIPRESMA Diskominfo</b></h2>
                </div>
                <p>Complete the following form to proceed to the next step.</p>
              </div>
              
              <form action="{{route('save')}}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- Nama --}}
                <div class="form-form">
                  <fieldset disabled>
                    <label for="disabledTextInput" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" id="disabledTextInput"
                    value="{{ $mahasiswa->nama }}">
                  </fieldset>
                </div>

                {{-- Id Mahasiswa --}}
                <div class="form-form">
                  <fieldset disabled>
                    <label for="disabledTextInput" class="form-label">Id Magang</label>
                    <input type="text" name="id_mhs" class="form-control" id="disabledTextInput"
                    value="{{ $mahasiswa->id_mhs }}">
                  </fieldset>
                </div>

                {{-- Jurusan --}}
                <div class="form-form">
                  <fieldset disabled>
                    <label for="disabledTextInput" class="form-label">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control" id="disabledTextInput"
                    value="{{ $mahasiswa->jurusan }}">
                  </fieldset>
                </div>
  
                {{-- Instansi --}}
                <div class="form-form">
                  <fieldset disabled>
                    <label for="disabledTextInput" class="form-label">Instansi</label>
                    <input type="text" name="instansi" class="form-control" id="disabledTextInput"
                    value="{{ $mahasiswa->instansi }}">
                  </fieldset>
                </div>

                {{-- Alamat --}}
                <div class="form-form">
                  <label for="alamat" class="form-label">Alamat</label>
                  <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukkan alamat anda" autofocus value="{{ old('alamat') }}">
                  {{-- <input type="text-area" class="form-control" id="alamat" rows="3" placeholder="Enter your address" autofocus required> --}}
                  @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                  @enderror
                </div>

                {{-- No.HP --}}
                <div class="form-form">
                  <label for="noHP" class="form-label">Nomor HP</label>
                  <input type="tel" name="noHP" class="form-control @error('noHP') is-invalid @enderror" id="noHP" placeholder="Masukkan nomor HP anda" autofocus value="{{ old('noHP') }}">
                  @error('noHP')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                  @enderror
                </div>

                {{-- Email --}}
                <div class="form-form">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan alamat email anda" autofocus value="{{ old('email') }}">
                    @error('noHP')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Upload Image --}}
                <div class="form-form">
                  <label for="foto" class="form-label">Upload Foto Profil</label>
                  <input class="form-control" type="file" id="foto" name="foto" required value="{{ old('image') }}">
                  @error('foto')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                  @enderror
                </div>
                
                {{-- Button --}}
                <div class="form-form">
                  <button id="formButton" class="signin" type="submit"><b>Submit</b></button>
                </div>
              </form>
            </div>
          </div>
        </div>
  
        {{-- Right --}}
        <div class="login-right w-50 h-100" style="position:fixed; margin-left:50%">
          <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
          <div class="carousel-inner">
              {{-- Gambar 1 --}}
              <div class="carousel-item active">
              <img src="assets/magang_1.png" class="img-fluid" alt="">
              </div>
              {{-- Gambar 2 --}}
              <div class="carousel-item">
              <img src="assets/magang_3.png" class="img-fluid" alt="">
              </div>
              {{-- Gambar 3 --}}
              <div class="carousel-item">
              <img src="assets/magang_2.png" class="d-block w-100" alt="">
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
      </section>
  
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
  </html>