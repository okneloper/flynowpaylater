<?php

namespace App\Calculation\Results;

use App\Calculation\Charset;

class LeastRepeating implements Format
{
    public function getResult(Charset $charset): string
    {
        $message = "First least-repeating %s: %s";

        $result = $this->getResultChar($charset) ?? 'None';

        return sprintf($message, $charset->getName(), $result);
    }

    private function getResultChar(Charset $charset): ?string
    {
        $min = PHP_INT_MAX;
        $result = null;
        foreach ($charset->listChars() as $char => $count) {
            // count is more than one and less than the minimum found so far
            if ($count > 1 && $count < $min) {
                $min = $count;
                $result = $char;
            }
        }
        return $result;
    }
}
