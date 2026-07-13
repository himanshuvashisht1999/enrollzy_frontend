<!DOCTYPE html>
<html lang="en">
<head>
    @include('common.head')
</head>
<body>
    <div class="top-gradient-div"></div>
    @include('common.header')
    @yield('content')
    @include('common.footer')
    @include('common.script')
</body>
</html>
