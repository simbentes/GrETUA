self.addEventListener("install", e => {
    e.waitUntil(
        caches.open("static").then(cache => {
            return cache.addAll(["./","./img/logos/maskable_icon_x192.png","./css/estilos.css", "./css/bootstrap.min.css"])
        })
    )
});




self.addEventListener('fetch', function(event) {
    event.respondWith(
        // Try the cache
        caches.match(event.request).then(function(response) {
            //If response found return it, else fetch again
            return response || fetch(event.request);
        })
    );
});

// Initialize deferredPrompt for use later to show browser install prompt.
let deferredPrompt;

window.addEventListener('beforeinstallprompt', (event) => {
    console.log('👍', 'beforeinstallprompt', event);
    // Stash the event so it can be triggered later.
    window.deferredPrompt = event;
    // Remove the 'hidden' class from the install button container
    divInstall.classList.toggle('hidden', false);
});

/* global self workbox */
'use strict';
// inlined library script
!function() {
    "use strict";
    try {
        self["workbox:sw:6.1.5"] && _()
    } catch (t) {}
    const t = {
        backgroundSync: "background-sync",
        broadcastUpdate: "broadcast-update",
        cacheableResponse: "cacheable-response",
        core: "core",
        expiration: "expiration",
        googleAnalytics: "offline-ga",
        navigationPreload: "navigation-preload",
        precaching: "precaching",
        rangeRequests: "range-requests",
        routing: "routing",
        strategies: "strategies",
        streams: "streams",
        recipes: "recipes"
    };
    self.workbox = new class {
        constructor() {
            return this.v = {},
                this.Pt = {
                    debug: "localhost" === self.location.hostname,
                    modulePathPrefix: null,
                    modulePathCb: null
                },
                this.$t = this.Pt.debug ? "dev" : "prod",
                this.jt = !1,
                new Proxy(this,{
                    get(e, s) {
                        if (e[s])
                            return e[s];
                        const o = t[s];
                        return o && e.loadModule("workbox-" + o),
                            e[s]
                    }
                })
        }
        setConfig(t={}) {
            if (this.jt)
                throw new Error("Config must be set before accessing workbox.* modules");
            Object.assign(this.Pt, t),
                this.$t = this.Pt.debug ? "dev" : "prod"
        }
        loadModule(t) {
            const e = this.St(t);
            try {
                importScripts(e),
                    this.jt = !0
            } catch (s) {
                throw console.error(`Unable to import module '${t}' from '${e}'.`),
                    s
            }
        }
        St(t) {
            if (this.Pt.modulePathCb)
                return this.Pt.modulePathCb(t, this.Pt.debug);
            let e = ["https://storage.googleapis.com/workbox-cdn/releases/6.1.5"];
            const s = `${t}.${this.$t}.js`
                , o = this.Pt.modulePathPrefix;
            return o && (e = o.split("/"),
            "" === e[e.length - 1] && e.splice(e.length - 1, 1)),
                e.push(s),
                e.join("/")
        }
    }
}();
//# sourceMappingURL=workbox-sw.js.map
;
const escapeChars = (string)=>{
        return string.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
    }
;

// init workbox instance/cache
workbox.setConfig({
    debug: false
});
self.skipWaiting();

