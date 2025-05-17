<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    @php
    $role = Auth::user()->role;
    $name = Auth::user()->name;
    $image = Auth::user()->image;
    @endphp

    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          @if ($image)
            <img src="{{ asset('admin/' . $image) }}" id="output" alt="Admin Image" />
          @else
            <img src="{{ asset('superadmin/assets/images/user.png')}}" alt="profile" />
          @endif
          <span class="login-status online"></span>
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">{{ $name }}</span>
          @if($role == 1)
            <span class="text-secondary text-small">Admin</span>
          @elseif($role == 2)
            <span class="text-secondary text-small">Designer</span>
          @endif
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>

    <li class="nav-item">
      @if($role == 1)
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
        </a>
      @elseif($role == 2)
        <a class="nav-link" href="{{ route('designer.dashboard') }}">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
        </a>
      @endif
    </li>

    @if($role == 1)
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.designer.list') }}">
          <span class="menu-title">Designers</span>
          <i class="mdi mdi-palette menu-icon"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.associate.list') }}">
          <span class="menu-title">Associates</span>
          <i class="mdi mdi-account-multiple menu-icon"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.category.list') }}">
          <span class="menu-title">Categories</span>
          <i class="mdi mdi-tag-multiple menu-icon"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.media.list') }}">
          <span class="menu-title">Media</span>
          <i class="mdi mdi-play-box-multiple menu-icon"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.township.list') }}">
          <span class="menu-title">Townships</span>
          <i class="mdi mdi-city menu-icon"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.team.list') }}">
          <span class="menu-title">Team</span>
          <i class="mdi mdi-account-group menu-icon"></i>
        </a>
      </li>
    @endif

  </ul>
</nav>
