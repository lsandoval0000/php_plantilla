<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <img src="/img/avatar.png" class="user-image" alt="User Image">
    <span class="hidden-xs">{{ Auth::user()->getFullName() }}</span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">
      <img src="/img/avatar.png" class="img-circle" alt="User Image">

      <p>
        {{ Auth::user()->getFullName() }}
        <small>Miembro desde {{ Auth::user()->getRegisteredYear() }}</small>
      </p>
    </li>
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a href="{{ route('usuarios.show',Auth::user()->id) }}" class="btn btn-default btn-flat">Perfil</a>
      </div>
      <div class="pull-right">
        <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            Salir
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </div>
    </li>
  </ul>
</li>