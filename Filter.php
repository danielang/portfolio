<?php

namespace Plugin\Portfolio;

class Filter
{
    public static function ipWidgetManagementMenu($optionsMenu, $widgetRecord)
    {
        if ($widgetRecord['name'] == 'Portfolio')
        {
            $optionsMenu[] = array(
                'title' => __('Items', 'Portfolio', false),
                'attributes' => array(
                    'class' => '_edit ipsWidgetItems'
                )
            );
        }
        
        return $optionsMenu;
    }
}