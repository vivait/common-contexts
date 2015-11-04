<?php
namespace Vivait\CommonContexts;

use Knp\FriendlyContexts\Context\Context;

class UpstartContext extends Context
{
    /**
     * @BeforeBackground
     **/
    public function startService($event)
    {
        $this->storeTags($event);
        $services = $this->getTagContent('start-service');
        foreach ($services as $service) {
            shell_exec(sprintf('sudo service %s start', $service));
        }
    }
    
    /**
     * @AfterScenario
     **/
    public function stopService($event)
    {
        $this->storeTags($event);
        $services = $this->getTagContent('start-service');
        foreach ($services as $service) {
            shell_exec(sprintf('sudo service %s stop', $service));
        }
    }
}
