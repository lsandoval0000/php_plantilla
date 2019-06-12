<?php

namespace App\Http\Controllers\Privado;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersPermissionsController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        $this->authorize('update', new Role);
        
        $usuario->syncPermissions($request->permissions);
        return back()->withFlash("Los permisos han sido actualizados");
    }
}
