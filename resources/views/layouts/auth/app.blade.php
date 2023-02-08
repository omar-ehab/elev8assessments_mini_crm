<!DOCTYPE html>
<html
    lang="en"
    class="light-style customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free"
>
<head>
    <title>@yield('title')</title>
    @include('layouts.auth._head')
</head>

<body>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            @yield('content')
        </div>
    </div>
</div>

@include('layouts.auth._scripts')
</body>
</html>
