<?php

namespace App;

use App\Calculation\CharCounter;
use App\Calculation\Charsets;
use App\Calculation\Results\Formats;
use App\Validation\InputValidationException;
use App\Validation\InputValidator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MainCommand extends Command
{
    private InputValidator $input_validator;

    public static function getInputDefinition(): InputDefinition
    {
        return new InputDefinition([
            // not setting as 'required' here for more control over validation
            new InputOption('input', 'i', InputOption::VALUE_OPTIONAL),
            new InputOption('format', 'f', InputOption::VALUE_OPTIONAL),
            new InputOption('include-letter', 'L'),
            new InputOption('include-punctuation', 'P'),
            new InputOption('include-symbol', 'S'),
        ]);
    }

    public function __construct(InputValidator $input_validator)
    {
        parent::__construct('main');

        $this->input_validator = $input_validator;
    }

    protected function configure()
    {
        $this->setDefinition(self::getInputDefinition());
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $START = microtime(true);

        try {
            $this->runMain($input, $output);
        } catch (InputValidationException $exception) {
            $output->writeln("Error: {$exception->getMessage()}");
            return $exception->getCode();
        }

        $time = round(microtime(true) - $START, 5);

        $output->writeln("Execution length in seconds: $time");
        $output->writeln("Memory consumption: " . round(memory_get_peak_usage() / 1024 / 1024, 3) . 'MB');

        return Command::SUCCESS;
    }

    private function runMain(InputInterface $input, OutputInterface $output)
    {
        $this->input_validator->validate($input);

        $file = $input->getOption('input');
        $output->writeln("File: $file");

        $charsets = new Charsets();
        $counter = new CharCounter();

        if ($input->getOption('include-letter') !== false) {
            $counter->addCharset($charsets->makeLetters());
        }

        if ($input->getOption('include-punctuation') !== false) {
            $counter->addCharset($charsets->makePunctuation());
        }

        if ($input->getOption('include-symbol') !== false) {
            $counter->addCharset($charsets->makeSymbols());
        }

        $handle = fopen($file, 'r');

        while ($chunk = fread($handle, 10)) {
            $length = strlen($chunk);
            for ($i = 0; $i < $length; $i++) {
                $char = $chunk[$i];
                $counter->addChar($char);
            }
        }

        $format = (new Formats())->makeFormat($input->getOption('format'));

        foreach ($counter->getCharsets() as $charset) {
            $output->writeln($format->getResult($charset));
        }
    }
}
