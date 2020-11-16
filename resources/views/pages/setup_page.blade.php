@extends('layouts.app')

@section('css')

@endsection


@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
     @if (session()->has('statuss'))
      @php
         $statuss = Session::get('statuss');
      @endphp 
      @if ($statuss['kq']=='success')
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
        <h4><i class="icon fa fa-check"></i> Kết Quả!</h4>
        {{$statuss['text']}}   
      </div>
      @endif
    
    @if ($statuss['kq']=='failed')
     <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
      <h4><i class="icon fa fa-ban"></i> Thất Bại!</h4>
      {{$statuss['text']}} 
    </div>
    @endif

    

    @endif
  </div>
</div>
    <div class="row">
           <div class="col-md-6 col-md-offset-3" style="margin-top:30px">
          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border text-center">
              <h3 class="box-title ">Chọn trang làm việc</h3>
            </div>
             <div class="box-body">
             @if (isset($status)&&$status!=='')
                 <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Lỗi!</h4>
                    {{$status}}
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
                              <label><input type="checkbox" name="data[]" value="{{$page['name']}},{{$page['id']}},{{$page['account']}}"> {{$page['name']}}</label>
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
