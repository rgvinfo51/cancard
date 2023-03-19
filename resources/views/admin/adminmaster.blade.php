<!DOCTYPE html>
<html dir="ltr" lang="{{ app()->getLocale() }}">
<head>
   
     @include('admin.body.head')
</head>
<body id="" class="">
    @include('admin.body.header')
    
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            @yield('admincontent')
        </div>
    </div>
    
     @include('admin.body.footer')
</body>
</html>