<div class="form-group">
	<select class="form-control select2" name="roles[]" multiple="multiple" data-placeholder="Seleccione uno o más roles" style="width: 100%;">
		@foreach ($roles as $role)
			<option value="{{ $role->name }}" {{ ($model->roles->contains($role->id) or collect(old('roles'))->contains($role->name)) ? 'selected':'' }}>
				{{ $role->name }}
			</option>
		@endforeach
	</select>
</div>