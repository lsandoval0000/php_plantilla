<?php

namespace App\Http\Controllers\Privado;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
