/**
 * General Tile
 */
(function($) {
    "use strict";

    var methods = {
        init : function(options) {
            if (typeof options !== 'object') {
                options = {};
            }

            return this.each(function() {

                var $this = $(this);

                var data = $this.data('ipWidget_portfolio_tile');


                // If the plugin hasn't been initialized yet
                if (!data) {
                    data = {
                        options : {
                            label : '',
                            filter : '',
                            blockId : 0
                        }
                    };
                    
                    if (options.label) {
                        data.options.label = options.label;
                    }
                    if (options.filter) {
                        data.options.filter = options.filter;
                    }
                    if (options.blockId) {
                        data.options.blockId = options.blockId;
                    }                    
                    
                    $this.data('ipWidget_portfolio_tile', {
                        options : data.options
                    });

                    var field = $this.find('.ipsTileLabel');
                    field.val(data.options.label);
                    field.on('input', function (e) {
                        $this.data('ipWidget_portfolio_tile').options.label = e.target.value;
                    });
                    
                    var field = $this.find('.ipsTileFilter');
                    field.val(data.options.filter);
                    field.on('input', function (e) {
                        $this.data('ipWidget_portfolio_tile').options.filter = e.target.value;
                    });
                    
                    //$this.find('.ipsTileLabel').val(data.options.label);
                    //$this.find('.ipsTileFilter').val(data.options.filter);
                    
                    /*if (options.options) {
                        $.proxy(setOptions, $this)(options.options);
                    }*/

                }

                var $thisForEvent = $this;
                
                $this.find('.ipsTileRemove').bind('click', function(event){
                    $thisForEvent.ipWidget_portfolio_tile('setStatus', 'deleted');
                    $thisForEvent.hide();
                    event.preventDefault();
                });
                
                
                return $this;
            });
        },

        getOptions : function () {
            var $this = $(this);
            var data = $this.data('ipWidget_portfolio_tile');
            if (data.options) {
                return data.options;
            } else {
                return null;
            }
        },

        getLabel : function() {
            var $this = this;
            var tmpData = $this.data('ipWidget_portfolio_tile');
            return tmpData.options.label;
        },
        
        getFilter : function() {
            var $this = this;
            var tmpData = $this.data('ipWidget_portfolio_tile');
            return tmpData.options.filter;
        },
        
        getBlockId : function() {
            var $this = this;
            var tmpData = $this.data('ipWidget_portfolio_tile');
            return tmpData.options.blockId;
        },

        getStatus : function() {
            var $this = this;
            var tmpData = $this.data('ipWidget_portfolio_tile');
            return tmpData.status;
        },

        setStatus : function(newStatus) {
            var $this = this;
            var tmpData = $this.data('ipWidget_portfolio_tile');
            tmpData.status = newStatus;
            $this.data('ipWidget_portfolio_tile', tmpData);

        }
    };

    var setOptions = function (options) {
        var $this = this;

        var data = $this.data('ipWidget_portfolio_tile');
        if (!data.options) {
            data.options = {};
        }
        data.options = options;
        $this.data('ipWidget_portfolio_tile', data);
    };

    $.fn.ipWidget_portfolio_tile = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.ipWidget_portfolio_tile');
        }

    };

})(jQuery);
