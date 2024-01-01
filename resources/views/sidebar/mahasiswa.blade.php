<style type="text/css">
    *{
      font-family: 'Poppins', sans-serif;
      padding: 0;
      margin: 0;
    }
  
    .sidebar {
      background-color: #353A55;
      width: 260px;
      padding: 24px;
      display: flex;
      box-sizing: border-box;
      min-height: 100vh;
      flex-direction: column;
      position: fixed;
    }
  
    .main-content {
      background-color: #eeeeee;
      flex-grow: 1;
    }
  
    .sidebar .description-header {
      font-style: normal;
      font-weight: 1000;
      font-size: 22px;
      line-height: 16px;
      text-align: center;
      color: #ffffff;
    }
  
    .sidebar a {
      text-decoration: none;
    }
  
    .sidebar .header .list-item {
      display: flex;
      flex-direction: row;
      align-items: center;
      padding: 12px 10px;
      border-radius: 8px;
      /* background-color: aqua; */
      height: 40px;
      box-sizing: border-box;
    }
  
    .sidebar .header .list-item .icon {
      margin-right: 12px;
    }
  
    .sidebar .main .list-item .description {
      font-style: normal;
      font-weight: 400;
      font-size: 16px;
      line-height: 16px;
      text-align: center;
      color: #ffffff;
    }
  
    .sidebar .main .list-item .icon {
      margin-right: 12px;
      color: #eeeeee;
    }
  
    .sidebar .main .list-item {
      display: flex;
      flex-direction: row;
      align-items: center;
      padding: 12px 10px;
      border-radius: 8px;
      width: 212px;
      box-sizing: border-box;
    }
  
    .sidebar .main .list-item:hover {
      background: #738CF2;
      /* transition: all ease-in .2s; */
    }
  
    .body {
      background-color: #e7eeff;
    }
  
    .log {
      margin-top: 190%;
      margin-left: 71%;
    }
  </style>
  
  <!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
      {{-- Fonts Google --}}
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    </head>
  
    <body>
      <section>
        <div class="sidebar">
          <div class="header">
            <div class="list-item">
              <a href="#"></a>
                <img src="{{ asset('assets/undip(1).png') }}" alt="" class="icon  mb-2">
                <span class="description-header">SISMO Undip</span>
              </a>
            </div>
  
            <div class="illustration ml-4">
              <img src="{{ asset('assets/logo.png') }}" alt="">
            </div>
          </div>
          
          <div class="main">
            {{-- Dashboard --}}
            <div class="list-item">
              {{-- <a href="/dashboard_mhs"> --}}
                <i class="fas fa-home" style="color: #eeeeee; margin-left: 10px;"></i>
                <span class="description" style="margin-left: 13px;">Dashboard</span> 
              {{-- </a> --}}
            </div>
  
            {{-- Profile --}}
            <div class="list-item">
              {{-- <a href="/profile"> --}}
                <i class="fas fa-tachometer-alt" style="color: #eeeeee; margin-left: 11px;"></i>
                <span class="description" style="margin-left: 13px;">Profile</span> 
              {{-- </a> --}}
            </div>
  
            {{-- Akademik --}}
            <div class="list-item">
              {{-- <a href="/irsTabel"> --}}
                <i class="far fa-calendar-check" style="color: #eeeeee; margin-left: 13px;"></i>
                <span class="description" style="margin-left: 13px;">Akademik</span> 
              {{-- </a> --}}
            </div>
          </div>
  
        {{-- Logout --}}
        {{-- <div class="list-item position-absolute log">
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn" style="color: #eeeeee"><i class="fas fa-sign-out-alt mt-1" style="font-size: 20px"></i></button>
          </form>
        </div> --}}
        
        </div>
      </section>
    </body>
  </html>