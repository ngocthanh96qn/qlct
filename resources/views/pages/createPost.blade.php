@extends('layouts.app')

@section('css')
    <!-- DataTables -->
  <link rel="stylesheet" href="../../admin-lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endsection


@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
     @if (session()->has('status'))
      @php
         $status = Session::get('status');
      @endphp 
      @if ($status['kq']=='success')
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
        <h4><i class="icon fa fa-check"></i> Kết Quả!</h4>
        {{$status['text']}}   
      </div>
      @endif
    
    @if ($status['kq']=='failed')
     <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
      <h4><i class="icon fa fa-ban"></i> Thất Bại!</h4>
      {{$status['text']}} 
    </div>
    @endif

    

    @endif
  </div>
</div>
    <div class="row" >
           <div class="col-md-6" style="margin-top:30px">
          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border text-center">
              <h3 class="box-title ">Tạo bài viết mới</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <form role="form" action="{{ route('PostToPage') }}" method="POST">
                <!-- text input -->
                @csrf   
                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-file-text-o"></i> Caption </label>
                  <input type="text" class="form-control" id="inputSuccess" placeholder="Bạn đang nghĩ gì? ..." name="caption" value="{{old('caption')}}">
                </div>            
                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-link"></i> Nhập Link </label>
                  <input type="text" class="form-control" id="inputSuccess" placeholder="Link ..." name="link" value="{{old('link')}}" >
                  @if($errors->has('link'))
                  <p style="color:red">{{$errors->first('link')}}</p>
                  @endif
                </div>

                <div class="box-footer text-center form-group has-warning">
                  <label class="control-label"><i class="fa fa-bolt"></i> Chọn Trang </label>

                  @if($errors->has('pages'))
                  <p style="color:red">{{$errors->first('pages')}}</p>
                  @endif

                </div>

                @foreach ($pages as $page)
                <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="pages[{{$page->id_page}}]" value="{{$page->account}}">
                      {{$page->name}} <p style="color: #013ADF">FB: {{$page->account}}</p>
                    </label>
                  </div>
                </div>
                @endforeach
                
                <div class="box-footer text-center">
                  <button type="submit" class="btn btn-primary"> Đăng </button>
                </div>           
              </form>
   
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>  {{-- end col --}}
         <div class="col-md-5" style="margin-top:30px">
                    <div class="box box-warning">
            <div class="box-header with-border text-center">
              <h3 class="box-title ">Xem trước bài viết</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body text-center" style="font-size: 20px">
               coming soon!!!
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>      {{-- end row --}}

     <div class="row" style="margin-top:30px;"> {{-- Cột Bảng bài đã đăng --}}
        <div class="col-xs-12">
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Các bài đã đăng của {{Auth::user()->name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>

                  <th>Caption</th>
                  <th>Tên Trang</th>
                  <th>Tài khoản FB</th>
                  <th>Link</th>
                  <th>Thời gian</th>
                  <th>Xóa bài</th>

                </tr>
                </thead>
                <tbody>

                @foreach ($infoArticles as $infoArticle)
                <tr>
                  <td> <p style="width: 200px;overflow: hidden;white-space: nowrap; text-overflow: ellipsis;">{{$infoArticle->caption}}</p></td>
                  <td>{{$infoArticle->name_page}}</td>
                  <td>{{$infoArticle->account}}</td>
                  <td> <a href="https://facebook.com/{{$infoArticle->link}}" target="_blank">Xem</a></td>
                  <td>{{$infoArticle->created_at}}</td>
                  <td><span class="label label-danger"><a href="{{ route('DeletePost',$infoArticle->id) }}" style="color:white;">Delete</a></span></td>

                </tr>
                @endforeach
                
                
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div> {{--End Cột Bảng bài đã đăng --}}

</div>

@endsection


@push('scripts')
  
  <!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

<!-- DataTables -->
<script src="../../admin-lte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../admin-lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../admin-lte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<!-- AdminLTE for demo purposes -->
<script src="../../admin-lte/dist/js/demo.js"></script>
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

