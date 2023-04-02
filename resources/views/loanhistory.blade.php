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
        {{-- {{dd($loanDetails)}} --}}
        @if (Auth::check())
        @php
            $statusArr=["Unkown","Under Review","Approved",'Amount Transferred','Repayment Process',"Loan Finished"]
        @endphp
        <div class="col-12 col-md-6 offset-md-3 mb-4 mb-md-0">
            <img src="{{ asset('images/home.jpg') }}" class="home-image" alt="home">
        </div>
        <div class="col-12  align-self-center">
            <h1 class="font-lilita mb-3 text-center">Loan History !</h1>


            <div class="table-responsive mb-3">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Amount</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if (count($loanDetails)==0)
                                <tr>
                                    <td class="text-center" colspan="3">No Loan to Show !</td>
                                </tr>
                        @endif
                        @foreach ($loanDetails as $item)
                            <tr>
                                <td>{{$item["loan_amt"]}}</td>
                                <td>{{$item["loan_duration"]}} Years</td>
                                <td>{{$statusArr[$item["status"]]}}</td>
                                <td><a class="text-decoration-none" href="/loan/history/{{$item["id"]}}"><i class="bi bi-eye"></i> View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
           
        </div>
        @else
            <a class="btn btn-primary btn-lg" href="/">Home Page</a>
        @endif
    </div>
</div>
    

@push('js')
    <script>
        function requestLoan(){
            let job_type=document.getElementById("job_type").value.trim();
            if (!job_type || job_type=="" || job_type==" ") {
                alert("Job Type can not be empty !");
                return false;
            }

            let annual_salary=document.getElementById("annual_salary").value.trim();
            if (!annual_salary || annual_salary=="" || annual_salary==" ") {
                alert("annual Salary can not be empty !");
                return false;
            }
            let address=document.getElementById("address").value.trim();
            if (!address || address=="" || address==" ") {
                alert("Address can not be empty !");
                return false;
            }

            return true;
        }
    </script>
@endpush
@endsection