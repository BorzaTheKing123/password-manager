<?php

namespace App\Domains;

use App\Data\Models\Domain;

class CreateNewJob
{   
    public function __construct(private $value, private $salt)
    {
        //
    }

    public function handle()
    {   
        if(! $this->value or ! $this->salt)
        {
            return false;
        }

        Domain::create(['domain' => $this->value, 'salt' => $this->salt]);
        return true;
    }
}