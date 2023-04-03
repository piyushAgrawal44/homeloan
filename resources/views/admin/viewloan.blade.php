@extends('admin.header')
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
        @if (Auth::check())
        @php
            $statusArr=["Unkown","Under Review","Approved",'Amount Transferred','Repayment Process',"Loan Finished"]
        @endphp
        <div class="col-12  align-self-center">

            <h2 class="mb-2 font-lilita">Loan Details :</h2>
            <h6 class="d-flex justify-content-between">
                <span>Interest Rate : 12% per Annum</span>
                <span>15 days EMI</span>
            </h6>
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
                            @php
                                $loan_id=$item['id'];
                                $loan_status=$item["status"];
                                $loan_amt=$item["loan_amt"];
                                $loan_duration=$item["loan_duration"]*12;
                            @endphp
                            <tr>
                                <td>{{$item["loan_amt"]}}</td>
                                <td>{{$item["loan_duration"]}} Years</td>
                                <td>{{$statusArr[$item["status"]]}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>

            <h2 class="mb-2 font-lilita">EMI Details :</h2>
            <div class="table-responsive mb-3">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Interest Rate</th>
                        <th scope="col">Months</th>
                        <th scope="col">EMI (per 15 days)</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($loanDetails as $item)
                            @php
                                $loan_amt=$item["loan_amt"];
                                $loan_duration=$item["loan_duration"]*12*2;
                                $interest_rate=12; //for 12%
                                $interest_rate=$interest_rate/1200;
                                $tempVariable=$interest_rate+1;
                                $tempVariable=pow($tempVariable,$loan_duration);
                                $denominator=$loan_amt*$tempVariable*$interest_rate;
                                $numerator=$tempVariable-1;
                                $emi=$denominator/$numerator; 
                            @endphp
                            <tr>
                                <td>12 %</td>
                                <td>{{$item["loan_duration"]*12}} Months</td>
                                <td>{{$emi}} Rs</td>
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
                        <th scope="col">Status</th>
                        <th scope="col">Remark</th>
                        <th scope="col">Time</th>
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
                                <td>{{$item["created_at"]}}</td>
                            </tr>
                        @php
                            $sno++;
                        @endphp
                        @endforeach
                    </tbody>
                  </table>
            </div>

            <h2 class="mb-2 font-lilita text-primary">Update Loan Status : </h2>
            <h6>Current Status: <span class=""><b><u>{{$statusArr[$loan_status]}}</u></b></span></h6>
            <form class="" action="/update/loan" method="POST" onsubmit="return updateLoan()">
                @csrf
                <label for="loan_status" class="form-label"><b>Loan Status</b> <span class="text-danger">*</span></label>
                <select class="form-select" name="loan_status" required >
                    <?php if ($loan_status!=1) {
                    ?>
                        <option value="1">Pending</option>
                    <?php
                        } 
                    if ($loan_status!=2) {
                    ?>
                        <option value="2">Approved</option>
                    <?php
                        } 
                        if ($loan_status!=3) {
                    ?>
                        <option value="3">Money Transferred</option>
                    <?php
                        } 

                        if ($loan_status!=4) {
                    ?>
                        <option value="4">Repayment Start</option>
                    <?php
                        } 
                        if ($loan_status!=5) {
                    ?>
                         <option value="5">Finished</option>
                    <?php
                        }
                    ?>

                    
                    
                    
                   
                  </select>
                @error('loan_status')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                
                <input type="text" name="loan_id" hidden class="d-none" readonly value="{{$loan_id}}">
                <input type="text" name="old_loan_status" hidden class="d-none" readonly value="{{$loan_status}}">
                <div class="mb-3">
                    <label for="remark" class="form-label"><b>Add Remark</b> <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="remark" id="remark" required>{{ old('remark') }}</textarea>
                    @error('remark')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
               
                <button type="submit" id="submit_btn" class="btn btn-primary btn-lg mb-2">Update</button>
            </form>
        </div>
        @else
            <a class="btn btn-primary btn-lg" href="/">Home Page</a>
        @endif
    </div>
</div>
    

@push('js')
    <script>
        function updateLoan(){
            let remark=document.getElementById("remark").value.trim();
            if (!remark || remark=="" || remark==" ") {
                alert("Remark can not be empty !");
                return false;
            }
            if (confirm("Are you sure !")) {
                return true;
            } else {
                return false;
            }
            return false;
        }
    </script>
@endpush
@endsection