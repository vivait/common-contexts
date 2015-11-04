<?php
namespace Vivait\CommonContexts\Dictionary;

use JMS\JobQueueBundle\Entity\Job;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Process\ProcessBuilder;

trait JMSJobDictionary
{
    /**
     * @return Container
     */
    abstract function getContainer();
    /**
     * @return ProcessBuilder
     */
    private function getCommandProcessBuilder()
    {
        $pb = new ProcessBuilder();
        // PHP wraps the process in "sh -c" by default, but we need to control
        // the process directly.
        if (!defined('PHP_WINDOWS_VERSION_MAJOR')) {
            $pb->add('exec');
        }
        $pb
            ->add('php')
            ->add($this->getContainer()->getParameter('kernel.root_dir') . '/console')
            ->add('--env=test');
        return $pb;
    }
    
    /**
     * @param Job $job
     * @return \Symfony\Component\Process\Process
     */
    public function runJob(Job $job)
    {
        $pb = $this->getCommandProcessBuilder();
        $pb
            ->add($job->getCommand())
            ->add('--jms-job-id=' . $job->getId());
        foreach ($job->getArgs() as $arg) {
            $pb->add($arg);
        }
        $proc = $pb->getProcess();
        $proc->start();
        return $proc;
    }
}
