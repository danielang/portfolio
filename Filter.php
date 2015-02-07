<?php

namespace Plugin\Portfolio;

class Filter
{
    public static function ipWidgetManagementMenu($optionsMenu, $widgetRecord)
    {
        // Portfolio-Widget
        if ($widgetRecord['name'] == 'Portfolio')
        {
            $optionsMenu[] = array(
                'title' => __('Items', 'Portfolio', false),
                'attributes' => array(
                    'class' => '_edit ipsWidgetItems'
                )
            );
        }
        
        // Tile-Widget
        if ($widgetRecord['name'] == 'Tile')
        {
            $optionsMenu[] = array(
                'title' => __('Settings', 'Portfolio', false),
                'attributes' => array(
                    'class' => '_edit ipsWidgetSettings'
                )
            );
        }
        
        return $optionsMenu;
    }
}