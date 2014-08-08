(function() {

  define(['jquery', "ExampleJSON"], function($, ExampleJSON) {
    var exports, gVars, makeItHappen, moduleName;
    exports = {};
    gVars = {};
    moduleName = "demo";

    makeItHappen = function($this) {
        ExampleJSON.init();

        var request_uri = location.pathname + location.search;
        var document_url = document.URL;
        request_uri = encodeURIComponent(request_uri);
        document_url = encodeURIComponent(document_url);
        $('[data-js-variable="document_url"]').html(document_url);
        $('[data-js-variable="request_uri"]').html(request_uri);
    };
    exports.init = function($this) {
        var $element;
        if ($this !== void 0) {
            return makeItHappen($this);
        }
        else {
            $element = $('[data-module="' + moduleName + '"]');
            return $element.each(function() {
                return makeItHappen($(this));
            });
        }
        // $element = $('[data-module="' + moduleName + '"]');
        // if ($element.length > 0) {
        //     return $element.each(function() {
        //         return makeItHappen($(this));
        //     });
        // }
    };
    return exports;
    });

}).call(this);
