<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\modelos\OtroDatoUsuario;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    protected function registered(Request $request)
    {
        // dd($request->all());

        $usuario=User::all()->last();
       
        $contents = \Storage::get('default-profile-pic.png');
        \Storage::put($usuario->id.'/foto_perfil/default-profile-pic.png', $contents);
        $foto_usuario=new OtroDatoUsuario;     
        $foto_usuario->usuario_id = $usuario->id;
        $foto_usuario->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $foto_usuario->updated_at = Carbon::now()->format('Y-m-d H:i:s'); 
        $foto_usuario->foto_perfil="default-profile-pic.png";
        $foto_usuario->save(); 

        return redirect()->action('AdminController@dashboard');
    }


    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'id_wallet' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'apellido' => $data['apellido'],
            'id_wallet' => $data['id_wallet'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
