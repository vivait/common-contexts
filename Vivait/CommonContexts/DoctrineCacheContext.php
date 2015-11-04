<?php
namespace Vivait\CommonContexts;

use Behat\Symfony2Extension\Context\KernelDictionary;
use Knp\FriendlyContexts\Context\Context;

class DoctrineCacheContext extends Context
{
    use KernelDictionary;
    /**
     * @BeforeBackground
     **/
    public function startService($event)
    {
        $cache = $this->getContainer()->get('doctrine_filesystem_cache');
        $this->storeTags($event);
        $keys = $this->getTagContent('doctrine-cache-clear');
        foreach ($keys as $key) {
            if ($cache->contains($key)) {
                $cache->delete($key);
            }
        }
    }
}
