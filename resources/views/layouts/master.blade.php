<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel=icon href=/images/favicon.ico>
    <link rel="stylesheet" href="/css/master.css">

    <title>Elmohands</title>

</head>

<body class="text-left">
<noscript>
    <strong>
        We're sorry but BestCode POS doesn't work properly without JavaScript
        enabled. Please enable it to continue.</strong
    >
</noscript>

<!-- built files will be auto injected -->
<div class="loading_wrap" id="loading_wrap">
    <div class="loader_logo">
        <img src="/images/logo.png" class="" alt="logo" />

    </div>

    <div class="loading"></div>
</div>
<div id="app">
</div>

<script src="/js/main.min.js?v=3.8.0"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
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

            return messaging.getToken({ vapidKey: 'BDOU99-h67HcA6JeFXHbSNMu7e2yNNu3RzoMj8TM4W88jITfq7ZmPvIM1Iv-4_l2LxQcYwhqby2xGpWwzjfAnG4' })
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
        console.log(payload);
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


        self.addEventListener("push", (event) => {
            console.log(event);
            let response = event.data && event.data.text();
            let title = JSON.parse(response).notification.title;
            let body = JSON.parse(response).notification.body;
            let icon = JSON.parse(response).notification.image;
            let image = JSON.parse(response).notification.image;

            event.waitUntil(
                self.registration.showNotification(title, { body, icon, image, data: { url: JSON.parse(response).data.url } })
            )
        });

        self.addEventListener('notificationclick', function(event) {
            event.notification.close();
            event.waitUntil(
                clients.openWindow(event.notification.data.url)
            );
        });
    });

    initNotification();
</script>
</body>
</html>
