@extends('header')
@section('content')
@push('css')
<style>
    .home-image{
        max-width: 100%;
    }
</style>
    
@endpush
<div class="container mt-5">
    
    <div class="row">
        {{-- {{dd($loanDetails)}} --}}
        @if (Auth::check())
        @php
            $statusArr=["Unkown","Under Review","Approved",'Amount Transferred','Repayment Process',"Loan Finished"]
        @endphp
        <div class="col-12  align-self-center">

            <h2 class="mb-2 font-lilita">Loan Details :</h2>
            <div class="table-responsive mb-3">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Amount</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($loanDetails as $item)
                            <tr>
                                <td>{{$item["loan_amt"]}}</td>
                                <td>{{$item["loan_duration"]}} Years</td>
                                <td>{{$statusArr[$item["status"]]}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>

            <h2 class="mb-2 font-lilita">User Details :</h2>
           
            <div class="table-responsive mb-3">
                <table class="table">
                    
                    <tbody>
                        <tr class="">
                            <th scope="col">Name</th>
                            <td>: {{Auth::user()->name}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Email</th>
                            <td>: {{Auth::user()->email}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Phone</th>
                            <td>: {{Auth::user()->phone}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Job / Work / Business Details</th>
                            <td>: {{$userDetails[0]["job_type"]}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Annual Salary</th>
                            <td>: {{$userDetails[0]["annual_salary"]}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Full Address</th>
                            <td>: {{$userDetails[0]["address"]}}</td>
                        </tr>
                        <tr>
                            <th scope="col">Address Proof</th>
                            <td>: <a href="{{asset('storage/uploads/'.$userDetails[0]["address_proof"])}}" class="text-decoration-none" target="_blank">Download</a></td>
                        </tr>
                        <tr>
                            <th scope="col">Photo</th>
                            <td>: <a href="{{asset('storage/uploads/'.$userDetails[0]["photo"])}}" class="text-decoration-none" target="_blank">Download</a></td>
                        </tr>
                    </tbody>
                  </table>
            </div>

            <h2 class="mb-2 font-lilita">Loan Remarks : </h2>
            <div class="table-responsive mb-3">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Sno</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $sno=1;
                        @endphp
                        @if (count($remarkDetails)==0)
                                <tr>
                                    <td class="text-center" colspan="3">No Remark to Show !</td>
                                </tr>
                        @endif
                        @foreach ($remarkDetails as $item)
                            <tr>
                                <td>{{$sno}}</td>
                                <td>{{$statusArr[$item["status"]]}}</td>
                                <td>{{$item["remark"]}}</td>
                            </tr>
                        @php
                            $sno++;
                        @endphp
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