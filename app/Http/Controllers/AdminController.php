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

class AdminController extends Controller
{
   function dashboard(){
    try {
        $userId=Auth::user()->id;
        $userRole=Auth::user()->role;

        
        if ($userRole==1) {
            $allLoan = Loan::select('id','status')->get();
            $allUser = User::select('id','active')->where('role',2)->get();
            return view("admin.dashboard",compact('allLoan','allUser'));
        } else {
            return back()->withErrors(['message' => 'Access Denied']);
        }
        
       
    } catch (\Throwable $th) {
        return back()->withErrors(['message' => 'Internal Server Error !']);
    }
   }

   function loanAnalytics(){
    try {
        $userId=Auth::user()->id;
        $userRole=Auth::user()->role;

        
        if ($userRole==1) {
            $allLoan = Loan::select('id','loan_amt','loan_duration','status','created_at')->orderBy('created_at','desc')->get();
            return view("admin.allloan",compact('allLoan'));
        } else {
            return back()->withErrors(['message' => 'Access Denied']);
        }
        
       
    } catch (\Throwable $th) {
        return back()->withErrors(['message' => 'Internal Server Error !']);
    }
   }

   function loanDetails($id){
        try {
            $adminId=Auth::user()->id;
            $userRole=Auth::user()->role;
            
            if ($userRole==1) {
                $loanDetails = Loan::select('id','loan_amt','loan_duration','status')->where('id','=', $id)->get();
                $userDetails = UserDetails::select('user_details.id','job_type','annual_salary','address','address_proof','photo')->join('loan', 'loan.user_id', '=', 'user_details.user_id')->where('loan.id', $id)->get();
                $remarkDetails = LoanRemarks::select('id','status','remark','created_at')->where('loan_id','=', $id)->get();
                return view("admin.viewLoan",compact('loanDetails','userDetails','remarkDetails'));
            } else {
                return back()->withErrors(['message' => 'Access Denied']);
            }

        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Internal Server Error !']);
        }
    }

    function updateLoan(Request $request){
        try {
            $adminId=Auth::user()->id;
            $userRole=Auth::user()->role;
            $request->validate([
                'loan_status' => ['required'],
                'remark' => ['required'],
                'loan_id'=>['required']
            ]);
            $data=$request->all();
            $old_loan_status=$data["old_loan_status"];
            $loan_status=$data["loan_status"];
            $remark=$data["remark"];
            $loan_id=$data["loan_id"];
            if ($userRole==1) {
                if ($old_loan_status!=$loan_status) {
                        Loan::where('id', $loan_id)->update([
                        'status' => $loan_status
                        ]);
        
                        $user = LoanRemarks::create([
                            'loan_id'          => $loan_id,
                            'status'         => $loan_status,
                            'remark'         => $remark
                        ]);
                        return redirect('/dashboard')->with('success', ('Loan Status Updated Successfully !'));
                } else {
                    return back()->withErrors(['message' => 'Can not update the same status !']);
                }
                

                
            } else {
                return back()->withErrors(['message' => 'Access Denied']);
            }

        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Internal Server Error !']);
        }
    }
}
