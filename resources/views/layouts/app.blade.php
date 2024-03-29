<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
     <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
     <script>
         var firebaseConfig = {
             apiKey: "AIzaSyDbKRIhMVRbZn7gkuqQKeWXjbz-PrHZFp4",
             authDomain: "bcpos-b50ff.firebaseapp.com",
             projectId: "bcpos-b50ff",
             storageBucket: "bcpos-b50ff.appspot.com",
             messagingSenderId: "174253106578",
             appId: "1:174253106578:web:8ad5a032d6fae9ef514d4b",
             measurementId: "G-LN3MB7DJP3"
         };

         firebase.initializeApp(firebaseConfig);
         const messaging = firebase.messaging();

         function initNotification() {
             messaging
                 .requestPermission().then(function() {

                     return messaging.getToken()
                 }).then(function(response) {
                     $.ajaxSetup({
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                     });
                     $.ajax({
                         url: '{{ route('save-push-notification-token') }}',
                         type: 'POST',
                         data: {
                             token: response
                         },
                         dataType: 'JSON',
                         success: function(response) {

                             console.log('Device token saved.');
                         },
                         error: function(error) {
                             console.log(error);
                         },
                     });
                 }).catch(function(error) {
                     console.log(error);
                 });
         }

         messaging.onMessage(function(payload) {
             const title = payload.notification.title;
             const options = {
                 body: payload.notification.body,
                 icon: payload.notification.icon,
             };
            var noticount = $("#noticount").html();
            $("#noticount").html(parseInt(noticount)+1);
            var url =title.split("++")[1];
            var title2 = title.split("++")[0];
            console.log(url);
            var noty=new Notification(title2, options);
            noty.onclick = function(){location.href=url};
         });

         initNotification();
     </script>

<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<!-- <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
    var firebaseConfig = {
        apiKey: "AIzaSyDbKRIhMVRbZn7gkuqQKeWXjbz-PrHZFp4",
        authDomain: "bcpos-b50ff.firebaseapp.com",
        projectId: "bcpos-b50ff",
        storageBucket: "bcpos-b50ff.appspot.com",
        messagingSenderId: "174253106578",
        appId: "1:174253106578:web:8ad5a032d6fae9ef514d4b",
        measurementId: "G-LN3MB7DJP3"
        };

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function initNotification() {
        messaging
            .requestPermission().then(function () {

                return messaging.getToken()
            }).then(function (response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("save-push-notification-token") }}',
                    type: 'POST',
                    data: {
                        token: response
                    },
                    dataType: 'JSON',
                    success: function (response) {

                        console.log('Device token saved.');
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });
            }).catch(function (error) {
                console.log(error);
            });
    }

    messaging.onMessage(function (payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        // console.log(title);
        new Notification(title, options);
    });

    initNotification();
</script> -->

</body>
</html>
