<header class="header">
    <div class="container-fluid">
        <div class="headerTop">
        {{-- Start :: Logo --}}
        @if ($settingData->logo != null)
            @if (file_exists(public_path('/images/uploads/'.$accountStorage.'/'.$settingData->logo)))
                <div class="logo">
                    <a href="{{ getBaseUrl() }}">
                        <img src="{{ asset('/images/uploads/'.$accountStorage.'/'.$settingData->logo) }}" alt="{!! $settingData->logo_alt !!}" title="{!! $settingData->logo_title !!}">
                    </a>
                </div>
            @endif
        @endif
        {{-- End :: Logo --}}
            <div class="headerRight">
                <div class="topButtonsGrp">
                    {{-- Start :: If NOT logged in --}}
                    @if (!Auth::user())
                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#loginModal" class="btnlogin">@lang('custom.label_login')</a>
                    <a href="{{ route('site.registration') }}" class="btnMain">@lang('custom.label_join_now')</a>
                    {{-- End :: If NOT logged in --}}
                    {{-- Start :: If logged in --}}
                    @else
                    <div class="dropdown">
                        <a href="javascript:void(0)" class="btnMain dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">My Account</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route('site.users.profile') }}">Profile</a></li>
                            @if ($isAccessAvailable)
                            <li><a class="dropdown-item" href="#">Join A League</a></li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('site.users.edit-profile') }}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('site.users.change-password') }}">Change Password</a></li>
                            <li><a class="dropdown-item" href="{{ route('site.users.logout') }}">Logout</a></li>
                        </ul>
                    </div>
                    @endif
                    {{-- End :: If logged in --}}
                </div>
            </div>
            <div class="menuIcon">
                <a class="animateddrawer" id="ddsmoothmenu-mobiletoggle" href="javascript:void(0)"><span></span></a>
            </div>
        </div>
    </div>
    {{-- Start :: City Menu --}}
    @include ('site.includes.header_menu')
    {{-- End :: City Menu --}}
</header>