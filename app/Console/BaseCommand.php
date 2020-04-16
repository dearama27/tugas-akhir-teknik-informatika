<?php

namespace App\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

/**
 * Class BaseCommand
 * Base Command Class extended for crud:* command line
 */
class BaseCommand extends Command
{

    function banner() {
        $style = new OutputFormatterStyle('green', 'default', ['bold']);
        $this->output->getFormatter()->setStyle('bold', $style);

        $version = app()->version();
        $this->line("
     _____                ____ ____  _   _ ____  
    |_   _| __ _   _ ___ / ___|  _ \| | | |  _ \   | CLI - Crud Builder <bold>V1.0</bold>
      | || '__| | | / __| |   | |_) | | | | | | |  | Laravel $version
      | || |  | |_| \__ \ |___|  _ <| |_| | |_| |  |
      |_||_|   \__,_|___/\____|_| \_\\\___/|____/   | www.dani.work\n");
    }
}