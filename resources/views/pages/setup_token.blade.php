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
           <div class="col-md-6 col-md-offset-3" id="form_input" style="margin-top:30px; display: none;">
          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border text-center">
              <h3 class="box-title ">Thêm Tài Khoản</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="{{ route('set_token') }}" method="POST">
                <!-- text input -->
                @csrf               
                {{-- <div class="form-group">
                  <label>Bấm vào <a href="https://developers.facebook.com/tools/explorer/" target="_blank">đây</a>  để lấy token ngắn hạn</label>
                  <input type="text" class="form-control" placeholder="Nhập token ngắn hạn" name="token_fb" >
                </div> --}}  

                <div class="form-group">
                  <label>Tên</label>
                  <input type="text" class="form-control" name="nameFB" id="nameFB">
                </div>  
                <div class="form-group">
                  <label>Token</label>
                  <input type="text" class="form-control"  name="tokenFB" id="tokenFB" readonly>
                </div>  
                <div class="form-group">
                  <label>user_id</label>
                  <input type="text" class="form-control" name="userIdFb" id="userIdFb" readonly >
                </div>

                <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary">Set Token</button>
              </div>           
              </form>
              @if (isset($status)&&$status == 'success')
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Thành công!</h4>
                    {{$msg}}
                </div>
              @elseif (isset($status)&&$status == 'failed')
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Thất bại!</h4>
                    {{$msg}}
                </div>
              @endif
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

 

    <div class="row" style="margin-top:30px;">
      <div  class="col-md-6 col-md-offset-3">
        <script>
        function statusChangeCallback(response) {  
          console.log(response); 

          if (response.status === 'connected') { 
            document.getElementById('form_input').style.removeProperty('display');
            document.getElementById('tokenFB').value = response.authResponse.accessToken;
            testAPI();  
          } else {                               
            document.getElementById('status').innerHTML = 'Đăng nhập vào hệ thống!!';
          }
        }
        function checkLoginState() {               // Called when a person is finished with the Login Button.
          FB.getLoginStatus(function(response) {   // See the onlogin handler
            statusChangeCallback(response);
          });
        }


        window.fbAsyncInit = function() {
          FB.init({
            // appId      : '702506653702458',
            // cookie     : true,                     // Enable cookies to allow the server to access the session.
            // xfbml      : true,                     // Parse social plugins on this webpage.
            // version    : 'v8.0'           // Use this Graph API version for this call.
            appId      : '710721769520597',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v8.0'           // Use this Graph API version for this call.
          });


          FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
            statusChangeCallback(response);        // Returns the login status.
          });
        };

        function testAPI() {                     
          console.log('Welcome!  Fetching your information.... ');
          FB.api('/me', function(response) {

            console.log(response);  
            document.getElementById('status').innerHTML =
            'Tài khoản đang đăng nhập ở trình duyệt: ' + response.name + '!';
            document.getElementById('nameFB').value = response.name;
            document.getElementById('userIdFb').value = response.id;
          });
        }
      </script>
<!-- The JS SDK Login Button -->
      <div class="text-center">
          <fb:login-button scope="public_profile,pages_manage_posts,pages_show_list,pages_manage_engagement,pages_read_engagement,pages_read_user_content,pages_manage_instant_articles" onlogin="checkLoginState();">
        </fb:login-button>
        <div id="status" style="color: #B40404; font-size: 20px">
        </div>
      </div>
        
      </div>      
    </div>

    <div class="row" style="margin-top:30px;"> {{-- Cột Bảng token --}}
        <div class="col-xs-12">
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh Sách Tài khoản của {{Auth::user()->name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Tên</th>
                  <th>Id Facebook</th>
                  <th>Id App</th>
                  <th>Ngày tạo</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($listToken as $token)
                  <tr>
                  <td>{{$token->name_FB}}</td>
                  <td>{{$token->id_userFB}}</td>
                  <td>{{$token->app_id}}</td>
                  <td>{{$token->updated_at}}</td>
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
    </div> {{--End Cột Bảng token --}}

    
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
