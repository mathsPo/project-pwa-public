const STATIC_CACHE_NAME = "webApp.v1";
const modelList_CACHE_NAME = 'modelelist';

this.addEventListener('install', function(event) {     
    event.waitUntil(
        caches.open(STATIC_CACHE_NAME).then(function(cache) {
            return cache.addAll([
                '/project-pwa-public/',
                '/project-pwa-public/index.html',
                '/project-pwa-public/manifest.json',
                '/project-pwa-public/modele.php',
                '/project-pwa-public/css/style.css',
                '/project-pwa-public/css/modele.css',
                '/project-pwa-public/js/ihm.js',
                '/project-pwa-public/js/pwa.js',
                '/project-pwa-public/icon/saint_ex_16x16.png',
                '/project-pwa-public/icon/saint_ex_32x32.png',
                '/project-pwa-public/icon/saint_ex_60x60.png',
                '/project-pwa-public/icon/saint_ex_72x72.png',
                '/project-pwa-public/icon/saint_ex_96x96.png',
                '/project-pwa-public/icon/saint_ex_120x120.png',
                '/project-pwa-public/icon/saint_ex_144x144.png',
                '/project-pwa-public/icon/saint_ex_152x152.png',
                '/project-pwa-public/icon/saint_ex_180x180.png',
                '/project-pwa-public/icon/saint_ex_192x192.png',
                '/project-pwa-public/icon/saint_ex_512x512.png',
                'https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css',
                'https://fonts.googleapis.com/icon?family=Material+Icons',
            ]);
        })
    );
    console.log('service worker installé');
});

self.addEventListener("fetch", (event) => {
    if (event.request.url.startsWith("http")) {
        event.respondWith(
            caches.open(STATIC_CACHE_NAME).then(function (cache) {
                return cache.match(event.request).then(function (response) {
                    const fetchPromise = fetch(event.request).then(function (networkResponse) {
                        if((event.request.url.indexOf('http') === 0)){ 
                            cache.put(event.request, networkResponse.clone());
                        }
                        return networkResponse;
                    });
                    return response || fetchPromise;
                });
            }),
        );
    }
});

self.addEventListener('activate', function(event) {
    event.waitUntil(
        caches.keys().then(function(cacheNames) {
            return Promise.all(
                cacheNames.filter(function(cacheName) {
                    if (cacheName !== STATIC_CACHE_NAME)
                    {
                        return true;
                    }
                }).map(function(cacheName) {
                    return caches.delete(cacheName);
                })
            );
        })
    );
});

self.addEventListener('fetch', function(event) {
    if (event.request.url.startsWith("http://localhost:7000/")) {
        event.respondWith(
            caches.open(modelList_CACHE_NAME).then(function (cache) {
                return fetch(event.request).then(function (response) {
                    cache.put(event.request, response.clone());
                    return response;
                });
            })
        );
    }
});