@extends('layouts.app')

@section('css')

@endsection


@section('content')
<div class="container">
    <div class="row">
           <div class="col-md-6 col-md-offset-3" style="margin-top:30px">
          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border text-center">
              <h3 class="box-title ">Chọn trang làm việc</h3>
            </div>
             <div class="box-body">
             @if (isset($errorToken)&&$errorToken=='true')
                 <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Lỗi!</h4>
                    Kiểm tra lại token
                </div>
            @else 
                    <form role="form" action="{{ route('set_page') }}" method="POST">
                  <!-- text input -->
                  @csrf

                      <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Tên Trang</th>
                          <th scope="col">Tài khoản</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                         @foreach ($pages as $page)
                        <tr>
                          <td> 
                            <div class="checkbox">
                              <label><input type="checkbox" name="data[{{$page['name']}}]" value="{{$page['id']}}"> {{$page['name']}}</label>
                            </div>
                          </td>
                          <td>{{$page['account']}}</td>
                        </tr>
                        @endforeach 
                      </tbody>
                    </table>

                
                  <div class="box-footer text-center">
                  <button type="submit" class="btn btn-primary">Cài đặt trang </button>
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

    
</div>
@endsection


@push('scripts')
       
@endpush
