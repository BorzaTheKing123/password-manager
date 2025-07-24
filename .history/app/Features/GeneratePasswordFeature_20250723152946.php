<?php

namespace App\Features;

use App\Domains\GeneratePhrasePasswordJob;
use App\Domains\CheckDomainJob;
use App\Domains\CheckOtherJob;
use App\Domains\CreateNewJob;

class GeneratePasswordFeature
{
    public function __construct(private $value, private $salt, private $num)
    {
        //
    }

    public function handle()
    {   
        if ((new CheckDomainJob($this->value))->checkDomain() !== false)
        {   
            return (new GeneratePhrasePasswordJob($this->value, $this->salt, $this->num))->handle();
        }

        if((new CreateNewJob($this->value, $this->salt))->createNew() == false)
        {
            return 'Invalid input!'
        }

        
    }
}