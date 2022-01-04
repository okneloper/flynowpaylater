<?php

namespace App\Calculation;

use PHPUnit\Framework\TestCase;

class CharsetsTest extends TestCase
{
    public function testMakesLetters(): void
    {
        $factory = new Charsets();

        $charset = $factory->makeLetters();

        $this->assertInstanceOf(BasicCharset::class, $charset);
    }

    public function testMakesPunctuation(): void
    {
        $factory = new Charsets();

        $charset = $factory->makePunctuation();

        $this->assertInstanceOf(BasicCharset::class, $charset);
    }

    public function testMakesSymbols(): void
    {
        $factory = new Charsets();

        $charset = $factory->makeSymbols();

        $this->assertInstanceOf(BasicCharset::class, $charset);
    }

    public function testKnownCharsets()
    {
        $factory = new Charsets();

        $charsets = $factory->getKnown();

        $this->assertCount(3, $charsets);
        $this->assertInstanceOf(BasicCharset::class, $charsets[0]);
        $this->assertInstanceOf(BasicCharset::class, $charsets[1]);
        $this->assertInstanceOf(BasicCharset::class, $charsets[2]);

    }
}
