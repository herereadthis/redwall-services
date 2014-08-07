(function() {

  define(['jquery'], function($) {
    var exports, gVars, makeItHappen, moduleName;
    exports = {};
    gVars = {};
    moduleName = "demo";

    makeItHappen = function($this) {
        console.log('foo');
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
