@extends('admin.header')
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
        <div class="col-12  align-self-center">
            <h1 class="font-lilita mb-3 text-center">Loan History !</h1>


            <div class="table-responsive mb-3">
                <table class="table" id="loansTable">
                    <thead>
                      <tr>
                        <th scope="col">Sno</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Status</th>
                        <th scope="col">Request Date</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if (count($allLoan)==0)
                                <tr>
                                    <td class="text-center" colspan="4">No Loan to Show !</td>
                                </tr>
                        @endif
                        @php $sno=1; @endphp
                        @foreach ($allLoan as $loan)
                            <tr>
                                <td>{{$sno}}</td>
                                <td>{{$loan["loan_amt"]}}</td>
                                <td>{{$loan["loan_duration"]}} Years</td>
                                <td>{{$statusArr[$loan["status"]]}}</td>
                                <td>{{$loan["created_at"]}}</td>
                                <td><a class="text-decoration-none" href="/admin/loan/history/{{$loan["id"]}}"><i class="bi bi-eye"></i> View</a></td>
                            </tr>
                            @php $sno++; @endphp
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

        
      let table = new DataTable('#loansTable',{
        responsive: true
    });
    </script>
@endpush
@endsection