var IpWidget_Tile;

(function ($) {
    "use strict";
    
    IpWidget_Tile = function () {
        
        this.widgetObject = null;
        this.data = {};
        
        this.init = function (widgetObject, data) {
            var context = this;
            
            this.widgetObject = widgetObject;
            this.data = data;
            
            this.$itemsButton = this.widgetObject.find('.ipsWidgetSettings');
            this.$itemsButton.on('click', function (e) {
                $.proxy(context.openOptions(), context);
            });
            
        };
        
        this.onAdd = function () {
            $.proxy(this.openOptions, this);
        };
        
        this.openOptions = function () {
            var context = this;
            
            $('#ipWidgetTilePopup').remove();
                        
            // load content
            var postdata = {
                sa: 'Content.widgetPost',
                securityToken: ip.securityToken,
                widgetId: this.data.widgetId
            }

            $.ajax({
                url: ip.baseUrl,
                data: postdata,
                dataType: 'json',
                type: 'POST',
                success: function (response) {
                    // add recived html
                    $('body').append($(response.popup));
                    
                    // find popup
                    context.modal = $('#ipWidgetTilePopup')
                    
                    // open modal popup
                    context.modal.modal(); 

                    ipInitForms();

                    var $confirmButton = context.modal.find('.ipsConfirm');

                    $confirmButton.off(); // ensure we will not bind second time
                    $confirmButton.on('click', $.proxy(save, context));
                },
                error: function (response) {
                    alert('Error: ' + response.responseText);
                }

            });
        };
        
        var save = function (e) {
            var formData = this.modal.find('form').serializeArray();
            var tileData = {};
            
            // extract the values
            $.each(formData, function (key, value) {
                if ($.inArray(value.name, ['title', 'description', 'pagelink']) > -1) {
                    tileData[value.name] = value.value;
                }
                if (value.name === 'imagelink[]') {
                    if (!tileData.imagelink) {
                        tileData.imagelink = '';
                    }
                    tileData['imagelink'] = value.value;
                }
            });
            
            var data = {
                tile: tileData
            };

            // save widgetdata and reload
            this.widgetObject.save(data, true);
            
            // hide modal
            this.modal.modal('hide');
        };        
    };
        
})(jQuery);