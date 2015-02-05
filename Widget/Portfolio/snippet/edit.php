<div class="ip">
    <div id="ipWidgetPortfolioPopup" class="ipModulePortfolio modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php _e('Portfolio options', 'Portfolio'); ?></h4>
                </div>
                <div class="modal-body">
                    
                    <div class="ipWidget_Portfolio_container"></div>
                    <div class="hidden">
                        <div class="ipsTileTemplate">
                            <div class="portfolioTileGroup input-group">
                                <div class="input-group-btn">
                                    <button class="btn btn-default ipsTileMove" type="button" title="<?php _e('Drag', 'Ip-admin'); ?>"><i class="fa fa-arrows"></i></button>
                                </div>
                                
                                <table>
                                    <tr>
                                        <td>
                                            <?php echo __('Name', 'Portfolio') . ':'; ?>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control ipsTileLabel" name="label" value="" placeholder="<?php _e('Name', 'Portfolio'); ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo __('Filter', 'Portfolio') . ':'; ?>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control ipsTileFilter" name="filter" value="" placeholder="<?php _e('Separate by ;', 'Portfolio'); ?>" />
                                        </td>
                                    </tr>
                                </table>
                                
                                <div class="input-group-btn">
                                    <button class="btn btn-danger ipsTileRemove" type="button" title="<?php _e('Delete', 'Ip-admin'); ?>"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-new ipsTileAdd"><?php _e('Add new', 'Ip-admin'); ?></button>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __('Cancel', 'Ip-admin'); ?></button>
                    <button type="button" class="btn btn-primary ipsConfirm"><?php echo __('Confirm', 'Ip-admin'); ?></button>
                </div>
            </div>
        </div>
    </div>
    
    <div id="ipWidgetPortfolioTileOptionsPopup" class="ipModuleTileOptionsPopup modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php _e('Tile options', 'Portfolio'); ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo $form->render() ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('Cancel', 'Ip-admin'); ?></button>
                    <button type="button" class="btn btn-primary ipsConfirm"><?php _e('Confirm', 'Ip-admin'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>