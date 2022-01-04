<?php

namespace App\Validation;

use PHPUnit\Framework\TestCase;

class InputDataValidatorTest extends TestCase
{
    /**
     * @dataProvider validInputProvider
     */
    public function testValidationSucceeds(string $input): void
    {
        $validator = new InputDataValidator();

        $this->assertTrue($validator->isValid($input));
    }

    /**
     * @dataProvider invalidInputProvider
     */
    public function testValidationFails(string $input): void
    {
        $validator = new InputDataValidator();

        $this->assertFalse($validator->isValid($input));
    }

    public function validInputProvider(): array
    {
        return [
            ['abcuiy'],
            ['abcuiy.?!,:;-()\'#'],
            ['abcuiy.?!,:;-()\'##'],
        ];
    }

    public function invalidInputProvider(): array
    {
        return [
            [''],
            ['abc uiy'],
            ["abcuiy\n"],
            ['abcA'],
            ['abcč'],
        ];
    }
}
