var IpWidget_Portfolio;

(function ($) {
    "use strict";
    
    IpWidget_Portfolio = function () {
        
        this.widgetObject = null;
        this.data = {};
        
        this.init = function (widgetObject, data) {
            var context = this;
            
            this.widgetObject = widgetObject;
            this.data = data;
            
            this.$itemsButton = this.widgetObject.find('.ipsWidgetItems');
            this.$itemsButton.on('click', function (e) {
                $.proxy(context.openOptions(), context);
            });
            
            // init isotope
            if (window['portfolio' + this.data.widgetId + 'Init'])
                window['portfolio' + this.data.widgetId + 'Init']();
        };
        
        this.openOptions = function () {
            var context = this;
            var instanceData = this.data;
            
            this.modal = $('#ipWidgetPortfolioPopup');
            this.container = this.modal.find('.ipWidget_Portfolio_container');
            
            this.addButton = this.modal.find('.ipsTileAdd');
            this.confirmButton = this.modal.find('.ipsConfirm');
            
            
            // Init Container
            var options = {}
            
            if (instanceData['tiles']) {
                options.tiles = instanceData.tiles;
            } else {
                options.tiles = new Array();
            }
            
            if (instanceData['nextBlockId']) {
                options.nextBlockId = instanceData.nextBlockId;
            } else {
                options.nextBlockId = 0;
            }
            
            options.tileTemplate = this.modal.find('.hidden .ipsTileTemplate');
            
            this.container.ipWidget_Portfolio_container('destroy');
            this.container.ipWidget_Portfolio_container(options);
            
            
            // Button binding
            this.confirmButton.off(); // ensure we will not bind second time
            this.confirmButton.on('click', $.proxy(save, this));
            
            this.addButton.off(); // ensure we will not bind second time
            this.addButton.on('click', $.proxy(addTile, this));
            
            
            // show modal
            this.modal.modal();
            
            ipInitForms();
        };
        
        var save = function (e) {
            var data = this.getData();
            
            // save widgetdata and reload
            this.widgetObject.save(data, true);
            
            // hide modal
            this.modal.modal('hide');
            
        };
        
        var addTile = function () {
            this.container.ipWidget_Portfolio_container('addTile');
        };
        
        this.getData = function() {
            var data = Object();

            data.tiles = [];
            var $tiles = this.container.ipWidget_Portfolio_container('getTiles');
            $tiles.each(function(index) {
                var $this = $(this);
                var tmpField = new Object();
                tmpField.label = $this.ipWidget_Portfolio_Tile('getLabel');
                tmpField.filter = $this.ipWidget_Portfolio_Tile('getFilter');
                tmpField.blockId = $this.ipWidget_Portfolio_Tile('getBlockId');
                
                var status = $this.ipWidget_Portfolio_Tile('getStatus');
                if (status != 'deleted') {
                    data.tiles.push(tmpField);
                }
            });
            
            data.nextBlockId = this.container.ipWidget_Portfolio_container('getNextBlockId');
            
            return data;
        };
    };
        
})(jQuery);