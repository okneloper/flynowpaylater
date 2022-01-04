<?php

namespace App\Calculation\Results;

use App\Calculation\Charset;

interface Format
{
    public function getResult(Charset $charset): string;
}
