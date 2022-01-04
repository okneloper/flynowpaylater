<?php

namespace App\Calculation\Results;

use PHPUnit\Framework\TestCase;

class FormatsTest extends TestCase
{
    public function testInvalidFormatThrowsException()
    {
        $formats = new Formats();

        $this->expectException(\BadMethodCallException::class);
        $formats->makeFormat('missing');
    }
}
