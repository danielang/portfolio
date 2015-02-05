<?php
/**
 * @package   ImpressPages
 */

namespace Plugin\Portfolio\Setup;


class Worker
{
    public function activate()
    {
        $version = \Ip\Application::getVersion();
        $parts = explode('.', $version);
        if (empty($parts[1]) || $parts[0] < 4 || $parts[1] < 2 ) {
            throw new \Ip\Exception('ImpressPages 4.2.0 or later required');
        }
    }
    
    public function deactivate()
    {
        
    }

    public function remove()
    {

    }
}
