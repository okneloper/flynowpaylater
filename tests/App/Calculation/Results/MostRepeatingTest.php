<?php

namespace App\Calculation\Results;

use App\Calculation\Charsets;
use PHPUnit\Framework\TestCase;

class MostRepeatingTest extends TestCase
{
    public function testNullResult()
    {
        $charset = (new Charsets())->makeLetters();

        $format = new MostRepeating();
        $output = $format->getResult($charset);

        $this->assertEquals('First most-repeating letter: None', $output);
    }
}
