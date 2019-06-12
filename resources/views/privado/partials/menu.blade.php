<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MENÚ</li>

  <li class="{{ setActiveRoute('home') }}">
    <a href="{{ route('home') }}">
      <i class="fa fa-th"></i> <span>Inicio</span>
    </a>
  </li>

  @if( auth()->user()->can('Ver usuarios registrados') || auth()->user()->can('Ver roles registrados') )
  <li class="treeview {{ setActiveRoute(['usuarios.index','usuarios.create','usuarios.edit','roles.index','roles.create','roles.edit']) }}">
    <a href="#">
      <i class="fa fa-users"></i> <span>Usuarios y Roles</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      @can('Ver usuarios registrados')
        <li class="{{ setActiveRoute('usuarios.index') }}"><a href="{{ route('usuarios.index') }}"><i class="fa fa-circle-o"></i> Ver usuarios</a></li>
      @endcan

      @can('Ver roles registrados')
        <li class="{{ setActiveRoute('roles.index') }}"><a href="{{ route('roles.index') }}"><i class="fa fa-circle-o"></i> Ver roles</a></li>
      @endcan
    </ul>
  </li>
  @endif

</ul>