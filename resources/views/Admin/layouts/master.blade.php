<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
    <head>
        @include('Admin.layouts.headcss')
        @yield('css')
    </head>
    <body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click"
          data-menu="vertical-menu-modern" data-col="2-columns">
        @include('sweetalert::alert')
        @include('Admin.layouts.navbar')
        @include('Admin.layouts.sidebar')
        @yield('content')
        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
        @include('Admin.layouts.footer')
        @include('Admin.layouts.footerjs')
        {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts /> --}}
        @stack('js')
    </body>
</html>