// assets to prefetch before considering it "installed"
workbox.precaching.precacheAndRoute([{
    "url": "https://assets.web.starbucksassets.com/weblx/static/63.7c550ca05014128bc9c7.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/activity-list-content.324183afdf53c91295d7.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/activity-list-content.63e5aabbfba039e1fad2.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/add-card-content.1197062b706ee823aa29.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/add-card-content.76ee9a18228322407d2e.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/add-payment-method-content.7787f0e7777d4f7191b8.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/add-payment-method-content.d67a2e56b5f2f3dc6f0a.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/add-payment-method-header.2a7e2f9c4d5b47188236.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/cards-app-bar-header.01ffa8cd9c4d4371af8d.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/communication-preferences-content.3d50de2390d6fb77f60e.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/communication-preferences-content.81a62e51c2973b8455e7.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/coreApp.65367e4b5d59377f0610.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/coreApp.c5fdc04dc1c1c1ce258e.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/edit-email-content.aceb809c84bc1b790426.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/edit-payment-method-content.6794ae07fd2e0cef561c.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/edit-payment-method-content.ba41d586569b6ef2baf6.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/edit-payment-method-header.91005174984246e9c420.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/enter-email-code-content.37a8178075517daa1412.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/error.cd4cd457c7b9d77edebf.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/gift.2146ae71c7fcb4871fb8.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/gift.a5f75a752524f8482a5e.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/giftcard-category-content.9e4b70e1e676bf94ef4d.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/giftcard-category-content.b3ce1afa60d4e4b438e2.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/giftcard-detail-content.b7ce11b70a483e6eb7cf.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/giftcard-detail-content.bcd232ab80cd02404e66.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/giftcard-header.4dfe7026f418ef07a666.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/giftcard-list-content.1a3fd22443986c3f67e2.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/giftcard-list-content.7b883eb6ac86a995a820.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/history-header-crate.7803fb58bfba01f2cd93.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/lodash.4d90aac2c4609a627c68.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/manifest.24129918fe09e3f86f1e.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/mfa-add-or-edit-phone-page-content.9e5c921ad755d3476f23.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/mfa-add-or-edit-phone-page-content.b544614149520b3a9587.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/mfa-content.13bcf3d2086d4184088c.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/mfa-content.e94601c9935c606aaae7.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/optimizely.a5f56370b0c89e54ef94.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/ordering-cart.ceffe31a95d3c17e8165.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/ordering-cart.d7c0c0223ed82ee0e576.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/ordering-crust.22817b7b6562c483d1da.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/ordering-crust.3238496ac7575c8933d5.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/ordering-page.0c96b49ebd5be78581f7.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/ordering-page.e26a547837f7f80d1754.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/ordering-pdp.0a80d240908f539fc22e.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/ordering-pdp.5ab79bf0a4b5abf57036.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/ordering.509c92a0f794a58f51d7.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/ordering.511ea105f6ae67fcc170.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/patternLib.46a58ecf8b342bbc0883.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/patternLib.8cefac6d5e50f6faa162.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/payment-method-header.914af630633e89d224b0.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/payment-method-list-content.eb0065ff0751f8701c55.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/payment-method-list-content.ef8c43478eab12edecb9.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/paymentMethod.ef4dd7644bf86ab42f91.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/personal-content.077b00d9872b0689b8e6.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/personal-header.8cc19e6a17fc461c7d3d.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/pickup.25feb999a2c3426891bf.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/pickup.db96c4ce6a499919f002.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/profile-header.073ed2bd6f73eefd7343.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/profile-nav-content.4dc4b2e5fe3f906e680c.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/profile-nav-content.f1f12d3df80ea246c73e.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/promoCodes.f5bf38b891c1fdc1e22f.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/react.2c719022b5965a5a5294.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/reactIntl.fr.58c70e096943205c606e.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/rewards-app-bar-header.875eb45c4e1ad484da82.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/rewards-content.06da3eddf35f1b34290a.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/rewards-content.783a1ccada918894ef38.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/rewards-how-it-works-content.64cb2f083030115ff8ef.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/rewards-how-it-works-content.f6e5e8ad7c5f8e58513e.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/rewards.0cbacde2f73ea6008862.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/rewards.98f6f5cf2ec8c6a87117.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/secure-ui-form-content.67c7c762020864cfc246.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/secure-ui-form-content.aa3b3fabb33fb263b0dd.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/settings-content.c81328def2f4058b9612.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/settings-header.8f9f7c1c62bea4e09efd.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/shared.9b5acd20a55f57701e21.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/shared.cede7547b8e720ea539e.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/signIn.7116c864fb3c16c9ddc4.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/signIn.817bac5eed56dfd507c9.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/starbucks-partner-content.84582a6f5775a816a6e0.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/store-locator-page.2e8da202d0877a339431.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/store-locator-page.d4debe6e9428de4754ce.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/storeLocator.a38d8ce7673b21dfab95.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/svc-card-manage-content.7656890951edd75dcad5.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/svc-card-manage-content.bb19a16f4748e6d7071d.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/svc-cards-list-content.23eb3370509ea08d5fc5.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/svc-cards-list-content.28e6da78392981548716.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/unsubscribe.4d67fdfe78df5873e476.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/update-password-content.1de762e45fe9b5290436.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/update-password-content.bd0d8e2b7415251260f0.css",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/vendor.119713cf60056fae2951.chunk.js",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/68974a6dc349aa63eb98d165c0f26657.woff",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/891bac4bf2cf726a4a3ccf8560d7c300.woff",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/9072643e9f07efac73cc4b79a2b55d7c.woff",
    "revision": null
}, {
    "url": "https://assets.web.starbucksassets.com/weblx/static/a04d3c474ae54100589fa362d8f6db2a.woff",
    "revision": null
}, {
    "url": "/",
    "revision": "6348259f340a2a5bc132b5af54350274"
}]);

