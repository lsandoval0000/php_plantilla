<?php

namespace App\Http\Controllers\Install;

use App\Models\User;
use App\Utiles\Instalador;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class InstallerController extends Controller
{
    public function __construct(){
        if(env("APP_INSTALLED",false)){
            return redirect('/');
        }
    }

    public function index()
    {
        $requerimientos = Instalador::verificarRequerimientos();
        return view('install.step_1',compact('requerimientos'));
    }

    public function database()
    {
        return view('install.step_2');
    }

    public function process_install(Request $request)
    {
		$host = $request->hostname;
		$database = $request->database;
		$username = $request->username;
		$password = $request->password;
		
		if(Instalador::createDbTables($host, $database, $username, $password) == false){
           return redirect()->back()->with("error","Las opciones de base de datos indicadas, son inválidas!");
		}
		
		return redirect('install/create_user');
    }

    public function create_user()
    {
		 return view('install.step_3');
    }
    
    public function store_user(UserRequest $request)
    {
        $data = $request->validated();
        
        $user = User::create($data);

        $rol = Role::where('name','Administrador')->first();
        
        $user->assignRole($rol);
        
		return redirect('install/system_settings');
    }

    public function system_settings()
    {
        return view('install.step_4');
    }

    public function final_touch(Request $request)
    {
        $valida = $request->validate([	
            'app_name' => 'required|string|max:255',
            'app_sigla' => 'required|string|size:3'
        ]);

        $data = [
            'APP_NAME' => "\"".$request->app_name."\"",
            'APP_SIGLA' => "\"".strtoupper($request->app_sigla)."\""
        ];
        Instalador::updateSettings($data);
        Instalador::finalTouches();
		return redirect()->route('index');
    }
}
