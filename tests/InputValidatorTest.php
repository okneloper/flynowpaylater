<?php

namespace Tests;

use App\MainCommand;
use App\Validation\InputValidationException;
use App\Validation\InputValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArgvInput;

class InputValidatorTest extends TestCase
{
    /**
     * @dataProvider validInputProvider
     * @doesNotPerformAssertions
     */
    public function testValidationSucceeds(string $input)
    {
        $input = new ArgvInput(explode(' ', $input), MainCommand::getInputDefinition());

        $validator = new InputValidator();

        $validator->validate($input);
    }

    /**
     * @dataProvider invalidInputProvider
     */
    public function testValidationFails(string $input, $expected_code)
    {
        $input = new ArgvInput(explode(' ', $input), MainCommand::getInputDefinition());

        $validator = new InputValidator();

        $this->expectException(InputValidationException::class);
        $this->expectExceptionCode($expected_code);

        $validator->validate($input);
    }

    public function invalidInputProvider(): array
    {
        return [
            ['script.php', 1],
            // no input file
            ['script.php -i', 1],
            ['script.php --input', 1],
            // file does not exist
            ['script.php -f non-repeating --input some_file.txt', 1],
            // invalid data
            ['script.php -f non-repeating -i tests/data/invalid_input.txt', 2],
            // missing the -f flag
            ['script.php -i tests/data/valid_input.txt', 3],
            // missing one of -L, -P, -S
            ['script.php -i tests/data/valid_input.txt -f non-repeating', 4],
        ];
    }

    public function validInputProvider(): array
    {
        return [
            // 0
            ['script.php -i tests/data/valid_input.txt -f non-repeating -L'],
            ['script.php -i tests/data/valid_input.txt -f non-repeating --include-punctuation'],

            // 2
            ['script.php -i tests/data/valid_input.txt -f least-repeating -P'],
            ['script.php -i tests/data/valid_input.txt -f least-repeating --include-punctuation'],

            // 4
            ['script.php -i tests/data/valid_input.txt -f most-repeating -S'],
            ['script.php -i tests/data/valid_input.txt -f most-repeating --include-symbol'],

            // 6
            ['script.php -i tests/data/valid_input.txt -f non-repeating -L'],
            ['script.php --input tests/data/valid_input.txt --format non-repeating -L'],
            ['script.php -i tests/data/valid_input.txt -f non-repeating -L'],
            ['script.php -i tests/data/valid_input.txt -f least-repeating -S -L'],
            ['script.php -i tests/data/valid_input.txt -f most-repeating -P -L -S'],
        ];
    }
}
