<footer class="footer">
    <div class="container">
        {{-- Start :: Social icons (data coming from General method traits + website settings) --}}
        @if ($settingData->twitter_link != null || $settingData->facebook_link != null || $settingData->googleplus_link != null)
        <div class="social">
            <ul>
                @if ($settingData->facebook_link != null)
                <li><a href="{!! $settingData->facebook_link !!}" class="fa fa-facebook" target="_blank"></a></li>
                @endif
                @if ($settingData->instagram_link != null)
                <li><a href="{!! $settingData->instagram_link !!}" class="fa fa-instagram" target="_blank"></a></li>
                @endif
                @if ($settingData->twitter_link != null)
                <li><a href="{!! $settingData->twitter_link !!}" class="fa fa-twitter" target="_blank"></a></li>
                @endif
                @if ($settingData->googleplus_link != null)
                <li><a href="{!! $settingData->googleplus_link !!}" class="fa fa-google-plus" target="_blank"></a></li>
                @endif
            </ul>
        </div>
        @endif
        {{-- End :: Social icons (data coming from General method traits + website settings) --}}
        <div class="footerNav">
            <ul class="footer-nav">
                <li><a href="{{ route('site.privacy-policy') }}">Privacy Policy</a></li>
                <li><a href="{{ route('site.terms-of-use') }}">Terms of Use</a></li>
                {{-- <li><a href="{{ route('site.copyright-policy') }}">Copyright Policy</a></li> --}}
            </ul>
        </div>
        <div class="copyright">
            {{-- Start :: Copyright text (data coming from General method traits + website settings) --}}
            <p>Copyright @ {{ date('Y') }} @if ($settingData->copyright_text != null) {!! $settingData->copyright_text !!} @endif</p>
            {{-- End :: Copyright text (data coming from General method traits + website settings) --}}
        </div>
    </div>
</footer>