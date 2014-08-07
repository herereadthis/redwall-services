(function() {
    requirejs.config({
        paths: {
            'Demo': 'demo',
            "ExampleJSON": "example_json",
            "UniversalAnalytics": "universal_analytics",
            // "Analytics": "../components/greeneyes/src/js/analytics",
            "jquery": '../components/jquery/dist/jquery.min'
        }
    });
    require(['Demo', 'UniversalAnalytics'], function(Demo, UniversalAnalytics) {
        // if (Modernizr.touch === false) {
        // }
        // utilities on home page
        Demo.init();
        return UniversalAnalytics.track();
    });
}).call(this);
