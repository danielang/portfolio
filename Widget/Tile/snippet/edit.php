<div class="ip">
    <div id="ipWidgetPortfolioTilePopup" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php _e('Menu options', 'Portfolio'); ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo $form->render(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('Cancel', 'Portfolio'); ?></button>
                    <button type="button" class="btn btn-primary ipsConfirm"><?php _e('Confirm', 'Portfolio'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>