<?php

namespace App\Http\Controllers\Privado;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UsersRolesController extends Controller
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

        $usuario->syncRoles($request->roles);
        return back()->withFlash("Los roles han sido actualizados");
    }
}
