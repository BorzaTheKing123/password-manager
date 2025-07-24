<?php

namespace App\Features;

use App\Domains\GeneratePhrasePasswordJob;
use App\Domains\CheckDomainJob;
use App\Domains\CreateNewJob;
use App\Domains\StoreNewValueJob;

class GeneratePasswordFeature
{
    public function __construct(private $value, private $salt, private $num)
    {
        //
    }

    public function handle()
    {   
        if ((new CheckDomainJob($this->value))->handle() !== false)
        {   
            return (new GeneratePhrasePasswordJob($this->value, $this->salt, $this->num))->handle();
        }

        if((new StoreNewValueJob($this->value, $this->salt))->handle() == false)
        {
            return 'Invalid input!';
        }

        return 'New domain ' . $this->value . ' was created';
        
    }
}