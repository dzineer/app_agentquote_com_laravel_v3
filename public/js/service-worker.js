console.log('◕‿◕', "starting service worker...");

self.addEventListener('install', function(event) {
    console.log("Service worker installed.");
});

self.addEventListener('active', function(event) {
    console.log("Service worker activated.");
});

/*self.addEventListener('fetch', function(event) {
    console.log("Received a fetch event!");
    event.respondWith(new Response("This is all your going to get buddy!"))
});*/

/*self.addEventListener('push', function(event) {
    console.log('Received a push message', event);

    var title = 'Yay a message.';
    var body = 'We have received a push message.';
    var icon = '/images/icon-192x192.png';
    var tag = 'simple-push-demo-notification-tag';
    var data = {
        doge: {
            wow: 'such amaze notification data'
        }
    };

    event.waitUntil(
        self.registration.showNotification(title, {
            body: body,
            icon: icon,
            tag: tag,
            data: data
        })
    );
});*/

/*navigator.serviceWorker.getRegistrations()
    .then(function(registrations) {

        for(let registration of registrations) {

            registration.registration.unregister()
                .then(function() {
                    return self.clients.matchAll();
                })
                .then(function(clients) {
                    clients.forEach(client => {
                        if (client.url && "navigate" in client) {
                            client.navigate(client.url);
                        }
                    });
                });
        }

    });*/

/*self.addEventListener('activate', function (event) {

});*/

self.addEventListener('push', function (event) {

    if (!(self.Notification && self.Notification.permission === 'granted')) {
        // Notifications are not supported
        return;
    }

    if (event.data) {
        let data = event.data.json();
        console.log(data);

        event.waitUntil(
            self.registration.showNotification(data.title, {
                body: data.body,
                icon: data.icon,
                actions: data.actions
            })
        );
        console.log('This push event has data: ', event.data.text());
    } else {
        console.log('This push event has not data.');
    }
});

self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request).then((response) =>
            response || fetch(event.request)
        )
    );
});
