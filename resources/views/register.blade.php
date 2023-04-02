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
            <h1 class="font-lilita mb-3">Register to get started !</h1>

            <form class="" action="/register" method="POST" onsubmit="return registerUser()">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label"><b>Full Name</b> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                    @error('name')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
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
                    <label for="phone" class="form-label"><b>Phone</b> <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" required  minlength="10">
                    @error('phone')
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
                <button type="submit" id="submit_btn" class="btn btn-primary btn-lg">Register</button>
            </form>
           
        </div>
        @else
            <a class="btn btn-primary btn-lg" href="/">Home Page</a>
        @endif
    </div>
</div>
    

@push('js')
    <script>
        function registerUser(){
            let name=document.getElementById("name").value.trim();
            if (!name || name=="" || name==" ") {
                alert("Name can not be empty !");
                return false;
            }

            let email=document.getElementById("email").value.trim();
            if (!email || email=="" || email==" ") {
                alert("Email can not be empty !");
                return false;
            }
            let phone=document.getElementById("phone").value.trim();
            if (!phone || phone=="" || phone==" ") {
                alert("Please enter a valid phone number !");
                return false;
            }
            let password=document.getElementById("password").value.trim();
            if (!password || password=="" || password==" ") {
                alert("Password can not be empty !");
                return false;
            }

            document.getElementById('customLoaderBox').style.visibility='visible';
            document.getElementById('submit_btn').disabled = true;
            return true;
        }
    </script>
@endpush
@endsection