<?php

namespace App\Validation;

use Symfony\Component\Console\Input\InputInterface;

class InputValidator
{
    /**
     * @param InputInterface $input
     * @throws InputValidationException
     */
    public function validate(InputInterface $input)
    {
        $input_value = $input->getOption('input');

        // If there is no flag, or the file path provided does not exist, exit with error code 1.
        if (empty($input_value)) {
            throw new InputValidationException("--input option not passed", 1);
        }

        if (!file_exists($input_value)) {
            throw new InputValidationException("--input file not found", 1);
        }

        // Verify that the file contents contain lower case alphabet ASCII letters, punctuations and symbols only.
        // If the file does not contain any of the mentioned or has other forms of characters
        // (newlines or spaces, for example), exit with error code 2;
        $validator = new InputDataValidator();

        $handle = fopen($input_value, 'r');
        // read 1MB at a time in case the file is large
        while ($data = fread($handle, 1048576)) {
            if (!$validator->isValid($data)) {
                throw new InputValidationException('File content validation failed', 2);
            }
        }

        $validator = new InputFormatValidator();
        $format_value = $input->getOption('format');
        if (!$validator->isValid($format_value)) {
            throw new InputValidationException("Unsupported format [$format_value]", 3);
        }

        // At least one of the following flags must be provided:
        $additional_flags = [
            $input->getOption('include-letter'),
            $input->getOption('include-punctuation'),
            $input->getOption('include-symbol'),
        ];
        if (empty(array_filter($additional_flags))) {
            // none of the flags provided
            throw new InputValidationException("Missing required flag", 4);
        }
    }
}
