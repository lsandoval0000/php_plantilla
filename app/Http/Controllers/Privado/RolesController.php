<?php

namespace App\Http\Controllers\Privado;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view',new Role);

        $roles = Role::with('permissions')->paginate(5);
        return view('privado.roles.index',compact('roles'));
    }

    public function buscar(Request $request)
    {
        $this->authorize('view',new Role);
        
        $buscar = '';
        if($request->has('buscar')){
            $buscar = $request->buscar;
        }
        $roles = Role::where('name','LIKE','%'.$buscar.'%')
                ->orWhereHas('permissions',function($query) use ($buscar){
                    $query->where('name','LIKE','%'.$buscar.'%');
                })->with('permissions')->paginate(5);
        return view("privado.roles.index", compact('roles'));;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',new Role);

        $role = new Role;
        $permissions = Permission::pluck('name','id');
        return view('privado.roles.create',compact('permissions','role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->authorize('create',new Role);

        $data = $request->validate([
            'name' => 'required|unique:roles'
        ]);

        $role = Role::create($data);

        $role->givePermissionTo($request->permissions);
        
        return redirect()->route('roles.index')->withFlash('El role fue creado satisfactoriamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);

        $permissions = Permission::pluck('name','id');
        return view('privado.roles.edit',compact('permissions','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);
        
        $data = $request->validate([
            'name' => ['required',Rule::unique('roles')->ignore($role->id)]
        ]);

        $role->update($data);

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->withFlash('El role fue actualizado satisfactoriamente.');
    }
}
