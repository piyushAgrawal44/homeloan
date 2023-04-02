<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator as Validator;

use App\Models\User;
use App\Models\UserDetails;
use App\Models\Loan;
use App\Models\LoanRemarks;

class LoanController extends Controller
{
    //
    function newLoan(Request $request){
        $user_id=Auth::user()->id;
        $validatedData = $request->validate([
            'loan_amt' => ['required'],
            'loan_duration' => ['required'],
            'job_type' => ['required'],
            'annual_salary' => ['required'],
            'address' => ['required'],
            'address_proof' => ['mimes:pdf,png,jpg,jpeg,docs,docx', 'max:2048'],
            'user_photo' => ['mimes:pdf,png,jpeg,jpg,docs,docx', 'max:2048'],
        ]);
        $loanData=$request->all();
        $loan_amt=$loanData["loan_amt"];
        $loan_duration=$loanData["loan_duration"];
        $job_type=$loanData["job_type"];
        $annual_salary=$loanData["annual_salary"];
        $address=$loanData["address"];

       
        try {
             if(Loan::where('user_id', '=', $user_id)->where('status','!=',5)->exists()) {
                return back()->withErrors(['message' => 'Can not request new loan because you already have a pending loan !']);
             }
             $time=time(); 
             $filenameWithExt = $request->file('address_proof')->getClientOriginalName(); //filename with ext
             $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); //get just filename
             $extension = $request->file('address_proof')->getClientOriginalExtension(); //get just ext
             $address_proof = "adarh_card_". $time . '.' . $extension; //filename to store
             $request->file('address_proof')->storeAS('public/uploads', $address_proof); //upload image
     
             $filenameWithExt = $request->file('address_proof')->getClientOriginalName(); //filename with ext
             $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); //get just filename
             $extension = $request->file('address_proof')->getClientOriginalExtension(); //get just ext
             $photo = "photo_". $time . '.' . $extension; //filename to store
             $request->file('address_proof')->storeAS('public/uploads', $photo); //upload image
     
             

            $user = UserDetails::updateOrCreate(['user_id' => $user_id],[
                'job_type'        => $job_type,
                'annual_salary'    => $annual_salary,
                'address'         => $address,
                'address_proof'   => $address_proof,
                'photo'           => $photo
            ]);

            if (!$user) {
                return back()->withErrors(['message' => 'Internal Server Error !']);
            }

            $loan = Loan::create([
                'user_id'           => $user_id,
                'loan_amt'          => $loan_amt,
                'loan_duration'     => $loan_duration,
                'status'            => 1
            ]);

            if (!$loan) {
                return back()->withErrors(['message' => 'Internal Server Error !']);
            }
            return view("home")->with('success', ('Request for loan submitted successfully !'));

        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Internal Server Error !']);
        }
       
    }

    function loanHistory(){
        try {
            $userId=Auth::user()->id;

            $loanDetails = Loan::select('id','loan_amt','loan_duration','status')->where('user_id','=', $userId)->get();
            if (isset($loanDetails[0])) {
                return view("loanhistory",compact('loanDetails'));
            } else {
                $loanDetails=[];
                return view("loanhistory",compact('loanDetails'));
            }
            
        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Internal Server Error !']);
        }
    }

    function loanDetails($id){
        try {
            $userId=Auth::user()->id;

            $loanDetails = Loan::select('id','loan_amt','loan_duration','status')->where('id','=', $id)->where('user_id','=', $userId)->get();
            $userDetails = UserDetails::select('id','job_type','annual_salary','address','address_proof','photo')->where('user_id','=', $userId)->get();
            $remarkDetails = LoanRemarks::select('id','status','remark','created_at')->where('loan_id','=', $id)->get();
            return view("loanDetails",compact('loanDetails','userDetails','remarkDetails'));
            
            
        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Internal Server Error !']);
        }
    }
}
