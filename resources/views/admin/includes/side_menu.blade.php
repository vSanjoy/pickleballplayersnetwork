@php
$getAllRoles = getUserRoleSpecificRoutes();
$isSuperAdmin = false;
if (\Auth::guard('admin')->user()->id == 1 || \Auth::guard('admin')->user()->type == 'SA') {
    $isSuperAdmin = true;
}

$currentPageMergeRoute = explode('admin.', Route::currentRouteName());
if (count($currentPageMergeRoute) > 0) {
    $currentPage = $currentPageMergeRoute[1];
} else {
    $currentPage = Route::currentRouteName();
}

// Get site settings data
$getSiteSettings = getSiteSettings();
@endphp

<aside class="left-sidebar" data-sidebarbg="skin6">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar" data-sidebarbg="skin6">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li class="sidebar-item @if ($currentPage == 'dashboard')selected @endif"> 
					<a class="sidebar-link sidebar-link @if ($currentPage == 'dashboard')active @endif" href="{{ route('admin.dashboard') }}" aria-expanded="false">
						<i data-feather="home" class="feather-icon"></i><span class="hide-menu">@lang('custom_admin.label_dashboard')</span>
					</a>
				</li>

				<li class="list-divider"></li>
				<li class="nav-small-cap"><span class="hide-menu">@lang('custom_admin.label_managements')</span></li>

			<!-- Banner Management Start -->
			@php
			$bannerRoutes = ['banner.list','banner.add','banner.edit','banner.sort','banner.sort-season'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('banner.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $bannerRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $bannerRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="image" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_banner')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $bannerRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.banner.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
						@if ( ($isSuperAdmin) || (in_array('banner.add', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.banner.add') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_add')</span>
							</a>
						</li>
						@endif
						@if ( ($isSuperAdmin) || (in_array('banner.sort', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.banner.sort') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_sort')</span>
							</a>
						</li>
						@endif
					</ul>
				</li>
			@endif

			<!-- Preferred Home Court Management Start -->
			@php
			$pickleballCourtRoutes = ['pickleballCourt.list','pickleballCourt.add','pickleballCourt.edit','pickleballCourt.sort'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('pickleballCourt.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $pickleballCourtRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $pickleballCourtRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="home" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_pickleball_court')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $pickleballCourtRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.pickleballCourt.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
						@if ( ($isSuperAdmin) || (in_array('pickleballCourt.add', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.pickleballCourt.add') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_add')</span>
							</a>
						</li>
						@endif
					</ul>
				</li>
			@endif

			<!-- Player Management Start -->
			@php
			$playerRoutes = ['player.list','player.view'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('player.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $playerRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $playerRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="users" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_player')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $playerRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.player.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
					</ul>
				</li>
			@endif

			<!-- Promo Code Management Start -->
			{{-- @php
			$promoCodeRoutes = ['promoCode.list','promoCode.add','promoCode.edit'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('promoCode.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $promoCodeRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $promoCodeRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="radio" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_promo_code')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $promoCodeRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.promoCode.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
						@if ( ($isSuperAdmin) || (in_array('promoCode.add', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.promoCode.add') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_add')</span>
							</a>
						</li>
						@endif
					</ul>
				</li>
			@endif --}}

			<!-- Video Management Start -->
			@php
			$videoRoutes = ['video.list','video.add','video.edit','video.sort'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('video.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $videoRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $videoRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="video" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_menu_video')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $videoRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.video.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
						@if ( ($isSuperAdmin) || (in_array('video.add', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.video.add') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_add')</span>
							</a>
						</li>
						@endif
					</ul>
				</li>
			@endif

			<!-- Website Settings & CMS Management Start -->
			@php
			$siteSettingRoutes 	= ['website-settings'];
			$cmsRoutes 			= ['cms.list','cms.add','cms.edit'];
			$allBookingRoutes	= ['booking-history'];
			@endphp
			@if ( ($isSuperAdmin) || in_array('website-settings', $getAllRoles) || in_array('cms.list', $getAllRoles) )
				<li class="list-divider"></li>
				<li class="nav-small-cap"><span class="hide-menu">@lang('custom_admin.label_miscellaneous')</span></li>

				@if ( ($isSuperAdmin) || in_array('cms.list', $getAllRoles) )
				<li class="sidebar-item @if (in_array($currentPage, $cmsRoutes))selected @endif">
					<a class="sidebar-link has-arrow @if (in_array($currentPage, $cmsRoutes))active @endif" href="javascript:void(0)" aria-expanded="false">
						<i data-feather="layers" class="feather-icon"></i><span class="hide-menu"> @lang('custom_admin.label_cms')</span>
					</a>
					<ul aria-expanded="false" class="collapse first-level base-level-line @if (in_array($currentPage, $cmsRoutes))in @endif">
						<li class="sidebar-item">
							<a href="{{ route('admin.cms.list') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_list')</span>
							</a>
						</li>
						@if ( ($isSuperAdmin) || (in_array('cms.add', $getAllRoles)) )
						<li class="sidebar-item">
							<a href="{{ route('admin.cms.add') }}" class="sidebar-link sub-menu">
								<span class="hide-menu"> @lang('custom_admin.label_add')</span>
							</a>
						</li>
						@endif
					</ul>
				</li>
				@endif
				@if ( ($isSuperAdmin) || (in_array('website-settings', $getAllRoles)) )
				<li class="sidebar-item @if (in_array($currentPage, $siteSettingRoutes))selected @endif"> 
					<a class="sidebar-link sidebar-link @if (in_array($currentPage, $siteSettingRoutes))active @endif" href="{{ route('admin.website-settings') }}" aria-expanded="false">
						<i data-feather="settings" class="feather-icon"></i><span class="hide-menu">@lang('custom_admin.label_website_settings')</span>
					</a>
				</li>
				@endif
			@endif

				<li class="list-divider"></li>
				<li class="sidebar-item">
					<a class="sidebar-link sidebar-link" href="{{ route('admin.logout') }}" aria-expanded="false">
						<i data-feather="log-out" class="feather-icon"></i><span class="hide-menu">@lang('custom_admin.label_signout')</span>
					</a>
				</li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>