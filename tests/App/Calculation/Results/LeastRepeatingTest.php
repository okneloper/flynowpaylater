<?php

namespace App\Calculation\Results;

use App\Calculation\Charsets;
use PHPUnit\Framework\TestCase;

class LeastRepeatingTest extends TestCase
{
    public function testNullResult()
    {
        $charset = (new Charsets())->makeLetters();

        $format = new LeastRepeating();
        $output = $format->getResult($charset);

        $this->assertEquals('First least-repeating letter: None', $output);
    }
}
