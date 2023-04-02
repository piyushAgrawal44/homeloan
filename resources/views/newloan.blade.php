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
        @if (Auth::check())
        <div class="col-12 col-md-6 offset-md-3 mb-4 mb-md-0">
            <img src="{{ asset('images/home.jpg') }}" class="home-image" alt="home">
        </div>
        <div class="col-12  align-self-center">
            <h1 class="font-lilita mb-3 text-center">Request a new loan now !</h1>


            <form class="" action="/newloan" method="POST" onsubmit="return requestLoan()" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label"><b>Your Name</b> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}" required readonly>
                    @error('name')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label"><b>Your Email</b> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" required readonly>
                    @error('email')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label"><b>Your Phone</b> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ Auth::user()->phone }}" required readonly>
                    @error('phone')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="loan_amt" class="form-label"><b>Loan Amt</b> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="loan_amt" id="loan_amt" value="{{ old('loan_amt') }}" required>
                    @error('loan_amt')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="loan_duration" class="form-label"><b>Loan Duration</b> <span class="text-danger">*</span></label>
                    <select class="form-select" name="loan_duration" required >
                        <option value="1">1 Year</option>
                        <option value="3">3 Year</option>
                        <option value="5">5 Year</option>
                        <option value="10">10 Year</option>
                      </select>
                    @error('loan_duration')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="job_type" class="form-label"><b>What type of job / work / business you do ?</b> <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" name="job_type" id="job_type" rows="3" required></textarea>
                    @error('job_type')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="annual_salary" class="form-label"><b>annual Salary</b> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="annual_salary" id="annual_salary" value="{{ old('annual_salary') }}" required>
                    @error('annual_salary')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                  <label for="address" class="form-label"><b>Full Address</b> <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}" required>
                  @error('address')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <p class="text-danger">Note- Maximum file size is 2 mb</p>
                <div class="mb-3">
                    <label for="address_proof" class="form-label"><b>Address Proof (Adhar Card only)</b> <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="address_proof" id="address_proof" required accept=".pdf,.docx,.docs,.png,.jpeg,.jpg">
                    @error('address_proof')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="user_photo" class="form-label"><b>Your Passport Photo (similar to Adhar Card)</b> <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="user_photo" id="user_photo"  required accept=".png,.jpeg,.jpg.pdf,.docx,.docs">
                    @error('user_photo')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <button type="submit" id="submit_btn" class="btn btn-primary btn-lg mb-3">Request Loan</button>
            </form>
           
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
            document.getElementById('customLoaderBox').style.visibility='visible';
            document.getElementById('submit_btn').disabled = true;

            return true;
        }
    </script>
@endpush
@endsection