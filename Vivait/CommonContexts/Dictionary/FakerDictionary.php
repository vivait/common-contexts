<?php
namespace Vivait\CommonContexts\Dictionary;

trait FakerDictionary {
    public function faker(){
        $faker = $this->getContainer()->get('faker.factory');
        $faker = $faker::create();
        return $faker;
    }
} 
