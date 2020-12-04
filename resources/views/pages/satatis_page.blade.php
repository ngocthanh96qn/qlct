@extends('layouts.app')
	@section('css')
		<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	@endsection

@section('content')
	<div class="container">
		<div class="row">
			<h3>Thống kê theo ngày</h3>
			<hr>
		</div>
		<div class="row">
			<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53</h3>
              <p>Bài Đăng Hôm Nay</p>
            </div>
            <div class="icon">
              <i class="ion ion-compose"></i>
            </div>
            <a href="#" class="small-box-footer"> Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>Tổng số người tiếp cận</p>
            </div>
            <div class="icon">
              <i class="ion ion-eye"></i>
            </div>
            <a href="#" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>Tổng Like bài viết</p>
            </div>
            <div class="icon">
              <i class="ion ion-thumbsup"></i>
            </div>
            <a href="#" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3>150</h3>

              <p>Tổng Like Page</p>
            </div>
            <div class="icon">
              <i class="ion ion-flag"></i>
            </div>
            <a href="#" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
		</div> {{-- end row --}}
		<div class="row">
			<h3>Thống kê theo tuần</h3>
			<hr>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<figure class="highcharts-figure">
  					<div id="container"></div>
				</figure>
			</div>
				<input type="hidden" id="hdnSession" data-value="{{$data_page}}" />
				{{-- <input type="hidden" id="hdnSession" data-value="{{$mang_data}}" /> --}}
		</div>
		
		<div class="row">
			<h3>Thống kê theo tuần</h3>
			<hr>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<figure class="highcharts-figure">
  					<div id="container1"></div>
				</figure>
			</div>
				<input type="hidden" id="hdnSession1" data-value="{{$data_page}}" />
				{{-- <input type="hidden" id="hdnSession" data-value="{{$mang_data}}" /> --}}
		</div>

	</div>
@endsection

@push('scripts')
<script type="text/javascript">
	var sessionValue= $("#hdnSession").data('value');
	var data_page= sessionValue;
	var data_ngay = [
      'Monday',
      'Tuesday',
      'Wednesday',
      'Thursday',
      'Friday',
      'Saturday',
      'Sunday1'
    ];
	Highcharts.chart('container', {
  chart: {
    type: 'areaspline'
  },
  title: {
    text: 'Tống kê bài đăng 7 ngày trước'
  },
  legend: {
    layout: 'vertical',
    align: 'left',
    verticalAlign: 'top',
    x: 150,
    y: 100,
    floating: true,
    borderWidth: 1,
    backgroundColor:
      Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
  },
  xAxis: {
    categories: data_ngay,
    plotBands: [{ // visualize the weekend
      from: 4.5,
      to: 6.5,
      color: 'rgba(68, 170, 213, .2)'
    }]
  },
  yAxis: {
    title: {
      text: 'Số bài đăng'
    }
  },
  tooltip: {
    shared: true,
    valueSuffix: ' Bài đăng'
  },
  credits: {
    enabled: false
  },
  plotOptions: {
    areaspline: {
      fillOpacity: 0.5
    }
  },
  series: data_page
});
</script>

	<script type="text/javascript">
	var sessionValue= $("#hdnSession1").data('value');
	var data_page= sessionValue;
	var data_ngay = [
      'Monday',
      'Tuesday',
      'Wednesday',
      'Thursday',
      'Friday',
      'Saturday',
      'Sunday1'
    ];
	Highcharts.chart('container1', {
  chart: {
    type: 'areaspline'
  },
  title: {
    text: 'Tống kê bài đăng 7 ngày trước'
  },
  legend: {
    layout: 'vertical',
    align: 'left',
    verticalAlign: 'top',
    x: 150,
    y: 100,
    floating: true,
    borderWidth: 1,
    backgroundColor:
      Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
  },
  xAxis: {
    categories: data_ngay,
    plotBands: [{ // visualize the weekend
      from: 4.5,
      to: 6.5,
      color: 'rgba(68, 170, 213, .2)'
    }]
  },
  yAxis: {
    title: {
      text: 'Số bài đăng'
    }
  },
  tooltip: {
    shared: true,
    valueSuffix: ' Bài đăng'
  },
  credits: {
    enabled: false
  },
  plotOptions: {
    areaspline: {
      fillOpacity: 0.5
    }
  },
  series: data_page
});
</script>

@endpush