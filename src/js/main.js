(function() {
    requirejs.config({
        paths: {
            // retro homepage
            'Demo': 'demo',
            "Analytics": "../components/greeneyes/src/js/analytics",
            "jquery": '../components/jquery/dist/jquery.min'
        }
    });
    require(['Demo', 'Analytics'], function(Demo, Analytics) {
        // if (Modernizr.touch === false) {
        // }
        // utilities on home page
        Demo.init();
        return Analytics.track();
    });
}).call(this);
