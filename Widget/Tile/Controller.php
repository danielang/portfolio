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
        $data['widgetId'] = $widgetId;
        
        if (!isset($data['tile']))
        {
            $data['tile'] = array();
        }
        
        return parent::generateHtml($revisionId, $widgetId, $data, $skin);
    }
    
    public function dataForJs($revisionId, $widgetId, $data, $skin)
    {
        $data['widgetId'] = $widgetId;
        
        return $data;
    }
    
    public function post($widgetId, $data)
    {
        $tile = empty($data['tile']) ? array() : $data['tile'];
        
        $form = new \Ip\Form();
        
        $form->setEnvironment(\Ip\Form::ENVIRONMENT_ADMIN);


        $form->addField(new \Ip\Form\Field\Text(
                array(
                    'name' => 'title',
                    'label' => __('Title', 'Portfolio'),
                    'value' => empty($tile['title']) ? null : $tile['title']
                )
            )
        );

        $form->addField(new \Ip\Form\Field\RichText(
                array(
                    'name' => 'description',
                    'label' => __('Description', 'Portfolio'),
                    'value' => empty($tile['description']) ? null : $tile['description']
                )
            )
        );

        $form->addField(new \Ip\Form\Field\RepositoryFile(
                array(
                    'name' => 'imagelink',
                    'label' => __( 'Images', 'Portfolio'),
                    'fileLimit' => 1,
                    'value' => empty($tile['imagelink']) ? null : array($tile['imagelink'])
                )
            )
        );

        $form->addField(new \Ip\Form\Field\Url(
                array(
                    'name' => 'pagelink',
                    'label' => __('Page Url', 'Portfolio'),
                    'value' => empty($tile['pagelink']) ? null : $tile['pagelink']
                )
            )
        );
        
        $popup = ipView('snippet/edit.php', array('form' => $form))->render();
        
        return new \Ip\Response\Json(array(
            'popup' => $popup
        )); 
    }
    
    public function adminHtmlSnippet()
    {
        $form = new \Ip\Form();
        
        $form->setEnvironment(\Ip\Form::ENVIRONMENT_ADMIN);


        $form->addField(new \Ip\Form\Field\Text(
                array(
                    'name' => 'title',
                    'label' => __('Title', 'Portfolio'),
                    'value' => null
                )
            )
        );

        $form->addField(new \Ip\Form\Field\RichText(
                array(
                    'name' => 'description',
                    'label' => __('Description', 'Portfolio'),
                    'value' => null
                )
            )
        );

        $form->addField(new \Ip\Form\Field\RepositoryFile(
                array(
                    'name' => 'imagelink',
                    'label' => __( 'Images', 'Portfolio'),
                    'fileLimit' => 1,
                    'value' => empty($item['imagelink']) ? null : array($item['imagelink'])
                )
            )
        );

        $form->addField(new \Ip\Form\Field\Url(
                array(
                    'name' => 'pagelink',
                    'label' => __('Page Url', 'Portfolio'),
                    'value' => null
                )
            )
        );
        
        return ipView('snippet/edit.php', array('form' => $form))->render();
    }
}