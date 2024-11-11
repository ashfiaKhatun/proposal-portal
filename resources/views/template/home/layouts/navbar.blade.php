<!--**********************************
            Nav header start
        ***********************************-->
<div class="nav-header">
    <div class="brand-logo bg-white  h-100 d-flex justify-content-center align-items-center">
        <a href="/">
            <b class="logo-abbr"><img src="../../template/images/logo.png" alt=""> </b>
            <span class="logo-compact"><img src="../../template/images/logo-text.png" alt=""></span>
            <span class="brand-title">
                <img src="../../template/images/logo-text.png" height="52" alt="">
            </span>
        </a>
    </div>
</div>
<!--**********************************
            Nav header end
        ***********************************-->

<!--**********************************
            Header start
        ***********************************-->
<div class="header">
    <div class="header-content clearfix">

        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
            </div>
        </div>

        <div class="header-right">
            <ul class="clearfix">
                <li class="icons dropdown">{{ auth()->user()->name }}</li>

                <li class="icons dropdown">
                    <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                        <span class="activity active"></span>
                        <img src="../../template/images/user/avatar.jpg" height="40" width="40" alt="">
                    </div>
                    <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--**********************************
            Header end ti-comment-alt
***********************************-->