@extends('adminmodule::layouts.app')

@section('content')
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
          <i class="mdi mdi-home"></i>
        </span> Dashboard
      </h3>
      <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">
            <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
          </li>
        </ul>
      </nav>
    </div>

    <!-- STAT CARDS -->
    <div class="row">
      <!-- Teams -->
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
          <div class="card-body">
            <img src="{{ asset('superadmin/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
              alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Teams <i class="mdi mdi-account-group mdi-24px float-end"></i></h4>
            <h2 class="mb-5">{{$totalTeams}}</h2>
            <h6 class="card-text">Total Active Teams</h6>
          </div>
        </div>
      </div>
      <!-- Associates -->
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
            <img src="{{ asset('superadmin/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
              alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Associates <i class="mdi mdi-account-multiple mdi-24px float-end"></i>
            </h4>
            <h2 class="mb-5">{{$totalAssociates}}</h2>
            <h6 class="card-text">Verified Associates</h6>
          </div>
        </div>
      </div>
      <!-- Townships -->
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
          <div class="card-body">
            <img src="{{ asset('superadmin/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
              alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Townships <i class="mdi mdi-city mdi-24px float-end"></i></h4>
            <h2 class="mb-5">{{$totalTownships}}</h2>
            <h6 class="card-text">Active Projects</h6>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Designers -->
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-warning card-img-holder text-white">
          <div class="card-body">
            <img src="{{ asset('superadmin/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
              alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Designers <i class="mdi mdi-account-multiple mdi-24px float-end"></i>
            </h4>
            <h2 class="mb-5">{{$totalDesigners}}</h2>
            <h6 class="card-text">Registered Designers</h6>
          </div>
        </div>
      </div>
      <!-- Categories -->
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-secondary card-img-holder text-white">
          <div class="card-body">
            <img src="{{ asset('superadmin/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
              alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Categories <i class="mdi mdi-view-grid mdi-24px float-end"></i></h4>
            <h2 class="mb-5">{{$totalCategories}}</h2>
            <h6 class="card-text">Service Categories</h6>
          </div>
        </div>
      </div>
      <!-- Media -->
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-primary card-img-holder text-white">
          <div class="card-body">
            <img src="{{ asset('superadmin/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
              alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Media Files <i class="mdi mdi-image-multiple mdi-24px float-end"></i>
            </h4>
            <h2 class="mb-5">{{$totalMedia}}</h2>
            <h6 class="card-text">Uploaded Items</h6>
          </div>
        </div>
      </div>
    </div>

   <div class="row">
  <div class="col-md-7 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="clearfix">
          <h4 class="card-title float-start">User Signup Trends</h4>
          <div id="user-signup-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-end"></div>
        </div>
        <canvas id="user-signup-chart" class="mt-4"></canvas>
      </div>
    </div>
  </div>



   <div class="col-md-5 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Traffic Sources</h4>
      <div class="doughnutjs-wrapper d-flex justify-content-center">
        <canvas id="user-traffic-chart"></canvas>
      </div>
      <div id="user-traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
    </div>
  </div>
</div>




    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Recent Associates</h4>
            <div class="table-responsive">

              <table class="table">
                <thead>
                  <tr>
                    <th> Associate </th>
                    <th> Email </th>
                    <th> Status </th>
                    <th> Team </th>

                    <th> Last Updated </th>
                    <th> RERA Number </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($recentAssociates as $associate)
                  <tr>
                  <td> @if($associate->image == 1)
                      <img src="{{ asset('admin/' . $image) }}" class="me-2" alt="image">
                        @else
                      <img src="{{ asset('superadmin/assets/images/user.png')}}" class="me-2" alt="image">
                      @endif
                      {{ $associate->name }}
                    </td>
                    <td>{{ $associate->email }}</td>
                    <td>
                      @php
                      $status = strtolower($associate->status); // assuming 'status' field exists
                      @endphp
                      @if($status == 1)
                      <label class="badge badge-gradient-success">ACTIVE</label>

                      @elseif($status == 0)
                      <label class="badge badge-gradient-danger">INACTIVE</label>
                      @else
                      <label class="badge badge-gradient-info">UNKNOWN</label>
                      @endif
                    </td>
                                        <td>{{$associate->team}}</td>

                    <td>{{ $associate->updated_at->format('M d, Y') }}</td>
                    <td>{{$associate->rera_no}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>


      <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Recent Designers</h4>
            <div class="table-responsive">

              <table class="table">
                <thead>
                  <tr>
                    <th> Associate </th>
                    <th> Email </th>
                    <th> Status </th>
                    <th> Last Updated </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($recentDesigners as $associate)
                  <tr>
                    <td> @if($associate->image == 1)
                      <img src="{{ asset('admin/' . $image) }}" class="me-2" alt="image">
                        @else
                      <img src="{{ asset('superadmin/assets/images/user.png')}}" class="me-2" alt="image">
                      @endif
                      {{ $associate->name }}
                    </td>
                    <td>{{ $associate->email }}</td>
                    <td>
                      @php
                      $status = strtolower($associate->status); // assuming 'status' field exists
                      @endphp
                      @if($status == 1)
                      <label class="badge badge-gradient-success">ACTIVE</label>

                      @elseif($status == 0)
                      <label class="badge badge-gradient-danger">INACTIVE</label>
                      @else
                      <label class="badge badge-gradient-info">UNKNOWN</label>
                      @endif
                    </td>
                    <td>{{ $associate->updated_at->format('M d, Y') }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  

  @endsection

  @push('scripts')

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 <script>
  const months = @json($months);
  const associateCounts = @json($associateCounts);
  const designerCounts = @json($designerCounts);

  const userSignupData = {
    labels: months,
    datasets: [
      {
        label: 'Associates',
        data: associateCounts,
        borderColor: '#ff6b6b',
        backgroundColor: 'rgba(255, 107, 107, 0.3)',
        tension: 0.4,
        fill: true
      },
      {
        label: 'Designers',
        data: designerCounts,
        borderColor: '#1e90ff',
        backgroundColor: 'rgba(30, 144, 255, 0.3)',
        tension: 0.4,
        fill: true
      }
    ]
  };

  const userSignupConfig = {
    type: 'line',
    data: userSignupData,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Monthly User Registrations'
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          stepSize: 1
        }
      }
    }
  };

  document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('user-signup-chart')?.getContext('2d');
    if (ctx) {
      new Chart(ctx, userSignupConfig);
    }
  });
</script>

<script>
  const trafficData = {
    labels: ['Designers', 'Media', 'Teams', 'Townships', 'Associates', 'Categories'],
    datasets: [{
      data: [
        {{ $totalDesigners }},
        {{ $totalMedia }},
        {{ $totalTeams }},
        {{ $totalTownships }},
        {{ $totalAssociates }},
        {{ $totalCategories }}
      ],
      backgroundColor: [
        '#1f3bb3', // Designers
        '#00bcd4', // Media
        '#8e24aa', // Teams
        '#ff9800', // Townships
        '#4caf50', // Associates
        '#f44336'  // Categories
      ]
    }]
  };

  const trafficConfig = {
    type: 'doughnut',
    data: trafficData,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
        }
      }
    }
  };

  document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('user-traffic-chart')?.getContext('2d');
    if (ctx) {
      new Chart(ctx, trafficConfig);
    }
  });
</script>


@endpush
