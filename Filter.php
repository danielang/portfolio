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
                'title' => __('Tiles', 'Portfolio', false),
                'attributes' => array(
                    'class' => '_edit ipsWidgetTiles'
                )
            );
            $optionsMenu[] = array(
                'title' => __('Filter', 'Portfolio', false),
                'attributes' => array(
                    'class' => '_edit ipsWidgetFilter'
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