/**
 * Tile container
 */
(function($) {
    "use strict";

    var methods = {
        init : function(options) {
            return this.each(function() {
                var $this = $(this);
                var data = $this.data('ipWidget_portfolio_tile_container');
                // If the plugin hasn't been initialized yet
                var tiles = null;
                if (options.tiles) {
                    tiles = options.tiles;
                } else {
                    tiles = new Array();
                }

                if (!data) {
                    $this.html('');
                    $this.data('ipWidget_portfolio_tile_container', {
                        tiles : tiles,
                        tileTemplate : options.tileTemplate,
                        nextBlockId : options.nextBlockId
                    });

                    if (! tiles instanceof Array) {
                        tiles = new Array();
                    }

                    for (var i in tiles) {
                        $this.ipWidget_portfolio_tile_container('addTile', tiles[i]);
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
            var options = $this.data('ipWidget_portfolio_tile_container');
            
            if (typeof tileData !== 'object') {
                tileData = {
                    blockId : options.nextBlockId
                };
                
                // count up
                options.nextBlockId++;
            }
            
            // generate Tile
            var $newTileRecord = options.tileTemplate.clone();
            $newTileRecord.ipWidget_portfolio_tile(tileData);

            $this.append($newTileRecord);
        },

        getTiles : function () {
            var $this = this;
            return $this.find('.ipsTileTemplate');
        },
        
        getNextBlockId : function () {
            var $this = this;
            var options = $this.data('ipWidget_portfolio_tile_container');
            return options.nextBlockId;
        },

        destroy : function () {
            return this.each(function() {
                $.removeData(this, 'ipWidget_portfolio_tile_container');
            });
        }

    };

    $.fn.ipWidget_portfolio_tile_container = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.ipWidget_portfolio_tile_container');
        }

    };

})(jQuery);