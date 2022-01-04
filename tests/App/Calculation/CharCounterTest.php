<?php

namespace App\Calculation;

use PHPUnit\Framework\TestCase;

class CharCounterTest extends TestCase
{
    public function testFailsIfMultipleCharactersAreAdded()
    {
        $counter = new CharCounter();

        $this->expectException(\BadMethodCallException::class);

        $counter->addChar('ab');
    }
}
