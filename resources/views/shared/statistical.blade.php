@extends('layout.master')

@section('title', 'Thống kê')

@section('content')
    <div class="cards">
        <div class="card-single">
            <div>
                <h1>{{ (($num_registration > 0 && $num_registration < 10) ? '0'.$num_registration : $num_registration) }}</h1>
                <span>Đăng ký</span>
            </div>
            <div>
                <span class="las la-video"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>{{ (($num_accept > 0 && $num_accept < 10) ? '0'.$num_accept : $num_accept) }}</h1>
                <span>Được chấp nhận</span>
            </div>
            <div>
                <span class="las la-check-square"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>{{ (($num_deny > 0 && $num_deny < 10) ? '0'.$num_deny : $num_deny) }}</h1>
                <span>Bị từ chối</span>
            </div>
            <div>
                <span class="las la-times-circle"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>{{ (($num_pending > 0 && $num_pending < 10) ? '0'.$num_pending : $num_pending) }}</h1>
                <span>Đang chờ duyệt</span>
            </div>
            <div>
                <span class="las la-hourglass"></span>
            </div>
        </div>
    </div>

    <div class="recent-grid grid-col-65">
        <div class="chart-statistical">
            <div class="card">
                <div class="card-header">
                    <h3>Thống kê năm</h3>
                </div>
                <div class="card-body">
                    <div width="100%">
                        <canvas id="myChart"></canvas>
                      </div>
                </div>
            </div>
        </div>

        <div class="list-statistical">
            <div class="card">
                <div class="card-header">
                    <h3>Thống kê chi tiết</h3>
                    <form action="" method="get">
                        <span class="filter">
                            <select name="filter" onchange="this.form.submit();">
                                <option value="all">Tất cả</option>
                                <option {{ request('filter') == 'week' ? 'selected' : '' }} value="week">Tuần này</option>
                                @foreach ($months as $month)
                                    <option {{ request('filter') == $month->month ? 'selected' : '' }} value="{{ $month->month }}">{{ date("m/y", strtotime($month->month)) }}</option>
                                @endforeach
                                
                            </select>
                        </span>
                    </form>
                </div>
                <div class="card-body">
                    <ul style="font-size: 13px">
                        <li>Số cuộc họp: <b>{{ $num_accept }}</b>
                            <ul> 
                                @foreach ($types as $type)
                                    <li class="ps-3">- {{ $type->name }}: <b>{{ $num_type_meeting[$type->id] }}</b></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>

    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#statistical').addClass('active');
    </script>
    <script>
        const labels = [
          'Th.1',
          'Th.2',
          'Th.3',
          'Th.4',
          'Th.5',
          'Th.6',
          'Th.7',
          'Th.8',
          'Th.9',
          'Th.10',
          'Th.11',
          'Th.12',
        ];
      
        const data = {
          labels: labels,
          datasets: [{
            label: 'Số cuộc họp trong tháng',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            barPercentage: 1,
            data: <?php echo json_encode($chartArr) ?>,
          }]
        };
      
        const config = {
          type: 'bar',
          data: data,
          options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
          }
        };
      </script>
      <script>
        const myChart = new Chart(
          document.getElementById('myChart'),
          config
        );
      </script>
@endsection