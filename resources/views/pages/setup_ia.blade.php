@extends('layouts.app')

@section('css')
  {{-- chen css --}}
  <!-- DataTables -->
  <link rel="stylesheet" href={{asset("admin-lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css")}}>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href={{asset("admin-lte/dist/css/skins/_all-skins.min.css")}}>
@endsection


@section('content')
<div class="container">
    <div class="row">
           <div class="col-md-6 col-md-offset-3" style="margin-top:30px">
          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border text-center">
              <h3 class="box-title ">Cấu hình page IA</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if (isset($errorToken)&&$errorToken=='true')
                 <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Lỗi!</h4>
                    Kiểm tra lại token
                </div>
            @else 
                    <form role="form" action="{{ route('set_ia') }}" method="POST">
                  <!-- text input -->
                  @csrf               
                  <div class="form-group">
                    <label>Chọn trang </label>
                    <select class="form-control" name="page">
                      <option disabled selected>-- Chọn trang --</option>
                      @foreach ($pages as $page)
                        <option value={{$page['id']}}> {{$page['name']}} </option>
                      @endforeach                     
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Nhập domain liên kết với Page </label>
                    <input type="text" class="form-control" placeholder="http://example.com hoặc https://example.com" name="domain" >
                  </div> 
                  <div class="form-group">
                    <label>Nhập Id ADS </label>
                    <input type="text" class="form-control" placeholder="example 389373932077460_389373962077457 " name="id_ads" >
                  </div>
                  <div class="form-group">
                    <label>Nhập id Analytics </label>
                    <input type="text" class="form-control" placeholder='example "UA-178506002-1" 'name="id_analytics" >
                  </div> 
                  <div class="box-footer text-center">
                  <button type="submit" class="btn btn-primary">Set IA</button>
                </div>           
                </form>
                    @if (isset($status)&&$status == 'success')
                      <div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-check"></i> Thành công!</h4>
                          Cài đặt IA thành công
                      </div>
                    @elseif (isset($status)&&$status == 'failed')
                      <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-ban"></i> Thất bại!</h4>
                          Cài đặt IA thất bại, vui lòng thử lại
                      </div>
                    @endif
            @endif
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

    
            <!-- /.box-body -->
</div>
@endsection


@push('scripts')
        <!-- DataTables -->
<script src={{asset("admin-lte/bower_components/datatables.net/js/jquery.dataTables.min.js")}}></script>
<script src={{asset("admin-lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}></script>
<!-- SlimScroll -->
<script src={{asset("admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}></script>
<!-- FastClick -->
<script src={{asset("admin-lte/bower_components/fastclick/lib/fastclick.js")}}></script>
<!-- AdminLTE for demo purposes -->
<script src={{asset("admin-lte/dist/js/demo.js")}}></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endpush
