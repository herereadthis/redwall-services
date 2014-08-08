

(function() {
    define(['jquery'], function($) {
        var exports,  makeItHappen, moduleName, exampleAjax;
        exports = {};
        moduleName = "example_json";
        exampleAjax = function($this) {
            console.log($this.html());
            var jsonFile;
            jsonFile = "http://redwall.herereadthis.com/api/example/";

            $.getJSON(jsonFile, function(data) {
                var fubar = data;
                console.log(fubar.length);
                // $this.append(JSON.stringify(fubar));
                $this.html($('<ul />'));
                $ul = $this.find('ul');
                var _i, _len;
                for (_i = 0, _len = data.length;_i < _len;_i++) {
                    // for (strName in data[_i]) {
                    //     strValue = data[_i][strName];
                    //     console.log(strName, strValue);
                    // }
                    $ul.append($('<li />').html(data[_i].name + ": ").append(data[_i].age));
                }
            });

        };
        makeItHappen = function($this) {
            exampleAjax($this);
        };
        exports.init = function($this) {
            var element;
            if ($this !== void 0) {
                return makeItHappen($this);
            }
            else {
                element = $('[data-module="' + moduleName + '"]');
                return element.each(function() {
                    return makeItHappen($(this));
                });
            }
        };
        return exports;
    });
}).call(this);
