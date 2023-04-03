@extends('/admin.header')
@section('content')
@push('css')
<style>
    .home-image{
        max-width: 100%;
    }
</style>
    
@endpush

@php
    $loanArr=['',['Pending Loans',0],['Approved Loans',0],['Amount Transferred Loan',0],['Repayment Process Loans',0],['Finished Loans',0]];
    $userArr=[['Blocked User',0],['Total Users',0]];

    foreach ($allLoan as $key => $loan) {
        $loanArr[$loan['status']][1]++;
    }

    foreach ($allUser as $key => $user) {
        $userArr[$user['active']][1]++;
    }
@endphp
@if (Auth::check())
<div class="container mt-3">
    <h1 class="font-lilita mb-3">Loans Analytics :</h1>

    <div class="row mb-5">
       
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 align-self-center">
                <div class="card bg-dark text-light mb-3" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title font-lilita"><b>Pending Loans</b></h5>
                        <h6 class="card-text"><span class="">{{$loanArr[1][1]}}</span></h6>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 align-self-center">
                <div class="card bg-dark text-light mb-3" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title font-lilita"><b>Approved Loans</b></h5>
                        <h6 class="card-text"><span class="">{{$loanArr[2][1]}}</span></h6>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 align-self-center">
                <div class="card bg-dark text-light mb-3" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title font-lilita"><b>Finished Loans</b></h5>
                        <h6 class="card-text"><span class="">{{$loanArr[5][1]}}</span></h6>
                    </div>
                </div>
            </div>
            <a href="/loan/analytics" class="">View More -></a>
    </div>

    <h1 class="font-lilita mb-3">User Analytics :</h1>

    <div class="row">
       
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 align-self-center">
                <div class="card bg-dark text-light mb-3" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title font-lilita"><b>Total Users</b></h5>
                        <h6 class="card-text"><span class="">{{$userArr[1][1]}}</span></h6>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 align-self-center">
                <div class="card bg-dark text-light mb-3" style="max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title font-lilita"><b>Blocked Users</b></h5>
                        <h6 class="card-text"><span class="">{{$userArr[0][1]}}</span></h6>
                    </div>
                </div>
            </div>

            {{-- <a href="/user/analytics" class="">View More -></a> --}}
    </div>
</div>
@else
<a class="btn btn-primary btn-lg" href="/login">Get Now</a>
@endif
    
@endsection