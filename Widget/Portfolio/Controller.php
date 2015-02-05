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
        if (!isset($data['widgetId']))
        {
            $data['widgetId'] = $widgetId;
        }
        
        if (!isset($data['filters']))
        {
            $data['filters'] = array();
        }
        
        if (!isset($data['items']))
        {
            $data['items'] = array();
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
        $form = new \Ip\Form();
        
        $form->setEnvironment(\Ip\Form::ENVIRONMENT_ADMIN);

        $field = new \Ip\Form\Field\Text(
            array(
                'name' => 'label',
                'label' => __('Name', 'Portfolio'),
                'note' => __('only displayed in the Settings', 'Portfolio'),
                'value' => null
            )
        );
        $field->addValidator('Required');
        $form->addField($field);

        $field = new \Ip\Form\Field\Text(
            array(
                'name' => 'filter',
                'label' => __('Filter', 'Portfolio'),
                'note' => __('Separate by ;', 'Portfolio'),
                'value' => null
            )
        );
        $field->addValidator('Required');
        $form->addField($field);
        
        return ipView('snippet/edit.php', array('form' => $form))->render();
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
        $filters = $postData['filters'];
        $newFilters = array();
        
        foreach ($tiles as $key => $value) {
            $filterStr = explode(";", $tiles[$key]['filter']);
            
            $filterStrLen = count($filterStr);
            
            if (!isset($tiles[$key]['filters'])) {
                $tiles[$key]['filters'] = array();
            }
            
            for ($i = 0; $i < $filterStrLen; $i++) {
                    
                error_log($filterStr[$i], 0);

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
        
        return $postData;
    }
    
    protected function in_array_r($needle, $haystack, $strict = false)
    {
        foreach ($haystack as $item) {
            
            error_log($item, 0);
            
            if ($strict ? $item === $needle : $item == $needle)
            {
                return true;
            } 
            elseif (is_array($item))
            {
                return $this->in_array_r($needle, $item, $strict);
            }
            
            //if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
            //    return true;
            //}
        }

        return false;
    }
}