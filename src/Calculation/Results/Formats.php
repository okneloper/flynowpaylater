<?php

namespace App\Calculation\Results;

class Formats
{
    public function makeFormat(string $type): Format
    {
        switch ($type) {
            case 'non-repeating':
                return new NonRepeating();
                break;

            case 'least-repeating':
                return new LeastRepeating();
                break;

            case 'most-repeating':
                return new MostRepeating();
                break;
        }

        throw new \BadMethodCallException("Unsupported format: [$type]");
    }
}
