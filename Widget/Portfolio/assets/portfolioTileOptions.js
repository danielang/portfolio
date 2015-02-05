/**
 * Options popup
 */
(function($) {
    "use strict";

    var methods = {
        init : function(options) {
            if (!options) {
                options = {};
            }

            return this.each(function() {
                var $this = $(this);
                var data = $this.data('ipWidget_Portfolio_options');
                // If the plugin hasn't been initialized yet
                if (!data) {
                    data = {
                        fieldTypes : options.fieldTypes
                    };
                    $this.data('ipWidget_Portfolio_options', data);
                }

                return $this;
            });
        },

        showOptions : function(currentOptions) {
            var $this = this;
            var $optionsModal = $this;
            
            var $confirm = $this.find('.ipsConfirm');
            
            $('#ipWidgetPortfolioPopup').hide();

            $confirm.off().on('click', function() {
                var formData = $('#ipWidgetPortfolioTileOptionsPopup form').serializeArray();
                var options = {}
                
                $.each(formData, function (key, value) {
                    if ($.inArray(value.name, ['label', 'filter']) > -1) {
                        options[value.name] = value.value;
                    }
                });
                
                $('#ipWidgetPortfolioPopup').show();
                $optionsModal.modal( "hide" );
                $optionsModal.trigger('saveOptions.ipWidget_Portfolio', [options]);
            });

            $optionsModal.on('hide.bs.modal', function() {
                $('#ipWidgetPortfolioPopup').show();
            });

            // set options
            $this.find('input[name=label]').val(currentOptions.label);
            $this.find('input[name=filter]').val(currentOptions.filter);

            $this.modal();
        }
    };

    $.fn.ipWidget_Portfolio_options = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.ipWidget_Portfolio_options');
        }
    };

})(jQuery);