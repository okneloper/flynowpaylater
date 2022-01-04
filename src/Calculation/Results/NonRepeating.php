<?php

namespace App\Calculation\Results;

use App\Calculation\Charset;

class NonRepeating implements Format
{
    public function getResult(Charset $charset): string
    {
        $message = "First non-repeating %s: %s";

        $result = $this->getResultChar($charset) ?? 'None';

        return sprintf($message, $charset->getName(), $result);
    }

    private function getResultChar(Charset $charset): ?string
    {
        foreach ($charset->listChars() as $char => $count) {
            if ($count === 1) {
                return $char;
            }
        }
        return null;
    }
}
