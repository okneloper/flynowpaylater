<?php

namespace App\Calculation\Results;

use App\Calculation\Charset;

class MostRepeating implements Format
{
    public function getResult(Charset $charset): string
    {
        $message = "First most-repeating %s: %s";

        $result = $this->getResultChar($charset) ?? 'None';

        return sprintf($message, $charset->getName(), $result);
    }

    private function getResultChar(Charset $charset): ?string
    {
        $max = 1;
        $result = null;
        foreach ($charset->listChars() as $char => $count) {
            // count is more than one and less than the minimum found so far
            if ($count > $max) {
                $max = $count;
                $result = $char;
            }
        }
        return $result;
    }
}
