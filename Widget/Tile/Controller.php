<?php

namespace Plugin\Portfolio\Widget\Tile;

class Controller extends \Ip\WidgetController
{
    public function getTitle()
    {
        return __('Tile', 'Portfolio', false);
    }
    
    public function generateHtml($revisionId, $widgetId, $data, $skin)
    {
        return parent::generateHtml($revisionId, $widgetId, $data, $skin);
    }
    
    public function adminHtmlSnippet()
    {
        $form = new \Ip\Form();
        
        return ipView('snippet/edit.php', array('form' => $form))->render();
    }
}