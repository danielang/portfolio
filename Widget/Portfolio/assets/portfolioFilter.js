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

                var data = $this.data('ipWidget_portfolio_filter');


                // If the plugin hasn't been initialized yet
                if (!data) {
                    data = {
                        options : {
                            filter : ''
                        }
                    };
                    
                    if (options.text) {
                        data.options.filter = options.text;
                    }
                    
                    $this.data('ipWidget_portfolio_filter', {
                        options : data.options
                    });

                    $this.find('.ipsFilter').val(data.options.filter);
                }

                return $this;
            });
        },
        
        getFilter : function() {
            var $this = this;
            var tmpData = $this.data('ipWidget_portfolio_filter');
            return tmpData.options.filter;
        }
    };

    $.fn.ipWidget_portfolio_filter = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.ipWidget_portfolio_filter');
        }

    };

})(jQuery);
