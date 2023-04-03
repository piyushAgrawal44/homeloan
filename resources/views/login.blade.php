@extends('header')
@section('content')
@push('css')
<style>
    .home-image{
        max-width: 100%;
    }
</style>
    
@endpush
<div class="container mt-3">
    <div class="row">
        @if (!Auth::check())
        <div class="col-12 col-md-6 mb-4 mb-md-0">
            <img src="{{ asset('images/home.jpg') }}" class="home-image" alt="home">
        </div>
        <div class="col-12 col-md-6 align-self-center">
            <h1 class="font-lilita mb-3">Login to get started !</h1>

            
            <form class="" action="/login" method="POST" onsubmit="return loginUser()">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label"><b>Email Address</b> <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                  @error('email')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label"><b>Password</b> <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" name="password" id="password" required>
                  @error('password')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" id="submit_btn" class="btn btn-primary btn-lg">Login</button>
            </form>
           
        </div>
        @else
            <a class="btn btn-primary btn-lg" href="/">Home Page</a>
        @endif
    </div>
</div>
    

@push('js')
    <script>
        function loginUser(){
            let email=document.getElementById("email").value.trim();
            if (!email || email=="" || email==" ") {
                alert("Email can not be empty");
                return false;
            }
            let password=document.getElementById("password").value.trim();
            if (!password || password=="" || password==" ") {
                alert("Password can not be empty");
                return false;
            }
            document.getElementById('customLoaderBox').style.visibility='visible';
            document.getElementById('submit_btn').disabled = true;

            return true;
        }
    </script>
@endpush
@endsection