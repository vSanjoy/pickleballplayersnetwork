<header class="header">
    <div class="container-fluid">
        <div class="headerTop">
        {{-- Start :: Logo --}}
        @if ($settingData->logo != null)
            @if (file_exists(public_path('/images/uploads/'.$accountStorage.'/'.$settingData->logo)))
            <div class="logo">
                <a href="{{ getBaseUrl() }}">
                    <img src="{{ asset('/images/uploads/'.$accountStorage.'/'.$settingData->logo) }}" alt="{!! $settingData->website_title !!}">
                </a>
            </div>
            @endif
        @endif
        {{-- End :: Logo --}}
            <div class="headerRight">
                <div class="topButtonsGrp">
                    @if ($userId)
                    <a href="{{ route('site.login', $userId) }}" class="btnlogin">@lang('custom.label_login')</a>
                    {{-- <a href="{{ route('site.registration') }}" class="btnMain">@lang('custom.label_join_now')</a> --}}
                    @endif
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