@extends('layouts.app')

@section('css')
   <!-- Select2 -->
  <link rel="stylesheet" href="../../admin-lte/bower_components/select2/dist/css/select2.min.css">
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
     

      <div class="alert alert-success alert-dismissible" style="display: none;" id="thanhcong">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
        <h4><i class="icon fa fa-check"></i> Kết Quả!</h4>
        Đã xóa thành công!  
      </div>
    
  </div>
</div>
  <div class="row" style="margin-top: 20px">
    <form action="{{ route('ViewPage') }}" method="POST">
      @csrf
    <div class="col-md-3 col-md-offset-1">
      <div class="form-group">
                <label>Chọn nick FaceBook</label>
                <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="select_nick" onchange="getPage()" name="nick">
                  <option selected disabled>--Chọn Nick--</option>
                  @foreach ($listToken as $element)
                   <option value="{{$element->id_userFB}}" > {{$element->name_FB}} </option>
                 
                  @endforeach  
                </select>
                {{ csrf_field() }}
                @if($errors->has('nick'))
                  <p style="color:red">{{$errors->first('nick')}}</p>
                  @endif
        </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
                <label>Chọn Trang cần xem</label>
                <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="Select_Page" name="page">
                  <option selected disabled>--Chọn Trang--</option>
                </select>
                @if($errors->has('page'))
                  <p style="color:red">{{$errors->first('page')}}</p>
                  @endif
        </div>
    </div>
    <div class="col-md-2" style="margin-top: 25px"> 
      <button class="btn btn-block btn-success" type="submit" style="background: #0B243B">
                <i class="fa fa-eye"></i> Xem
      </button>
    </div>
    </form>
  </div>
    
  
  <div class="row" style="margin-top:30px;"> {{-- Cột Bảng bài đã đăng --}}
        <div class="col-xs-12">
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách Bài viết của trang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>STT</th>
                  <th>Kiểu bài đăng</th>
                  <th>Caption</th>
                  <th>Xem trước</th>
                  <th>Like</th>
                  <th>CMT</th>
                  <th>Link</th>
                  <th>Thời gian</th>
                  <th>Delete</th>

                </tr>
                </thead>
                <tbody>

                  @if (session('data'))

                       @foreach (session('data')[0] as $key=>$info)
                        <tr id="{{ $info['id'] }}">
                          <td>{{$info['stt']}}</td>
                          <td>{{$info['type']}}</td>
                          <td> <p style="width: 200px;overflow: hidden;white-space: nowrap; text-overflow: ellipsis;">{{$info['caption']}}</p></td>
                          <td><img src="{{$info['img']}}" alt="" style="width:50px"></td>
                          <td>{{$info['reaction']}}</td>
                          <td>{{$info['cmt']}}</td>
                          <td><a href="{{$info['link']}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
                          <td>{{$info['time']}}</td>
                          {{-- <td><a href="{{ route('DeletePost',['id'=>$info['id'],'token'=>session('data')[2]]) }}">Delete</a></td> --}}
                          <td><button class="deleteRecord" data-id="{{ $info['id'] }}"  data-token_page="{{session('data')[2]}}" >Delete</button></td>
                        </tr>
                      @endforeach
                  @endif
                  
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
  </div> {{--End Cột Bảng bài đã đăng --}}
@if (session('data'))

<div class="row" style="margin-bottom: 20px;"> 
  <form action="{{ route('PaginationPre') }}" method="POST">
    @csrf
    <div class="col-md-2 col-md-offset-4">
      @if (isset(session('data')[1]['previous']))
      
      <button class="btn btn-block btn-success" type="submit" style="background: #3A2F0B;" name="link" value="{{session('data')[1]['previous']}}">
        <input type="hidden" name="token" value="{{session('data')[2]}}">
        <i class="fa fa-arrow-circle-left"></i> Quay lại
      </button>
      @endif
    </div>
  </form>
  <form action="{{ route('PaginationNext') }}" method="POST">
    @csrf
    @if (isset(session('data')[1]['next']))
    <div class="col-md-2 text-center">
      <button class="btn btn-block btn-success" type="submit" style="background: #3A2F0B; " name="link" value="{{session('data')[1]['next']}}">
        <i class="fa fa-arrow-circle-right"></i> Tiếp theo
      </button>
        <input type="hidden" name="token" value="{{session('data')[2]}}">
    </div>
    @endif
  </form>
</div>

@endif



</div>


@endsection


@push('scripts')
  
 <!-- Select2 -->
<script src="../../admin-lte/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
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
<script>
function getPage() {
  var nick = document.getElementById("select_nick");
  var id_user = nick.value;
  var _token = $('input[name="_token"]').val();
            $.ajax({
              url:"{{ route('StatisticleGetPage')}}",
              method:"POST",
              data:{ id_user:id_user, _token:_token},
              success:function(data){
                
                var list = data.listPage.data;
                list.forEach(listOption);
                function listOption(item,index){
                  var addOption = document.getElementById("Select_Page");
                  var option = document.createElement("option");
                  option.text = item['name'];
                  option.value = '/'+item['id']+'//'+item['access_token']+'/';
                  addOption.add(option);
                }                    
              }
            });

   
}

$(".deleteRecord").click(function(){

    var id = $(this).data("id");
    
    var token_page = $(this).data("token_page");
    var _token = $('input[name="_token"]').val();
    $.ajax(
    {
        url: "{{ route('DeletePostPage') }}",
        type: 'POST',
        data: {
            "id": id,
            "token_page": token_page,
            "_token": _token,
        },
        success: function (data){
            console.log(data);
            if (data.status=='success') {
              $('#'+id).remove();
              $('#thanhcong').removeAttr("style");
              setTimeout(function(){ $('#thanhcong').attr('style', 'display:none');},2000); 
            }
            
        }
    });
   
});
</script>
@endpush
