/**
 * Filter container
 */
(function($) {
    "use strict";

    var methods = {
        init : function(options) {
            return this.each(function() {
                var $this = $(this);
                var data = $this.data('ipWidget_portfolio_filter_container');
                // If the plugin hasn't been initialized yet
                var filters = null;
                if (options.filters) {
                    filters = options.filters;
                } else {
                    filters = new Array();
                }

                if (!data) {
                    $this.html('');
                    $this.data('ipWidget_portfolio_filter_container', {
                        filters : filters,
                        filterTemplate : options.filterTemplate
                    });

                    if (! filters instanceof Array) {
                        filters = new Array();
                    }

                    for (var i in filters) {
                        $this.ipWidget_portfolio_filter_container('addFilter', filters[i]);
                    }
                    $this.sortable({
                        handle: '.ipsFilterMove',
                        cancel: false
                    });
                }
            });
        },

        addFilter : function (filterData) {
            var $this = this;
            var options = $this.data('ipWidget_portfolio_filter_container');
            
            if (typeof filterData !== 'object') {
                filterData = {};              
            }
            
            // generate Filter
            var $newFilterRecord = options.filterTemplate.clone();
            $newFilterRecord.ipWidget_portfolio_filter(filterData);

            $this.append($newFilterRecord);
        },

        getFilters : function () {
            var $this = this;
            return $this.find('.ipsFilterTemplate');
        },
        
        destroy : function () {
            return this.each(function() {
                $.removeData(this, 'ipWidget_portfolio_filter_container');
            });
        }

    };

    $.fn.ipWidget_portfolio_filter_container = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.ipWidget_portfolio_filter_container');
        }

    };

})(jQuery);