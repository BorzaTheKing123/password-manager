<?php

namespace App\Domains;

use App\Data\Models\Domain;

class CheckDomainJob
{
    public function __construct(private $value) {
        //
    }

    public function handle(): bool
    {   
        if(Domain::where('domain', 'is', $this->value)->get()->toArray() == [])
        {
            return false;
        }
        return true;
    }
}
