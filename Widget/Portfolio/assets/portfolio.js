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
            
            this.$tilesButton = this.widgetObject.find('.ipsWidgetTiles');
            this.$tilesButton.on('click', function (e) {
                $.proxy(context.openTilesOptions(), context);
            });
            
            this.$filterButton = this.widgetObject.find('.ipsWidgetFilter');
            this.$filterButton.on('click', function (e) {
                $.proxy(context.openFilterOptions(), context);
            });
            
            // init isotope
            if (window['portfolio' + this.data.widgetId + 'Init'])
                window['portfolio' + this.data.widgetId + 'Init']();
            
            
            // init tiles container
            this.tilesModal = $('#ipWidgetPortfolioTilesPopup');
            this.tilesContainer = this.tilesModal.find('.ipWidget_portfolio_tile_container');
            
            var options = {}
            
            if (this.data['tiles']) {
                options.tiles = this.data.tiles;
            } else {
                options.tiles = new Array();
            }
            
            if (this.data['nextBlockId']) {
                options.nextBlockId = this.data.nextBlockId;
            } else {
                options.nextBlockId = 0;
            }
            
            options.tileTemplate = this.tilesModal.find('.hidden .ipsTileTemplate');
            
            this.tilesContainer.ipWidget_portfolio_tile_container('destroy');
            this.tilesContainer.ipWidget_portfolio_tile_container(options);
            
            
            // init filter itemsContainer
            this.filterModal = $('#ipWidgetPortfolioFilterPopup');
            this.filterContainer = this.filterModal.find('.ipWidget_portfolio_filter_container');
            
            var options = {}
            
            if (this.data['filters']) {
                options.filters = this.data.filters;
            } else {
                options.filters = new Array();
            }
            
            options.filterTemplate = this.filterModal.find('.hidden .ipsFilterTemplate');
            
            this.filterContainer.ipWidget_portfolio_filter_container('destroy');
            this.filterContainer.ipWidget_portfolio_filter_container(options);
            
            
            // init filter sortation
            /*$('.sortable' + this.data.widgetId).sortable({ axis: "x", cursor: "move", handle: ".handle", items: '> li:not(.pin)',
                stop: function( event, ui ) {
                    context.filterSortation = $(this).sortable('toArray', {attribute: 'data-sortable'});
                    
                    alert(context.filterSortation);
                    
                }
            });
            
            $('.sortable' + this.data.widgetId).disableSelection();*/
        };
        
        this.openTilesOptions = function () {
            this.addButton = this.tilesModal.find('.ipsTileAdd');
            this.confirmButton = this.tilesModal.find('.ipsConfirm');
            
            
            // reinit tilesContainer
            var options = {}
            
            if (this.data['tiles']) {
                options.tiles = this.data.tiles;
            } else {
                options.tiles = new Array();
            }
            
            if (this.data['nextBlockId']) {
                options.nextBlockId = this.data.nextBlockId;
            } else {
                options.nextBlockId = 0;
            }
            
            options.tileTemplate = this.tilesModal.find('.hidden .ipsTileTemplate');
            
            this.tilesContainer.ipWidget_portfolio_tile_container('destroy');
            this.tilesContainer.ipWidget_portfolio_tile_container(options);
            
            
            // Button binding
            this.confirmButton.off(); // ensure we will not bind second time
            this.confirmButton.on('click', $.proxy(save, this));
            
            this.addButton.off(); // ensure we will not bind second time
            this.addButton.on('click', $.proxy(addTile, this));
            
            
            // show tilesModal
            this.tilesModal.modal();
            
            ipInitForms();
        };
        
        var save = function (e) {
            var data = this.getData();
            
            // save widgetdata and reload
            this.widgetObject.save(data, true);
            
            // hide tilesModal
            this.tilesModal.modal('hide');
        };
        
        var addTile = function () {
            this.tilesContainer.ipWidget_portfolio_tile_container('addTile');
        };
        
        this.getData = function() {
            var data = Object();

            data.tiles = [];
            var $tiles = this.tilesContainer.ipWidget_portfolio_tile_container('getTiles');
            $tiles.each(function(index) {
                var $this = $(this);
                var tmpField = new Object();
                tmpField.label = $this.ipWidget_portfolio_tile('getLabel');
                tmpField.filter = $this.ipWidget_portfolio_tile('getFilter');
                tmpField.blockId = $this.ipWidget_portfolio_tile('getBlockId');
                
                var status = $this.ipWidget_portfolio_tile('getStatus');
                if (status != 'deleted') {
                    data.tiles.push(tmpField);
                }
            });
            
            data.filters = [];
            var $filters = this.filterContainer.ipWidget_portfolio_filter_container('getFilters');
            $filters.each(function(index) {
                var $this = $(this);
                var tmpField = new Object();
                tmpField.filter = $this.ipWidget_portfolio_filter('getFilter');
                
                data.filters.push(tmpField);
            });
            
            data.nextBlockId = this.tilesContainer.ipWidget_portfolio_tile_container('getNextBlockId');
            
            return data;
        };
        
        this.openFilterOptions = function () {
            this.confirmButton = this.filterModal.find('.ipsConfirm');
            
            
            // reinit filters container
            var options = {}
            
            if (this.data['filters']) {
                options.filters = this.data.filters;
            } else {
                options.filters = new Array();
            }
            
            options.filterTemplate = this.filterModal.find('.hidden .ipsFilterTemplate');
            
            this.filterContainer.ipWidget_portfolio_filter_container('destroy');
            this.filterContainer.ipWidget_portfolio_filter_container(options);
            
            
            // Button binding
            var context = this;
            this.confirmButton.off(); // ensure we will not bind second time
            this.confirmButton.on('click', function(e) { console.log(context.getData()); }); //$.proxy(save, this));

            
            // show filtersModal
            this.filterModal.modal();
            
            ipInitForms();
        };
    };
        
})(jQuery);