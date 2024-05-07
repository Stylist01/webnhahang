<header id="site-header">
    <div id="site-header-inner">
        <div class="wrap-inner flex">
            <div id="site-logo" class="cleafix">
                <a href="/" class="logo">
                    <img src="{{ $company->logo }}" alt="logo">
                </a>
            </div>
            <div class="mobile-button">
                <span></span>
            </div><!-- /.mobile-button -->
            <nav id="main-nav" class="main-nav">
                <ul id="menu-primary-menu" class="menu">
                    <li class="menu-item current-menu-item">
                        <a href="/">Trang chủ</a>
                    </li>
                    <li class="menu-item">
                        <a href="/gioi-thieu">Giới thiệu</a>
                    </li>
                    <li class="menu-item ">
                        <a href="/mon-an">Món ăn</a>
                    </li>
                    <li class="menu-item ">
                        <a href="/tin-tuc">Tin tức</a>
                    </li>
                    <li class="menu-item ">
                        <a href="/lien-he">Liên hệ</a>
                    </li>
                    <li class="menu-item {{ auth()->guard('customer')->check() ? 'menu-item-has-children' : '' }}">
                        @if (auth()->guard('customer')->check())
                            <a href="javascript:void(0);">
                                Tài khoản
                            </a>
                            <ul class="sub-menu">
                                <li class="menu-item"><a href="/gio-hang">Giỏ hàng</a></li>
                                <li class="menu-item"><a href="/don-hang">Đơn hàng</a></li>
                                <li class="menu-item">
                                    <a href="javascript:void(0);"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Đăng xuất
                                        <form id="logout-form" action="{{ route('fe.post.logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        @else
                            <a href="/dang-nhap">Đăng nhập</a>
                        @endif
                    </li>
                </ul>
            </nav><!-- /#main-nav -->
            <div class="flat-button">
                <a href="/dat-ban" class="tf-button color-text color-style1">Đặt bàn</a>
            </div>
        </div>
    </div>
</header>
