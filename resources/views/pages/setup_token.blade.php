@extends('layouts.app')

@section('css')
  {{-- chen css --}}
@endsection


@section('content')
<div class="container">
    <div class="row">
           <div class="col-md-6 col-md-offset-3" style="margin-top:30px">
          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border text-center">
              <h3 class="box-title ">Hướng dẫn cấu hình Token</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="{{ route('set_token') }}" method="POST">
                <!-- text input -->
                @csrf               
                <div class="form-group">
                  <label>Bấm vào <a href="https://developers.facebook.com/tools/explorer/" target="_blank">đây</a>  để lấy token ngắn hạn</label>
                  <input type="text" class="form-control" placeholder="Nhập token ngắn hạn" name="token_fb" >
                </div>  
                <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary">Set Token</button>
              </div>           
              </form>
              @if (isset($status)&&$status == 'success')
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Thành công!</h4>
                    Cặt đặt Token dài hạn thành công
                </div>
              @elseif (isset($status)&&$status == 'failed')
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Thất bại!</h4>
                    Cài đặt token thất bại, vui lòng thử lại
                </div>
              @endif
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

    <div class="row">

      <script>
          function statusChangeCallback(response) {  
            console.log('statusChangeCallback');
          console.log(response);                   
          if (response.status === 'connected') {   
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
            console.log('Successful login for: ' + response.name);
            document.getElementById('status').innerHTML =
            'Thanks for logging in, ' + response.name + '!';
          });
        }
    </script>
<!-- The JS SDK Login Button -->

<fb:login-button scope="public_profile,email,pages_manage_posts,user_birthday,pages_show_list,pages_manage_engagement,pages_read_engagement,pages_read_user_content,pages_manage_instant_articles" onlogin="checkLoginState();">
</fb:login-button>
<div id="status">
</div>


    </div>

    
</div>


@endsection


@push('scripts')
  
  <!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

@endpush
