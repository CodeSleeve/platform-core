<?php namespace Codesleeve\Platform\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class PlatformSetupCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'platform:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the core Codesleeve platform';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $projectRoot = realpath(base_path());
        $platformRoot = realpath(__DIR__ . '/../../../setup');

        dd($projectRoot, $platformRoot);
    }

    /**
     * Copy over files
     *
     * @param  [type] $source [description]
     * @param  [type] $dest   [description]
     * @return [type]         [description]
     */
    private function xcopy($source, $dest)
    {
        $base = base_path();

        foreach ($iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS), \RecursiveIteratorIterator::SELF_FIRST) as $item)
        {
            if ($item->isDir())
            {
                if (!is_dir($dest . '/' . $iterator->getSubPathName()))
                {
                    mkdir($dest . '/' . $iterator->getSubPathName());
                }
            }
            else
            {
                copy($item, $dest . '/' . $iterator->getSubPathName());
                $this->line('   Copying -> ' . str_replace($base, '', $dest . '/' . $iterator->getSubPathName()));
            }
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            // array('example', InputArgument::REQUIRED, 'An example argument.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            // array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

}

        $structure = __DIR__ . '/../../../../structure';
        $base = base_path();

        $this->line('');
        $this->line('Creating initial directory structure and copying some general purpose assets over.');
        $this->line('');

        $this->xcopy(realpath($structure), realpath($base));

        $this->line('');
        $this->line('Finished. Have a nice day!');
        $this->line('         - Codesleeve Team');
    }

}