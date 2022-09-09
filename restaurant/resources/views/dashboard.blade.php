@extends('layouts.user_type.auth')

@section('content')

  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Money</p>
                <h5 class="font-weight-bolder mb-0">
                  +${{ $totalday }}
                  @if ($totalmonth!=0)
                  <span class="text-success text-sm font-weight-bolder">+{{ (int)(($totalday/$totalmonth)*100) }}%</span>
                  @endif
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Product</p>
                <h5 class="font-weight-bolder mb-0">
                 {{$todayproduct}}
                 @if ($monthproduct!=0)
                  <span class="text-success text-sm font-weight-bolder">+{{ (int)(($todayproduct/$monthproduct)*100) }}%</span>
                 @endif
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Month Money</p>
                <h5 class="font-weight-bolder mb-0">
                  +${{ $totalmonth }}
                  <span class="text-danger text-sm font-weight-bolder"></span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Month product</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ $monthproduct }}
                  <span class="text-success text-sm font-weight-bolder"></span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-lg-6">
              <div class="d-flex flex-column h-100">
                <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Designation</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Prix</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">QTE</th>
                        @if (Auth()->user()->role->role->designation == 'Developer')
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">admin</th>
                        @endif
                        <th class="text-secondary opacity-7"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($products  as $value)
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              {{-- <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1"> --}}
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $value->designation }}</h6>
                              <p class="text-xs text-secondary mb-0">{{ $value->cat->designation }}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ $value->prix }} DH</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-danger">out stock</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">{{ $value->qte }}</span>
                        </td>
                        @if (Auth()->user()->role->role->designation == 'Developer')
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">{{ $value->user->name }}</span>
                        </td>
                        @endif
                        <td  class="align-middle">
                          <a href="{{ route('product-edit', $value->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                              Edit
                          </a>


                        </td>
                      </tr>
                      @empty
                      <p>No content Add Product</p>
                      @endforelse

                    </tbody>
                  </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="card h-100 p-3">
        <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('../assets/img/ivancik.jpg');">
          <span class="mask bg-gradient-dark"></span>
          <div class="card-body position-relative z-index-1 p-3">
            <i class="fas fa-wifi text-white p-2"></i>
            <h5 class="text-white mt-4 mb-5 pb-2">{{ $cart->designation }}</h5>
            <div class="d-flex">
              <div class="d-flex">
                <div class="me-4">
                  <p class="text-white text-sm opacity-8 mb-0">{{ $cart->tanks }}</p>
                  {{-- <h6 class="text-white mb-0">Jack Peterson</h6> --}}
                </div>
                <div>
                  <p class="text-white text-sm opacity-8 mb-0">{{ $cart->name_wifi }}</p>
                  <h6 class="text-white mb-0">{{ $cart->password_wifi }}</h6>
                </div>
              </div>
              <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                {{-- <img class="w-60 mt-2" src="../assets/img/logos/mastercard.png" alt="logo"> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row my-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Employee</h6>
              <p class="text-sm mb-0">
                <i class="fa fa-check text-info" aria-hidden="true"></i>
                <span class="font-weight-bold ms-1"></span> this month
              </p>
            </div>
            {{-- <div class="col-lg-6 col-5 my-auto text-end">
              <div class="dropdown float-lg-end pe-4">
                <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-ellipsis-v text-secondary"></i>
                </a>
                <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                  <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                  <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                  <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                </ul>
              </div>
            </div> --}}
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employer</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Employer</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mony</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Completion</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($employer as $item)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="../assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm me-3" alt="xd">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $item->user->name }}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="avatar-group mt-2">
                      <a href="{{ route('user-edit',$item->user_id) }}" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $item->user->name }}">
                        <img src="../assets/img/team-2.jpg" alt="team2">
                      </a>
                    </div>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> {{ $item->total }}DH </span>
                  </td>
                  <?php
                  if($totalmonth!=0){
                     $ps = (int)(($item->total/$totalmonth)*100);
                    }
                   else {
                    $ps=0;
                   }

                   if($ps!=100){
                        $class='bg-gradient-info';
                    }
                    else {
                    $class='bg-gradient-success';
                    }
                   ?>
                  <td class="align-middle">
                    <div class="progress-wrapper w-75 mx-auto">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <span class="text-xs font-weight-bold">{{ $ps }}</span>
                        </div>
                      </div>
                      <div class="progress">
                        <div class="progress-bar {{ $class }} w-{{ $ps }}" role="progressbar" aria-valuenow="{{ $ps }}" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card h-100">
        <div class="card-header pb-0">
          <h6>Orders overview</h6>
          <p class="text-sm">
            <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
            <span class="font-weight-bold">${{ $totalday }}</span> this day
          </p>
        </div>
        <div class="card-body p-3">
          <div class="timeline timeline-one-side">
            @foreach ($day as $item)
               <div class="timeline-block mb-3">
              <span class="timeline-step">
                <i class="ni ni-bell-55 text-success text-gradient"></i>
              </span>
              <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0">${{ $item->total }}, {{ $item->designation }}</h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ $item->day }}</p>
              </div>
            </div>
            @endforeach


          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@push('dashboard')
  <script>
    window.onload = function() {
      var ctx = document.getElementById("chart-bars").getContext("2d");

      new Chart(ctx, {
        type: "bar",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
            label: "Sales",
            tension: 0.4,
            borderWidth: 0,
            borderRadius: 4,
            borderSkipped: false,
            backgroundColor: "#fff",
            data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
            maxBarThickness: 6
          }, ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: 500,
                beginAtZero: true,
                padding: 15,
                font: {
                  size: 14,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
                color: "#fff"
              },
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false
              },
              ticks: {
                display: false
              },
            },
          },
        },
      });


      var ctx2 = document.getElementById("chart-line").getContext("2d");

      var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
      gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

      var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
      gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

      new Chart(ctx2, {
        type: "line",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
              label: "Mobile apps",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#cb0c9f",
              borderWidth: 3,
              backgroundColor: gradientStroke1,
              fill: true,
              data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
              maxBarThickness: 6

            },
            {
              label: "Websites",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#3A416F",
              borderWidth: 3,
              backgroundColor: gradientStroke2,
              fill: true,
              data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
              maxBarThickness: 6
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#b2b9bf',
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#b2b9bf',
                padding: 20,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });
    }
  </script>
@endpush

