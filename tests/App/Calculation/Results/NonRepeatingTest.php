<?php

namespace App\Calculation\Results;

use App\Calculation\Charsets;
use PHPUnit\Framework\TestCase;

class NonRepeatingTest extends TestCase
{
    public function testNullResult()
    {
        $charset = (new Charsets())->makeLetters();

        $format = new NonRepeating();
        $output = $format->getResult($charset);

        $this->assertEquals('First non-repeating letter: None', $output);
    }
}
