<?php

namespace Plugin\Portfolio\Widget\Portfolio;

class Controller extends \Ip\WidgetController
{
    public function getTitle()
    {
        return __('Portfolio', 'Portfolio', false);
    }
    
    public function generateHtml($revisionId, $widgetId, $data, $skin)
    {
        $data['widgetId'] = $widgetId;
        if (!isset($data['originalWidgetId']))
        {
            $data['originalWidgetId'] = $widgetId;
        }
        
        if (!isset($data['filters']))
        {
            $data['filters'] = array();
        }
        
        if (!isset($data['tiles']))
        {
            $data['tiles'] = array();
        }
        
        if (!isset($data['nextBlockId']))
        {
            $data['nextBlockId'] = 0;
        }
        
        return parent::generateHtml($revisionId, $widgetId, $data, $skin);
    }
    
    public function dataForJs($revisionId, $widgetId, $data, $skin)
    {
        if (!isset($data['widgetId']))
        {
            $data['widgetId'] = $widgetId;
        }
        
        return parent::dataForJs($revisionId, $widgetId, $data, $skin);
    }
    
    public function adminHtmlSnippet()
    {
        return ipView('snippet/edit.php')->render();
    }
    
    public function update($widgetId, $postData, $currentData)
    {
        if (!isset($postData['tiles']))
        {
            $postData['tiles'] = array();
        }
        
        $tiles = $postData['tiles'];
        $newFilters = array();
        
        foreach ($tiles as $key => $value) {
            $filterStr = explode(";", $tiles[$key]['filter']);
            
            $filterStrLen = count($filterStr);
            
            if (!isset($tiles[$key]['filters'])) {
                $tiles[$key]['filters'] = array();
            }
            
            for ($i = 0; $i < $filterStrLen; $i++) {
                if (!$this->in_array_r($filterStr[$i], $newFilters)) {
                    $newFilters[] = array('text' => $filterStr[$i],
                                          'filter' => crc32($filterStr[$i]));
                }
                    
                if (!$this->in_array_r($filterStr[$i], $tiles[$key]['filters'])) {
                    $tiles[$key]['filters'][] = array('text' => $filterStr[$i],
                                                      'filter' => crc32($filterStr[$i]));
                }
            }
        }
        
        
        $postData['tiles'] = $tiles;
        $postData['filters'] = $newFilters;
        $postData['originalWidgetId'] = empty($currentData['originalWidgetId']) ? $widgetId : $currentData['originalWidgetId'];
        
        return $postData;
    }
    
    public function duplicate($oldId, $newId, $data)
    {
        if (!isset($data['originalWidgetId']))
        {
            $data['originalWidgetId'] = $oldId;
        }
        
        return $data;
    }
    
    protected function in_array_r ($needle, $haystack)
    {
        foreach($haystack as $key=>$value) {
            if($needle===$value OR (is_array($value) && $this->in_array_r($needle,$value) !== false)) {
                return true;
            }
        }
        return false;
    }
}