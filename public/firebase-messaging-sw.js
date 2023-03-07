importScripts('https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.0/firebase-messaging.js');
   
    firebase.initializeApp({
        apiKey: "AIzaSyDbKRIhMVRbZn7gkuqQKeWXjbz-PrHZFp4",
    authDomain: "bcpos-b50ff.firebaseapp.com",
    projectId: "bcpos-b50ff",
    storageBucket: "bcpos-b50ff.appspot.com",
    messagingSenderId: "174253106578",
    appId: "1:174253106578:web:8ad5a032d6fae9ef514d4b",
    measurementId: "G-LN3MB7DJP3"
    });
    const messaging = firebase.messaging();
    messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
        
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };
  
    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});