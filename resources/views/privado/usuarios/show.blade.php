@extends('layout.main')

@section('content-header')
    <h1>
        Usuario
        <small>{{ $usuario->getFullName() }}</small>
    </h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-4">
			<div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="/img/avatar.png" alt="{{ $usuario->getFullName() }}">

              <h3 class="profile-username text-center">{{ $usuario->getFullName() }}</h3>

              <p class="text-muted text-center">{{ $usuario->getRoleNames()->implode(', ') }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>DNI</b> <a class="pull-right">{{ $usuario->dni }}</a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right">{{ $usuario->email }}</a>
                </li>
                <li class="list-group-item">
                  <b>Estado</b> <a class="pull-right">{{ $usuario->estado }}</a>
                </li>
                <li class="list-group-item">
                  <b>Fecha de registro</b> <a class="pull-right">{{ $usuario->created_at->format('d-m-Y') }}</a>
                </li>
							</ul>
							@if( auth()->user()->can('Modificar usuarios') || auth()->user()->id == $usuario->id )
								<a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-primary btn-block"><b>Editar</b></a>
							@endif
            </div>
            <!-- /.box-body -->
          </div>
		</div>
		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Roles</h3>
				</div>
				<div class="box-body">
					@forelse ($usuario->roles as $role)
						<strong>{{ $role->name }}</strong>
						@if($role->permissions->count())
							<br>
							<small class="text-muted">Permisos: {{ $role->permissions->pluck('name')->implode(', ') }}</small>
						@endif
						@unless($loop->last)
							<hr>
						@endunless
						@empty
							<small class="text-muted">No tiene roles</small>
					@endforelse
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Permisos adicionales</h3>
				</div>
				<div class="box-body">
					@forelse ($usuario->permissions as $permission)
						<strong>{{ $permission->name }}</strong>
						@unless($loop->last)
							<hr>
						@endunless
						@empty
							<small class="text-muted">No tiene permisos adicionales</small>
					@endforelse
				</div>
			</div>
		</div>
	</div>
@endsection