@if ($adsenseAccount = \App\Support\SitePublication::adsenseAccount())
    @if (config('adsense.enabled') === true)
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ $adsenseAccount }}" crossorigin="anonymous"></script>
    @elseif (config('adsense.verification_enabled') === true)
        <meta name="google-adsense-account" content="{{ $adsenseAccount }}">
    @endif
@endif
