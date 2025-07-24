<?php

namespace App\Domains;

class GeneratePhrasePasswordJob
{
    public function __construct(private $value, private $salt, private $num)
    {
        //
    }

    public function handle(): string
    {
        $iterations = '600000';
        $filePath = base_path('resources/data/slovenske_besede_fran.json');

        $f = fopen($filePath, "r");
        $json_array  = json_decode(fread($f, filesize($filePath)), true);
        $elementCount  = count($json_array["besede"]);

        // Število zaporednih šestnajstiških števil
        $factor = intval(ceil(log($elementCount, 2) / 4));

        if (! $this->salt) {
            $this->salt = random_bytes(16);
        }

        if (! $this->num) {
            $this->num = 10; 
        }

        $length = $factor*$this->num;
        $hash = hash_pbkdf2("sha256", $this->value, $this->salt, $iterations, $length);
        $final = [];

        for ($i = 0; $i < $length; $i += $factor) {
            $temp = "";
            for ($x = 0; $x < $factor; $x++) {
                $temp = $temp . $hash[$i + $x];
            }

            $jump = hexdec($temp);
            while ($jump >= $elementCount) {
                $jump -= $elementCount;
            }
            $final[] = $json_array["besede"][$jump];
        }
        
        $signs = "/!$%&?*+-_.:,;@#()[]{}1234567890<>|";
        $s_len = 35;

        $password = "";
        $hash = hash_pbkdf2("sha256", $this->value, $this->salt, 100000, intval(2*$length/$factor));
        for ($x = 0; $x < 2 * (intval($length/$factor) - 1); $x += 2) {
            
            $this->value = "";
            for ($y = 0; $y < 2; $y++) {
                $this->value = $this->value . $hash[$x + $y];
            }

            $jump = hexdec($this->value);
            while ($jump >= $s_len) {
                $jump -= $s_len;
            }

            $password = $password . $final[intval($x/2)] . $signs[$jump];
        }

        dd($password);

        $password = $password . $final[intval($x/2)];

        return $password;
    }
}
