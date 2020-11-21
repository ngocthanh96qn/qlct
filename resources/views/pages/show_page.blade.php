@extends('layouts.app')

@section('css')
   <!-- Select2 -->
  <link rel="stylesheet" href="../../admin-lte/bower_components/select2/dist/css/select2.min.css">
@endsection


@section('content')
<div class="container">
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
                   <option value="435346346346" >Nick test</option>
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
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>

                  <th>Kiểu bài đăng</th>
                  <th>Caption</th>
                  <th>Xem trước</th>
                  <th>Link</th>
                  <th>Thời gian</th>
                  <th>Check IA</th>

                </tr>
                </thead>
                <tbody>

                  @if (session('data'))

                       @foreach (session('data')[0] as $info)
                        <tr>
                          <td>{{$info['type']}}</td>
                          <td> <p style="width: 200px;overflow: hidden;white-space: nowrap; text-overflow: ellipsis;">{{$info['caption']}}</p></td>
                          <td><img src="{{$info['img']}}" alt="" style="width:50px"></td>
                          <td><a href="{{$info['link']}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
                          <td>{{$info['time']}}</td>
                          <td><img src="{{$info['ia']}}" alt="" style="width:30px"></td>
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

<div class="row">
  <div class="col-md-2 col-md-offset-4">
      <button class="btn btn-block btn-success" type="submit" style="background: #0B243B">
                <i class="fa fa-eye"></i> Xem
      </button>
  </div>
  <div class="col-md-2 ">
      <button class="btn btn-block btn-success" type="submit" style="background: #0B243B">
                <i class="fa fa-eye"></i> Xem
      </button>
  </div>
</div>

</div>


@endsection


@push('scripts')
  
 <!-- Select2 -->
<script src="../../admin-lte/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../admin-lte/plugins/input-mask/jquery.inputmask.extensions.js"></script>

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
</script>
@endpush
