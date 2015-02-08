<div class="portfolio-item">

    <?php if (!empty($tile['imagelink'])) { ?>
    <img src="<?php echo ipFileUrl(ipReflection($tile['imagelink'], array(
        'type' => 'width',
        'width' => 400,
        //'height' => ipGetOption('SimpleProduct.imageHeight', 1000),
        'forced' => true))); ?>" alt="" />
    <?php } ?>
    
    <?php if (!empty($tile['pagelink'])) { ?>
    <a href="<?php echo $tile['pagelink']; ?>">
        <div class="portfolio-desc align-center">
                    
            <div class="folio-info">
                <h4><?php echo empty($tile['title']) ? null : $tile['title']; ?></h4>
                <h5><?php echo empty($tile['description']) ? null : $tile['description']; ?></h5>
                <p class="portfolio-desc-link"><i class="portfoliofont-2x portfoliofont-export"></i></p>
            </div>
        </div>
    </a>
    <?php } else { ?>
    
    <div class="portfolio-desc align-center">
                    
        <div class="folio-info">
            <h4><?php echo empty($tile['title']) ? null : $tile['title']; ?></h4>
            <h5><?php echo empty($tile['description']) ? null : $tile['description']; ?></h5>
        </div>
    </div>
    
    <?php } ?>
</div>