/**
 * Tile container
 */
(function($) {
    "use strict";

    var methods = {
        init : function(options) {
            return this.each(function() {
                var $this = $(this);
                var data = $this.data('ipWidget_Portfolio_container');
                // If the plugin hasn't been initialized yet
                var tiles = null;
                if (options.tiles) {
                    tiles = options.tiles;
                } else {
                    tiles = new Array();
                }

                if (!data) {
                    $this.html('');
                    $this.data('ipWidget_Portfolio_container', {
                        tiles : tiles,
                        tileTemplate : options.tileTemplate,
                        tileOptionsPopup : options.tileOptionsPopup
                    });

                    if (! tiles instanceof Array) {
                        tiles = new Array();
                    }

                    for (var i in tiles) {
                        $this.ipWidget_Portfolio_container('addTile', tiles[i]);
                    }
                    $this.sortable({
                        handle: '.ipsTileMove',
                        cancel: false
                    });
                }
            });
        },

        addTile : function (tileData) {
            var $this = this;
            if (typeof tileData !== 'object') {
                tileData = {};
            }
            var data = tileData;
            data.tileOptionsPopup = $this.data('ipWidget_Portfolio_container').tileOptionsPopup;
            var $newTileRecord = $this.data('ipWidget_Portfolio_container').tileTemplate.clone();
            $newTileRecord.ipWidget_Portfolio_Tile(data);

            $this.append($newTileRecord);

        },



        getTiles : function () {
            var $this = this;
            return $this.find('.ipsTileTemplate');
        },

        destroy : function () {
            return this.each(function() {
                $.removeData(this, 'ipWidget_Portfolio_container');
            });
        }

    };

    $.fn.ipWidget_Portfolio_container = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.ipWidget_Portfolio_container');
        }

    };

})(jQuery);