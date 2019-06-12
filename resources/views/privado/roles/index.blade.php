@extends('layout.main')

@section('content-header')
    <h1>
        Roles
        <small>Panel de control</small>
    </h1>
@endsection

@section('content')
	<div class="box">
			<div class="box-header">
				<h3 class="box-title">Listado de roles</h3>
				@can('Crear roles')
					<a href="{{ route('roles.create') }}" class="btn btn-primary pull-right">
							<i class="fa fa-plus"></i>
							Nuevo role
					</a>
				@endcan
			</div>
		<div class="box-body table-responsive">
			<div class="box-footer pull-right col-sm-3">
				<form method="get" action="{{ route('roles.buscar') }}">
					<input type="text" class="form-control" name="buscar" placeholder="Buscar...">
				</form>
			</div>
		  <table class="table table-bordered table-striped">
			<thead>
				<th>Nombre</th>
				<th>Permisos</th>
				<th>Acciones</th>
			</thead>
			<tbody>
				@forelse ($roles as $role)
					<tr>
						<td>{{ $role->name }}</td>
						<td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
						<td align="center">
							@can('Modificar roles')
								<a href="{{ route('roles.edit', $role) }}" class="btn btn-xs btn-info">
									<i class="fa fa-pencil"></i>
								</a>
							@else
								<span style="text-align: center;">No tiene opciones</span>
							@endcan
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="3" style="text-align: center;">
							No hay registros.
						</td>
					</tr>
				@endforelse
			</tbody>
		  </table>
		  <div class="box-footer clearfix pull-right">
				{{ $roles->appends(Request::all())->links() }}
			</div>
		</div>
	</div>
@endsection