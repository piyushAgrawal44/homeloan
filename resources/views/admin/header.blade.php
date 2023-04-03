<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoanBook - Home Loan Management System</title>
    <meta property="og:description" content="LoanBook - Home loan management system, free home loan system">
    <meta name="description" content="LoanBook - Home loan management system, free home loan system">
    <!-- Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Lilita+One&display=swap" rel="stylesheet">
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- For responsive datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <style>
      *{
          padding: 0%;
          margin: 0px;
          box-sizing: border-box;
          font-family: 'Inter', sans-serif;
      }

      .font-lilita{
          font-family: 'Lilita One', cursive;
      }

            
      /* Loader CSS */

      .customLoaderBox{
          position: fixed;
          bottom: calc(50% - 40px);
          left: calc(50% - 40px);
          height: 80px;
          width: 80px;
          padding: 0px;
          background-color: rgba(16, 15, 15, 0.3);
          border-radius: 50%;
          visibility: hidden;
      }
      .dot-1{
          position: absolute;
          bottom: calc(50% - 5px);
          left: calc(50% - 5px);
          height: 10px;
          width: 10px;
          background-color: #effe7f;
          border-radius: 50%;
          border: none;
          animation: rotate-ani-one 2s linear infinite;
          animation-delay: 1850ms;
          transform: translateY(-22px);
      }

      .dot-2{
          position: absolute;
          bottom: calc(50% - 5px);
          left: calc(50% - 5px);
          height: 10px;
          width: 10px;
          background-color: #eeff6f;
          border-radius: 50%;
          border: none;
          animation: rotate-ani-two 2s linear infinite;
          transform: translateY(-22px);
      }

      @keyframes rotate-ani-one {
          from {
              transform: rotate(0deg) translateY(-22px);
          }
          25%{
              transform: rotate(180deg) translateY(-22px);
          }
          50%{
              transform: rotate(180deg) translateY(-22px);
          }
          75%{
              transform: rotate(360deg) translateY(-22px);
          }
          to{
              transform: rotate(360deg) translateY(-22px);
          }
      }

      @keyframes rotate-ani-two {
          from {
              transform: rotate(0deg) translateY(-22px);
          }

          to {
              transform: rotate(360deg) translateY(-22px);
          }
      }
    </style>
    
    @stack('css')
</head>
<body>

    {{-- Navbar --}}

    <nav class="navbar  navbar-dark bg-primary sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="/dashboard"><b>LoanBook</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
              @if (Auth::check())
                <a class="text-decoration-none text-light me-3" href="loan/analytics"><i class="bi bi-bank2"></i> Manage Loan Requests</a>
                <a class="text-decoration-none text-light me-3" href="/profile"><i class="bi bi-person-circle"></i> Profile</a>
                <a class="text-decoration-none text-light" href="/logout"><i class="bi bi-door-open"></i> Logout</a>
              @else
                <a class="text-decoration-none text-light me-3" href="/register"><i class="bi bi-r-square-fill"></i> Register</a>  
                <a class="text-decoration-none text-light" href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
              @endif
          </div>
        </div>
      </div>
    </nav>

    @if (!empty($success))
        <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
            <strong>{{$success}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else
        @if (\Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show m-2">
            <strong>{!! \Session::get('success') !!}</strong>
        </div>
        @endif
    @endif

    

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
        <strong>{{$errors->first()}}<strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @yield('content')


    <div class="customLoaderBox" id="customLoaderBox">
      <div class="dot-1"></div>
      <div class="dot-2"></div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <!-- For responsive datatable -->
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    
    @stack('js')
</body>
</html>