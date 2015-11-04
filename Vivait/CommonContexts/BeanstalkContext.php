<?php
namespace Vivait\CommonContexts;

use Knp\FriendlyContexts\Context\Context;
use Leezy\PheanstalkBundle\Command\FlushTubeCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

class BeanstalkContext extends Context
{
    /**
     * @BeforeBackground
     **/
    public function clearTube($event) {
        $this->storeTags($event);
        $tubes = $this->getTagContent('clear-tube');
        foreach ($tubes as $tube) {
            $command = new FlushTubeCommand();
            $command->setContainer($this->getKernel()->getContainer());
            $input = new ArrayInput(['tube' => $tube]);
            $output = new NullOutput();
            $command->run($input, $output);
        }
    }
}
