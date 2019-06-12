<?php

namespace App\Http\Controllers\Privado;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsertUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsuariosController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view',new User);

        $users = User::with('roles')->paginate(10);
        return view("privado.usuarios.index", compact('users'));
    }
    
    public function buscar(Request $request)
    {
        $this->authorize('view',new User);
        
        $buscar = '';
        if($request->has('buscar')){
            $buscar = $request->buscar;
        }
        $users = User::where('first_name','LIKE','%'.$buscar.'%')
                ->orWhere('last_name','LIKE','%'.$buscar.'%')
                ->orWhere('dni','LIKE','%'.$buscar.'%')
                ->orWhere('email','LIKE','%'.$buscar.'%')
                ->orWhereHas('roles',function($query) use ($buscar){
                    $query->where('name','LIKE','%'.$buscar.'%');
                })->with('roles')->paginate(10);
        return view("privado.usuarios.index", compact('users'));;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',new User);

        $usuario = new User;
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        return view('privado.usuarios.create', compact('usuario','roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsertUserRequest $request)
    {
        $this->authorize('create',new User);

        $data = $request->validated();

        $user = User::create($data);

        $user->assignRole($request->roles);

        $user->givePermissionTo($request->permissions);

        return redirect()->route('usuarios.index')->withFlash('El usuario ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        $this->authorize('view',$usuario);

        return view('privado.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        $this->authorize('update',$usuario);

        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name','id');
        return view('privado.usuarios.edit', compact('usuario','roles','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $usuario)
    {
        $this->authorize('update',$usuario);

        $usuario->update( $request->validated() );

        return back()->withFlash('Usuario actualizado');
    }
}
