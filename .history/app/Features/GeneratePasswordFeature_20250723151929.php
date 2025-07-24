<?php

namespace App\Features;

use App\Domains\GeneratePhrasePasswordJob;
use App\Domains\CheckDomainJob;
use App\Domains\CheckOtherJob;

class GeneratePasswordFeature
{
    public function __construct(private $value, private $salt, private $num)
    {
        //
    }

    public function handle()
    {   
        $exists = (new CheckDomainJob($this->value))->checkDomain();

        // $coj = new CheckOtherJob;
        // if ($coj->checkOther($salt, $num) == false) {
        //     return 'Invalid domain';
        // }

        return (new GeneratePhrasePasswordJob($this->value, $this->salt, $this->num))->handle();
    }
}