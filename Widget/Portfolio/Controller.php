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
        $data['revisionId'] = $revisionId;
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
        if (!isset($postData['filters']))
        {
            $postData['filters'] = array();
        }
        
        $tiles = $postData['tiles'];
        $oldFilters = $postData['filters'];
        $newFilters = array();
        $filters = array();
        
        foreach ($tiles as $key => $value) {
            
            $tiles[$key]['filters'] = array();
            
            if (!empty($tiles[$key]['filter']) OR $tiles[$key]['filter'] != null)
            {
                $filterStr = explode(";", $tiles[$key]['filter']);

                $filterStrLen = count($filterStr);

                for ($i = 0; $i < $filterStrLen; $i++) {
                    $filteritem = array('text' => $filterStr[$i],
                                        'filter' => crc32($filterStr[$i]));
                    
                    if (!$this->in_array_r($filterStr[$i], $oldFilters) && !$this->in_array_r($filterStr[$i], $filters) && !$this->in_array_r($filterStr[$i], $newFilters)) {
                        $newFilters[] = $filteritem;
                    }
                    elseif ($this->in_array_r($filterStr[$i], $oldFilters) && !$this->in_array_r($filterStr[$i], $filters) && !$this->in_array_r($filterStr[$i], $newFilters))
                    {
                        array_splice( $filters, array_search($filterStr[$i], $oldFilters), 0, array($filteritem) );
                    }
                    
                    if (!$this->in_array_r($filterStr[$i], $tiles[$key]['filters'])) {
                        $tiles[$key]['filters'][] = $filteritem;
                    }
                }    
            }
        }
        
        // merge the arrays
        $filters = array_merge($filters, $newFilters);
        
        $postData['tiles'] = $tiles;
        $postData['filters'] = $filters;
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
    
    protected function array_insert( $array, $pairs, $key, $position = 'after' ) {
        $key_pos = array_search( $key, array_keys( $array ) );

        if ( 'after' == $position )
            $key_pos++;

        if ( false !== $key_pos ) {
            $result = array_slice( $array, 0, $key_pos );
            $result = array_merge( $result, $pairs );
            $result = array_merge( $result, array_slice( $array, $key_pos ) );
        }
        else {
            $result = array_merge( $array, $pairs );
        }

        return $result;
    }
}