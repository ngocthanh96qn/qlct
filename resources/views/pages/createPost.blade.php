@extends('layouts.app')

@section('css')

@endsection


@section('content')
<div class="container">
    <div class="row" >
           <div class="col-md-6" style="margin-top:30px">
          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border text-center">
              <h3 class="box-title ">Tạo bài viết mới</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <form role="form" action="{{ route('handleData') }}" method="POST">
                <!-- text input -->
                @csrf   
                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-file-text-o"></i> Caption </label>
                  <input type="text" class="form-control" id="inputSuccess" placeholder="Bạn đang nghĩ gì? ...">
                </div>            
                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-link"></i> Nhập Link </label>
                  <input type="text" class="form-control" id="inputSuccess" placeholder="Link ...">
                </div>

                <div class="box-footer text-center form-group has-warning">
                  <label class="control-label"><i class="fa fa-bolt"></i> Chọn Trang </label>
                </div>

                @foreach ($pages as $page)
                <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="pages[]" value="{{$page->id_page}}">
                      {{$page->name}}
                    </label>
                  </div>
                </div>
                @endforeach
                
                <div class="box-footer text-center">
                  <button type="submit" class="btn btn-primary"> Đăng </button>
                </div>           
              </form>
              @if (isset($image))
                <img src="{{$image}}">
              @endif
              
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
        </div>  {{-- end col --}}
         {{-- <div class="col-md-5" style="margin-top:30px">
                    <div class="box box-warning">
            <div class="box-header with-border text-center">
              <h3 class="box-title ">Xem trước bài viết</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               
            </div>
            <!-- /.box-body -->
          </div>
        </div> --}}
    </div>      {{-- end row --}}
</div>

@endsection


@push('scripts')

@endpush
