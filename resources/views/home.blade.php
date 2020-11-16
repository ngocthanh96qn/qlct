@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<h3 class="text-center" style="color: #000000"> Hướng dẫn sử dụng! </h3>
    </div>

    <div class="row">
    	<div class="col-md-8 col-md-offset-2">
    		<div class="box box-primary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">CÁC BƯỚC:</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list ui-sortable">
                <li>
                  <!-- drag handle -->
                  <span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  
                  <!-- todo text -->
                  <span class="text"> B1: Thêm nick Facebook vào tài khoản</span>
                </li>

            	<li>
                  <!-- drag handle -->
                  <span> +++ Vào Menu CẤU HÌNH HỆ THỐNG => Thêm nick FB vào hệ thống  </span>
                </li>
                
                <li>
                  <!-- drag handle -->
                  <span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  
                  <!-- todo text -->
                  <span class="text"> B2: Chọn các trang để làm việc</span>
                </li>

            	<li>
                  <!-- drag handle -->
                  <span> +++ Vào Menu CẤU HÌNH HỆ THỐNG => Chọn Page làm việc </span>
                </li>
                <li>
                  <!-- drag handle -->
                  <span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                  
                  <!-- todo text -->
                  <span class="text"> B3: Đăng Bài</span>
                </li>

            	<li>
                  <!-- drag handle -->
                  <span> +++ Vào Menu ĐĂNG BÀI => Viết caption, chọn trang và đăng  </span>
                </li>
                <li>
                  <!-- drag handle -->
                  <span> +++ Lần sau nếu không thêm nick hay chọn lại trang thì vào trực tiếp ĐĂNG BÀI  để làm việc.  </span>
                </li>

              </ul>
            </div>
         
          </div>
    	</div>
    </div>
</div>
@endsection
