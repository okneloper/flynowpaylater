<?php

namespace App\Validation;

use PHPUnit\Framework\TestCase;

class InputFormatValidatorTest extends TestCase
{
    public function testValidationSucceeds(): void
    {
        $validator = new InputFormatValidator();

        $this->assertTrue($validator->isValid('non-repeating'));
        $this->assertTrue($validator->isValid('least-repeating'));
        $this->assertTrue($validator->isValid('most-repeating'));

        $this->assertFalse($validator->isValid(''));
        $this->assertFalse($validator->isValid('0'));
        $this->assertFalse($validator->isValid('best-repeating'));
    }
}
