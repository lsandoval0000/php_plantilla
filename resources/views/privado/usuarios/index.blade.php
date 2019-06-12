@extends('layout.main')

@section('content-header')
		<h1>
				Usuarios
				<small>Panel de control</small>
		</h1>
@endsection

@section('content')
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Listado de usuarios</h3>
			@can('Crear usuarios')
				<a href="{{ route('usuarios.create') }}" class="btn btn-primary pull-right">
					<i class="fa fa-plus"></i>
					Nuevo Usuario
				</a>
			@endcan
		</div>
		<div class="box-body table-responsive">
			<div class="box-footer pull-right col-sm-3">
				<form method="get" action="{{ route('usuarios.buscar') }}">
					<input type="text" class="form-control" name="buscar" placeholder="Buscar...">
				</form>
			</div>
			<table class="table table-bordered table-striped">
			<thead>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>Email</th>
				<th>DNI</th>
				<th>Estado</th>
				<th>Roles</th>
				<th>Acciones</th>
			</thead>
			<tbody>
				@forelse ($users as $user)
					<tr>
						<td>{{ $user->first_name }}</td>
						<td>{{ $user->last_name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->dni }}</td>
						<td>{{ $user->estado }}</td>
						<td>{{ $user->getRoleNames()->implode(', ') }}</td>
						<td align="center">
							<a href="{{ route('usuarios.show', $user) }}" class="btn btn-xs btn-default">
								<i class="fa fa-eye"></i>
							</a>
							@can('Modificar usuarios')
								<a href="{{ route('usuarios.edit', $user) }}" class="btn btn-xs btn-info">
									<i class="fa fa-pencil"></i>
								</a>
							@endcan
						</td>
					</tr>
				@empty
					<tr>
						<td style="text-align: center;" colspan="7">
							No hay registros.
						</td>
					</tr>
				@endforelse
			</tbody>
			</table>
			<div class="box-footer clearfix pull-right">
				{{ $users->appends(['buscar'=>Request::all()])->links() }}
			</div>
		</div>
	</div>
@endsection