<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;




class AuthController extends Controller
{
    

    public function index(){
        return view('auth.login');
    } 


    //Metodo de Login
    public function loginUser(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    //Funcion que revisa si la autenticacion es correcta, 
    //de ser así, se direcciona al Dashboard, si no redirecciona a la vista login  
    public function dashboard(){
        if(Auth::check()){
            return view('/dashboard');
        }
  
        return redirect("/login")->withSuccess('You are not allowed to access');
    }
     
  

  //Función para cerrar sesión

  public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('/login');
    }



    public function registro(){
        return view('auth.registro');
    }
      

    public function registroUsuario(Request $request){  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $usuario = $request->all();
        $check = $this->crearUsuario($usuario);
         
        return redirect("/dashboard")->withSuccess('You have signed-in');
    }


    public function crearUsuario(array $data){
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])//Encriptado de contraseña
      ]);
    }    



/**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
    
 
*/

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback($driver)
    {
        $user = Socialite::driver('facebook')->user();
        dd($user);
        // $user->token;
    }




}
