<div class="portfoliocontent">
    <nav id="filter<?php echo $widgetId; ?>" class="col-md-12 text-center isotopeFilter">
        <ul<?php if (ipIsManagementState()) { echo ' class="sortable' . $widgetId . '"'; } ?>>
            <li class="pin"><a href="#" class="current btn-theme btn-small" data-filter="*"><?php echo _e('All', 'Portfolio'); ?></a></li>
            
            <?php
                foreach ($filters as $filteritem) { ?>
                    <li <?php if (ipIsManagementState()) { echo ' class="ui-state-default"'; } ?>>
                        <?php if (ipIsManagementState()) { echo '<span class="handle portfoliofont-resize-horizontal" ></span>'; } ?>
                        <a href="#" class="btn-theme btn-small" data-filter=".<?php echo $widgetId . $filteritem['filter']; ?>" >
                            <?php echo $filteritem['text']; ?>
                        </a>
                    </li>
            <?php } ?>
            
        </ul>
    </nav>
    
    <?php if (count($tiles) == 0) { ?>
        <p><?php _e('No Items are configured yet. Please click the gear of this plugin and select Items.', 'Portfolio'); ?></p>
    <?php } ?>
    
    <div class="col-md-12">
        <div class="row">
            <div class="portfolio-items isotopeWrapper<?php echo $widgetId; ?> clearfix">
                
                <?php foreach ($tiles as $tile) { ?>
                    <article <?php if (ipIsManagementState()) { echo 'title="' . $tile['label'] . '"'; } ?>
                        class="col-md-4 isotopeItem<?php foreach ($tile['filters'] as $f) {
                            echo ' ' . $widgetId . $f['filter'];
                    } ?>">
				        <div>
                            <?php echo \Ip\Internal\Content\Model::generateBlock('portfolio' . $originalWidgetId . '-' . $tile['blockId'], $revisionId, 0, ipIsManagementState()); ?>
                        </div>
                    </article>
                <?php } ?>
                							  
            </div>
        </div>
    </div>
</div>

<?php
    $portfolioJsScript = '
                
        $(document).ready(function () {
            "use strict"; 
                
            window.portfolio' . $widgetId . 'Init = function () {
                        
                if($(\'.isotopeWrapper' . $widgetId . '\').length){
                    var $container = $(\'.isotopeWrapper' . $widgetId . '\');
                    var $resize = $(\'.isotopeWrapper' . $widgetId . '\').attr(\'width\');

                    $container.isotope({
                        itemSelector: \'.isotopeItem\',
                        resizable: false, // disable normal resizing
                        masonry: {
                            columnWidth: $container.width() / $resize
                        }
                    });

                    $(\'#filter' . $widgetId . ' a\').click(function(){
                        $(\'#filter' . $widgetId . ' a\').removeClass(\'current\');
                        $(this).addClass(\'current\');
                        var selector = $(this).attr(\'data-filter\');
                        $container.isotope({
                            filter: selector,
                            animationOptions: {
                                duration: 1000,
                                easing: \'easeOutQuart\',
                                queue: false
                            }
                        });
                        return false;
                    });
                }
            };
                
                
                
            window.portfolio' . $widgetId . 'Init();
        });
            
        $(window).load( function() {
            if (window[\'portfolio' . $widgetId . 'Init\'])
                window.portfolio' . $widgetId . 'Init();
        });';

    ipAddJsContent('portfolio' . $widgetId, $portfolioJsScript);
?>