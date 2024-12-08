<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard() {
        Session::put('page', 'dashboard');
        return view('admin.dashboard');
    }

    public function login(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|max:20'
            ];

            $messages = [
                'email.required' => "Email is required",
                'email.email' => "Valid email is required",
                'password.required' => "Password is required"
            ];

            $this->validate($request, $rules, $messages);

            if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password']])) {
                if(isset($data['remember']) && !empty($data['remember'])) {
                    setcookie("email", $data['email'], time()+36000);
                    setcookie("password", $data['password'], time()+36000);
                } else {
                    setcookie("email", "");
                    setcookie("password", "");
                }

                return redirect("admin/dashboard");
            } else {
                return redirect()->back()->with("error_message", "Invalid Credentials");
            }
        }
        return view('admin.login');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function updatePassword(Request $request) {
        Session::put('page', 'updatePassword');
        if($request->isMethod("post")) {
            $data = $request->all();

            if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                if($data['new_password'] == $data['confirm_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message', 'Password updated successfully!');
                } else {
                    return redirect()->back()->with('error_message', 'Password does not match!');
                }
            } else {
                return redirect()->back()->with('error_message', 'Current password is incorrect!');
            }
        }
        return view("admin.update_password");
    }

    public function checkCurrentPassword(Request $request) {
        $data = $request->all();
        if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updateDetails(Request $request) {
        Session::put('page', 'updateDetails');
        if($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                'admin_mobile' => 'required|numeric',
            ];

            $messages = [
                'admin_name.required' => "Name is required",
                'admin_mobile.required' => "Mobile is required",
                'admin_mobile.numeric' => "Numbers only for mobile",
            ];

            $this->validate($request, $rules, $messages);

            Admin::where('email', Auth::guard('admin')->user()->email)->update(['name'=>$data['admin_name'], 'mobile'=>$data['admin_mobile']]);
            return redirect()->back()->with('success_message', 'Details updated successfully!');
        }
        return view('admin.update_details');
    }
}
