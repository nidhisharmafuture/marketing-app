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

           <img src="{{ asset('superadmin/assets/images/faces/face1.jpg')}}" alt="profile" />
           @endif
           <span class="login-status online"></span>
           <!--change to offline or busy as needed-->
         </div>
         <div class="nav-profile-text d-flex flex-column">
           <span class="font-weight-bold mb-2">{{$name}}</span>
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
       <a class="nav-link" href="index.html">
         <span class="menu-title">Dashboard</span>
         <i class="mdi mdi-home menu-icon"></i>
       </a>
     </li>
     {{-- <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                  </li>
                </ul>
              </div>
            </li> --}}

     @if($role == 1)
     <li class="nav-item">
       <a class="nav-link" href="{{ route('admin.designer.list') }}">
         <span class="menu-title">Designers</span>
         <i class="mdi mdi-contacts menu-icon"></i>
       </a>
     </li>
     @endif

     @if($role == 1)
     <li class="nav-item">
       <a class="nav-link" href="{{route('admin.category.list')}}">
         <span class="menu-title">Categories</span>
         <i class="mdi mdi-format-list-bulleted menu-icon"></i>
       </a>

     </li>
     @endif

     {{-- <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <span class="menu-title">Charts</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
              <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a>
                  </li>
                </ul>
              </div>
            </li> --}}
     {{-- <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <span class="menu-title">Tables</span>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
              <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a>
                  </li>
                </ul>
              </div>
            </li> --}}

     @if($role == 1)
     <li class="nav-item">
       <a class="nav-link" href="{{route('admin.media.list')}}">
         <span class="menu-title">Media</span>
         {{-- <i class="menu-arrow"></i> --}}
         <i class="mdi mdi-lock menu-icon"></i>
       </a>

     </li>
     @endif

     @if($role == 1)
     <li class="nav-item">
       <a class="nav-link" href="{{route('admin.township.list')}}">
         <span class="menu-title">Townships</span>
         <i class="mdi mdi-table-large menu-icon"></i>
       </a>

     </li>
     @endif

      @if($role == 1)
     <li class="nav-item">
       <a class="nav-link" href="{{route('admin.team.list')}}">
         <span class="menu-title">Team</span>
         <i class="mdi mdi-table-large menu-icon"></i>
       </a>

     </li>
     @endif
   </ul>
 </nav>