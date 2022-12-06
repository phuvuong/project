<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Admin;
use App\Roles;

class AuthController extends Controller
{
        public function register_auth(){
            return view('admin.auth.register');
        }
        public function login_auth() {
            return view('admin_login');
        }
        public function logout_auth() {
            Auth::logout();
            return redirect('/login-auth')->with('message', 'You have disconnected');

        }
        public function login(Request $request){
            $this->validate($request, [

                'admin_email'=> 'required|email|max:255',
                'admin_password'=> 'required|max:255',

            ]);
            // $data = $request->all();
            if(Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password]))
            {
                return redirect('/dashboard');
            }else
            {
                return redirect('/login-auth')->with('message', 'You have disconnected. Please try again');
            }
        }
        public function register(Request $request){
            
            $this->validation($request);
            $data = $request->all();
            $admin = new Admin();
            $admin ->admin_name = $data['admin_name'];
            $admin ->admin_phone = $data['admin_phone'];
            $admin ->admin_email = $data['admin_email'];
            $admin ->admin_password = md5($data['admin_password']);
            $admin->save();
            return redirect('/register-auth')->with('message','OK');
        }

        public function validation($request){
            return $this->validate($request, [

                'admin_name'=> 'required|max:255',
                'admin_phone'=> 'required|max:10',
                'admin_email'=> 'required|email|max:255',
                'admin_password'=> 'required|max:255',

            ]);
        }
        

}
