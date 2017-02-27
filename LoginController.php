<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller {

   public function index() {
      return view("frontend/login");
   }

   public function check(Request $request) {
      if ($_POST['type'] == 1) {
         $data = DB::table("student")->where("email", $_POST['email'])->where("password", $_POST['pass'])->paginate();
         foreach ($data as $d) {
            $request->session()->put("myid", $d->id);
            $request->session()->put("mytype", 's');
            $request->session()->put("mypicture", $d->picture);
            $request->session()->put("myname", $d->name);
            return redirect('/profile-management/view')->with('message', 'Save Successful');
         }
      } else if ($_POST['type'] == 2) {
         $data = DB::table("teacher")->where("email", $_POST['email'])->where("password", $_POST['pass'])->paginate();
         foreach ($data as $d) {
            $request->session()->put("myid", $d->id);
            $request->session()->put("mypicture", $d->picture);
            $request->session()->put("mytype", 't');
            return redirect('/profile-management/view')->with('message', 'Save Successful');
         }
      } else if ($_POST['type'] == 3) {
         $data = DB::table("administrator")->where("email", $_POST['email'])->where("password", $_POST['pass'])->paginate();
         foreach ($data as $d) {
            $request->session()->put("myid", $d->id);
            $request->session()->put("mypicture", $d->picture);
            $request->session()->put("mytype", 'a');
            return redirect('/profile-management/view')->with('message', 'Save Successful');
         }
      }
      return redirect('/login')->with('message', 'Invalid Email or Password');
   }
   
   public function logout(Request $request){
      $request->session()->flush();
      return redirect('/');
   }

}
