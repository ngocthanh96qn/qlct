
    <li class="header">CHỨC NĂNG</li>
    
    
    <li class="treeview">
      <a href="#">
        <i class="fa fa-cogs"></i>
        <span> CẤU HÌNH HỆ THỐNG </span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
      <li><a href="{{ route('menu.setup_token') }}"><i class="fa fa-circle-o"></i> Thêm nick FB vào hệ thống </a></li>
        {{-- <li><a href="{{ route('menu.setup_ia') }}"><i class="fa fa-circle-o"></i> Thiết Lập IA </a></li> --}}
        <li><a href="{{ route('menu.setup_page') }}"><i class="fa fa-circle-o"></i> Chọn Page làm việc </a></li>
      </ul>
    </li>

    <li class="active">
          <a href="{{ route('menu.postArticle') }}">
            <i class="fa fa-th"></i> <span>ĐĂNG BÀI</span>
            <span class="pull-right-container">
              {{-- <small class="label pull-right bg-green">new</small> --}}
            </span>
          </a>
    </li>

    <li class="treeview">
      <a href="#">
        <i class="fa fa-cogs"></i>
        <span> THỐNG KÊ </span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
      <li><a href="{{ route('menu.Statisticle') }}"><i class="fa fa-circle-o"></i> Tổng quan </a></li>
        <li><a href="{{ route('menu.ShowPage') }}"><i class="fa fa-circle-o"></i> Chi tiết từng Page </a></li>
      </ul>
    </li>

    
