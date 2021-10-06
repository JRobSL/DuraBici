<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    

public function loginVaidate(Request $request){


    $correo= $request->correo;
    $password =Hash::make($request->password);


    $user = DB::table('users')->where('email', $correo)->get();
        //$user =User::where('id', $correo);

    foreach($user as $row){

        if($row->email == $correo && $row->password == $password){

            return json_encode($user); 


        }

    }

//dd($correo,$password);
    

//    $user =User::where('email','like',%$correo%);





}



    public function busqueda($correo){

        
      $user = DB::table('users')->where('email', $correo)->get();
            //$user =User::where('id', $correo);

        $mesaje="";

        // foreach($user as $row){

        //     if($row->email == $correo && $row->password == $password)
        //         $mesaje= 'Correcto, credenciales coniciden';
       
        // }

            $data= array(
                'mensaje'  =>  $mesaje,
                'user'     =>  $user
            );

            return json_encode($data); 


    }

}
