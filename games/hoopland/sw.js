const CACHE_NAME = "fun-basketball-v1";

// Files we KNOW about from your HTML
const CORE_ASSETS = [
  "./",
  "index.html",
  "jquery-2.1.1.min.js",
  "c2runtime.js",
  "appmanifest.json",
  "icon-256.png"
];

// Install – cache core files
self.addEventListener("install", event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      return cache.addAll(CORE_ASSETS).catch(() => {
        // Ignore missing files – Construct will still run online
        console.log("Some core assets missing, continuing anyway");
      });
    })
  );
  self.skipWaiting();
});

// Activate – clean old caches
self.addEventListener("activate", event => {
  event.waitUntil(
    caches.keys().then(keys =>
      Promise.all(
        keys.map(key => {
          if (key !== CACHE_NAME) {
            return caches.delete(key);
          }
        })
      )
    )
  );
  self.clients.claim();
});

// Fetch – network first, fallback to cache
self.addEventListener("fetch", event => {
  event.respondWith(
    fetch(event.request)
      .then(response => {
        // Cache new successful requests
        const responseClone = response.clone();
        caches.open(CACHE_NAME).then(cache => {
          cache.put(event.request, responseClone);
        });
        return response;
      })
      .catch(() => caches.match(event.request))
  );
});
