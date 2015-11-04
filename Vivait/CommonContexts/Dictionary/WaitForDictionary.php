<?php

namespace Vivait\CommonContexts\Dictionary;

trait WaitForDictionary
{
    /**
     * @param $check
     * @param int $wait
     * @param string $timeoutMessage
     * @return mixed
     * @throws \Exception
     */
    protected function waitFor($check, $wait = 60, $timeoutMessage = 'Reached max timeout!')
    {
        for ($i = 0; $i < $wait; $i++) {
            if ($return = $check()) {
                return $return;
            }
            sleep(1);
        }
        throw new \Exception($timeoutMessage);
    }
}
