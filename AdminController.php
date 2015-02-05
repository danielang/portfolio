<?php

namespace Plugin\Portfolio;

class AdminController
{
    public function generateWidgetHtml()
    {       
        ipRequest()->mustBePost();
        //$params = ipRequest()->getPost('parameters');
        $widgetId = ipRequest()->getPost('widgetId');
        
        $widgetsHtml = \Ip\Internal\Content\Model::generateWidgetPreview($widgetId, true);
        
        return new \Ip\Response\Json(array(
            'widgetId' => $widgetId,
            'html' => $widgetsHtml
        ));

    }
}