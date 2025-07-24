<?php

namespace App\Console\Commands;

use App\Features\GeneratePasswordFeature;
use Illuminate\Console\Command;

class GeneratePhrasePassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ppassword:generate {value?} {salt?} {num?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a password out of slovenian phrases';

    /**
     * Execute the console command.
     */
    public function handle()
    {   
        $func = new GeneratePasswordFeature;
        dd($func->handle(
            $this->argument('value') ?? $this->ask('Enter a value (allowed values are saved in $value. For test you can use a "test")'),
            $this->argument('salt') ?? $this->ask('Enter a salt (optional)'),
            intval($this->argument('num') ?? $this->ask('Enter a number (optional)', 10))
        ));
    }
}