// Routes are now evaluated in a first-registered-wins order.

// Don't cache data routes
workbox.routing.registerRoute(new RegExp(`${escapeChars('/')}(bff|proxy).*`), new workbox.strategies.NetworkOnly());

// Always go to the network for account create and signin
workbox.routing.registerRoute(/\/account\//, new workbox.strategies.NetworkOnly());

// Go to network first for when "base html" needs updating.
workbox.routing.registerRoute(/[?&]bustprecache=.*$/i, new workbox.strategies.NetworkFirst());

// Go to network first when there is a "trailing slash"
// nginx will take care of removing it
// and hence the user will be redirected to the "slashless" route
// and eventually will be using the cached data if it exists
workbox.routing.registerRoute(/\/$/, new workbox.strategies.NetworkFirst());

// Route for runtime caching of other local static images
workbox.routing.registerRoute(new RegExp(`${escapeChars('/weblx/images')}.*`), new workbox.strategies.CacheFirst({
    cacheName: 'local-static-images',
    cacheableResponse: {
        statuses: [0, 200]
    },
}));

// route for runtime caching of other local static assets
// such as split bundles, etc.
workbox.routing.registerRoute(new RegExp(`${escapeChars('https://assets.web.starbucksassets.com/weblx/static')}.*`), new workbox.strategies.CacheFirst({
    cacheName: 'other-lazy-loaded',
    cacheableResponse: {
        statuses: [0, 200]
    },
}));

// route for runtime caching of image URLs that
// are referenced in API results
workbox.routing.registerRoute(/https:\/\/test.openapi.starbucks.com\/.+\.(png|jpg|jpeg|svg|gif|webp|bmp)/, new workbox.strategies.CacheFirst({
    cacheName: 'test-api-images',
    cacheableResponse: {
        statuses: [0, 200]
    },
}));

workbox.routing.registerRoute(/https:\/\/globalassets.starbucks.com\/.+\.(png|jpg|jpeg|svg|gif|webp|bmp)/, new workbox.strategies.CacheFirst({
    cacheName: 'api-images',
    cacheableResponse: {
        statuses: [0, 200]
    },
}));

// TODO: find another way to handle this using the new WorkBox fallback features
// https://developers.google.com/web/tools/workbox/guides/advanced-recipes

// // Fallback to "base html" for routes that
// // don't end in a file extension
// const pageRouteHandler = workbox.precaching.createHandlerBoundToURL('/');
// const navigationRoute = new workbox.routing.NavigationRoute(pageRouteHandler, {
//   allowlist: [/^(?!.*\.\w{1,7}$)/],
// });

// workbox.routing.registerRoute(navigationRoute);

self.addEventListener('activate', ()=>{
        self.clients.matchAll().then((clients)=>{
                clients.forEach((client)=>{
                        client.postMessage({
                            type: 'versionCheck',
                            version: 35,
                        });
                    }
                );
            }
        );
    }
);
z
z

