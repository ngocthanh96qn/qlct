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

    
</div>
@endsection


@push('scripts')
        {{-- chèn script --}}
@endpush
