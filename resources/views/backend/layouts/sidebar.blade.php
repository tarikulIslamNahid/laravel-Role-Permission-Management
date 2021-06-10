@php
    $user =Auth::guard('admin')->user();
@endphp
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon">
        <img src="img/logo/logo2.png">
      </div>
      <div class="sidebar-brand-text mx-3">RuangAdmin</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link" href="{{route('admin.dashboard')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
      Features
    </div>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
        aria-expanded="true" aria-controls="collapseBootstrap">
        <i class="far fa-fw fa-window-maximize"></i>
        <span>Roles</span>
      </a>
      <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="{{route('admin.roles.index')}}">All Roles</a>
          <a class="collapse-item" href="{{route('admin.roles.create')}}">Create Role</a>

        </div>
      </div>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user"
          aria-expanded="true" aria-controls="user">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Users</span>
        </a>
        <div id="user" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('admin.users.index')}}">All Users</a>
            <a class="collapse-item" href="{{route('admin.users.create')}}">Create Users</a>

          </div>
        </div>
      </li>
      @if ($user->can('admin.create') || $user->can('admin.edit') || $user->can('admin.delete'))

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Admins"
          aria-expanded="true" aria-controls="Admins">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Admins</span>
        </a>
        <div id="Admins" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('admin.admins.index')}}">All Admins</a>
      @if ($user->can('admin.create'))

            <a class="collapse-item" href="{{route('admin.admins.create')}}">Create Admin</a>
            @endif

          </div>
        </div>
      </li>
@endif


  </ul>
