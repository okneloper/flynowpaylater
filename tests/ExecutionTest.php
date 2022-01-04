<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Tester\ApplicationTester;

class ExecutionTest extends TestCase
{
    public function testNoInputFlagReturns1(): void
    {
        $application = \App\ApplicationFactory::makeApplication();
        $application->setAutoExit(false);

        $tester = new ApplicationTester($application);
        $code = $tester->run([]);

        $this->assertEquals(1, $code);
    }

    public function testInvalidInputReturns2(): void
    {
        $application = \App\ApplicationFactory::makeApplication();
        $application->setAutoExit(false);

        $tester = new ApplicationTester($application);
        $code = $tester->run([
            '--input' => 'tests/data/invalid_input.txt',
        ]);

        $this->assertEquals(2, $code);
    }

    public function testNoFormatReturns3(): void
    {
        $application = \App\ApplicationFactory::makeApplication();
        $application->setAutoExit(false);

        $tester = new ApplicationTester($application);
        $code = $tester->run([
            '--input' => 'tests/data/valid_input.txt',
        ]);

        $this->assertEquals(3, $code);
    }

    public function testInvalidFormatReturns3(): void
    {
        $application = \App\ApplicationFactory::makeApplication();
        $application->setAutoExit(false);

        $tester = new ApplicationTester($application);
        $code = $tester->run([
            '--input' => 'tests/data/valid_input.txt',
        ]);

        $this->assertEquals(3, $code);
    }

    public function testSuccessfulExecutionNonRepeating(): void
    {
        $application = \App\ApplicationFactory::makeApplication();
        $application->setAutoExit(false);

        $tester = new ApplicationTester($application);
        $tester->run([
            '--input' => 'tests/data/valid_input.txt',
            '--format' => 'non-repeating',
            '--include-letter' => null,
            '--include-punctuation' => null,
            '--include-symbol' => null,
        ]);

        $tester->assertCommandIsSuccessful();

        $output_stream = $tester->getOutput()->getStream();
        fseek($output_stream, 0);
        $output = fread($output_stream, 10240);

        $this->assertStringContainsString("File: tests/data/valid_input.txt", $output);
        $this->assertStringContainsString("First non-repeating letter: q", $output);
        $this->assertStringContainsString("First non-repeating punctuation: -", $output);
        $this->assertStringContainsString("First non-repeating symbol: `", $output);
    }

    public function testSuccessfulExecutionLeastRepeating(): void
    {
        $application = \App\ApplicationFactory::makeApplication();
        $application->setAutoExit(false);

        $tester = new ApplicationTester($application);
        $tester->run([
            '--input' => 'tests/data/valid_input.txt',
            '--format' => 'least-repeating',
            '--include-letter' => null,
            '--include-punctuation' => null,
            '--include-symbol' => null,
        ]);

        $tester->assertCommandIsSuccessful();

        $output = $tester->getDisplay();

        $this->assertStringContainsString("File: tests/data/valid_input.txt", $output);
        $this->assertStringContainsString("First least-repeating letter: m", $output);
        $this->assertStringContainsString("First least-repeating punctuation: ;", $output);
        $this->assertStringContainsString("First least-repeating symbol: #", $output);
    }

    public function testSuccessfulExecutionMostRepeating(): void
    {
        $application = \App\ApplicationFactory::makeApplication();
        $application->setAutoExit(false);

        $tester = new ApplicationTester($application);
        $tester->run([
            '--input' => 'tests/data/valid_input.txt',
            '--format' => 'most-repeating',
            '--include-letter' => null,
            '--include-punctuation' => null,
            '--include-symbol' => null,
        ]);

        $tester->assertCommandIsSuccessful();

        $output = $tester->getDisplay();

        $this->assertStringContainsString("File: tests/data/valid_input.txt", $output);
        $this->assertStringContainsString("First most-repeating letter: x", $output);
        $this->assertStringContainsString("First most-repeating punctuation: &", $output);
        $this->assertStringContainsString("First most-repeating symbol: |", $output);
    }

    public function testNoneOutput(): void
    {
        $application = \App\ApplicationFactory::makeApplication();
        $application->setAutoExit(false);

        $tester = new ApplicationTester($application);
        $tester->run([
            '--input' => 'tests/data/none_input1.txt',
            '--format' => 'most-repeating',
            '--include-letter' => null,
            '--include-punctuation' => null,
            '--include-symbol' => null,

        ]);

        $tester->assertCommandIsSuccessful();

        $output = $tester->getDisplay();

        $this->assertStringContainsString("File: tests/data/none_input1.txt", $output);
        $this->assertStringContainsString("First most-repeating letter: None", $output);
        $this->assertStringContainsString("First most-repeating punctuation: None", $output);
        $this->assertStringContainsString("First most-repeating symbol: None", $output);
    }
}
