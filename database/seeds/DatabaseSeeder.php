<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$adminRole = Role::create(['name'=>'Administrador']);
			Role::create(['name'=>'Cajero']);
			Role::create(['name'=>'Vendedor']);
			Role::create(['name'=>'Mozo']);

			$ver_usuario = Permission::create(['name'=>'Ver usuarios registrados']);
			$editar_usuario = Permission::create(['name'=>'Modificar usuarios']);
			$crear_usuarios = Permission::create(['name'=>'Crear usuarios']);

			$ver_roles = Permission::create(['name'=>'Ver roles registrados']);
			$editar_roles = Permission::create(['name'=>'Modificar roles']);
			$crear_roles = Permission::create(['name'=>'Crear roles']);

			$adminRole->givePermissionTo($ver_usuario);
			$adminRole->givePermissionTo($editar_usuario);
			$adminRole->givePermissionTo($crear_usuarios);

			$adminRole->givePermissionTo($ver_roles);
			$adminRole->givePermissionTo($editar_roles);
			$adminRole->givePermissionTo($crear_roles);

			$admin =new User;
			$admin->first_name = 'admin';
			$admin->last_name = 'admin';
			$admin->email = 'admin@gmail.com';
			$admin->dni = '00000000';
			$admin->password = '123456';
			$admin->estado = 'Activo';
			$admin->save();

			$admin->assignRole($adminRole);
    }
}
