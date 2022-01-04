<?php

namespace App\Calculation;

class Charsets
{
    public function makeLetters(): Charset
    {
        return new BasicCharset('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 'letter');
    }

    public function makePunctuation(): Charset
    {
        return new BasicCharset('!,-.:;?()[]\'"_/&', 'punctuation');
    }

    public function makeSymbols(): Charset
    {
        return new BasicCharset('#$%*+<=>@\\^`{|}~', 'symbol');
    }

    /**
     * Returns all known charsets
     * @return array
     */
    public function getKnown(): array
    {
        return [
            $this->makeSymbols(),
            $this->makePunctuation(),
            $this->makeSymbols(),
        ];
    }
}
