<?php
namespace Vivait\CommonContexts\Dictionary;

use FOS\ElasticaBundle\Command\PopulateCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

trait ElasticaDictionary
{
    public function resetSearch()
    {
        $command = new PopulateCommand();
        $command->setContainer($this->getContainer());
        $input = new ArrayInput(['--batch-size' => '100']);
        $output = new NullOutput();
        return $command->run($input, $output);
    }
    
    protected function refreshIndex($index = 'app')
    {
        $this->getContainer()->get('fos_elastica.index_manager')->getIndex($index)->refresh();
    }
