<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function index()
    {
      return view('login');
    }

    public function login(request $request) {
      $username = $request['username'];
      $password = md5($request['password']);
      $status = DB::table('admins')
                    ->where('username',$username)
                    ->where('password',$password)
                    ->count();
      if($status > 0) {
          $status = DB::table('admins')
                        ->where('username',$username)
                        ->where('password',$password)
                        ->get()
                        ->first();
          $request->session()->put('id', $status->id);
          $request->session()->put('nama', $status->nama);
          $request->session()->put('role', $status->role);
          $request->session()->put('login_status', true);
          return redirect('dashboard');
      } else {
          $request->session()->flush();
          $request->session()->flash('status', 'Username or Password is wrong!');
          return redirect('login');
      }
    }

    public function logout(request $request){
      $request->session()->flush();
      return redirect('login');
    }
}
