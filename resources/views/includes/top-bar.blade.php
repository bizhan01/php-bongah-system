<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse"
               data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand"
               href="{{ route('dashboard') }}"><?php echo Config::get('settings.company_name'); ?></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">

                <!-- #END# Tasks -->
                <div class=" height-28 btn-group user-helper-dropdown m-t-18 text-white bor-1 pointer-cursor p-both-0">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="{{ route("profile") }}"><i class="material-icons">person</i>پروفایل</a></li>
                        <li role="separator" class="divider"></li>

                        <li><a href="javascript:void(0); document.getElementById('logout-form').submit();"><i
                                        class=" fas fa-sign-out-alt"></i> خروج</a></li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              class="dis-none"
                        >
                            @csrf
                        </form>

                    </ul>
                </div>

            </ul>
        </div>

    </div>
</nav>
