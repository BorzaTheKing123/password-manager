<?php

namespace App\Domains;

use App\Data\Models\Domain;

class CheckDomainJob
{
    public function checkDomain($value): bool
    {   
        if(Domain::where('domain', 'is', $value)->get()->toArray() == [])
        {
            return false;
        }
        return true;
    }
}
