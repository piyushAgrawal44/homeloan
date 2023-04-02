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

        <div class="col-12 col-md-6 mb-4 mb-md-0">
            <img src="{{ asset('images/home.jpg') }}" class="home-image" alt="home">
        </div>
        <div class="col-12 col-md-6 align-self-center">
            <h1 class="font-lilita mb-3">Looking for home loan ?</h1>
            <h5 class="mb-2">LoanBook can help you get loan easily and faster. More tha 100+ people have avail loan using LoanBook. The process is very simple you just need to create a account on LoanBook then request a loan amount and guess what you get your amount in you bank account. Dolorem voluptatum illo, ducimus, reprehenderit ad saepe dicta distinctio accusantium, dignissimos delectus magnam laborum voluptatibus aut quos iste architecto dolore libero assumenda deserunt similique consequuntur beatae repellat aperiam suscipit? Corporis eligendi qui rem rerum, doloribus voluptates, officiis esse cumque optio voluptatum nulla dolore modi expedita!</h5>
            @if (Auth::check())
                <a class="btn btn-primary btn-lg" href="/newloan">Get Now</a>
            @else
                <a class="btn btn-primary btn-lg" href="/login">Get Now</a>
            @endif
        </div>
    </div>
</div>
    
@endsection