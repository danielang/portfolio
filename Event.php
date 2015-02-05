<?php
/**
 * @package   ImpressPages
 */

namespace Plugin\Portfolio;

class Event
{
    public static function ipBeforeController()
    {
        // Add Stylesheet
        ipAddCss('assets/css/bootstrap.min.css');
        ipAddCss('assets/css/portfolio-font.css');
        ipAddCss('assets/css/portfolio.css');
        
        // Add JavaScript
        ipAddJs('assets/js/jquery.isotope.min.js');
    }

}
