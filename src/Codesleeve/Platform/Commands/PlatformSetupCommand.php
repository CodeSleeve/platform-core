<?php namespace Codesleeve\Platform\Commands;

use Artisan;
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
        $this->yes = $this->option('yes');

        $this->copySetupFolder();
        $this->setupSentry();
    }

    private function setupSentry()
    {
        Artisan::call('migrate', array('--package' => 'Cartalyst/Sentry'));
        Artisan::call('migrate', array('cartalyst/sentry');
    }

    /**
     * This command will copy the setup folder for us
     *
     * @return void
     */
    private function copySetupFolder()
    {
        $projectRoot = realpath(base_path());
        $platformRoot = realpath(__DIR__ . '/../../../setup');

        $this->line("We are going to copy some common files and setup to your project root.");

        $continue = $this->yes ? 'y' : $this->ask("Would you like to continue? [Y/n]");

        if (strtolower(trim($continue)) != 'n')
        {
            $this->xcopy($platformRoot, $projectRoot);
        }
    }

    /**
     * Copy over files from $source to $dest recursively
     *
     * @param  string $source
     * @param  string $dest
     * @return void
     */
    private function xcopy($source, $dest)
    {
        foreach ($iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS), \RecursiveIteratorIterator::SELF_FIRST) as $item)
        {
            $target = $dest . '/' . $iterator->getSubPathName();

            if ($item->isDir())
            {
                if (!is_dir($target))
                {
                    mkdir($target);
                }
            }
            else if ($this->shouldWriteFileAt($target))
            {
                copy($item, $target);
                $this->line('   -> ' . $iterator->getSubPathName());
            }
        }
    }

    /**
     * Ask the user if they want to shouldWriteFileAt existing files
     *
     * @param  string $path
     * @return boolean
     */
    private function shouldWriteFileAt($path)
    {
        if ($this->yes)
        {
            return true;
        }

        if (!file_exists($path))
        {
            return true;
        }

        $path = str_replace(base_path(), '', $path);

        $override = $this->ask("$path already exists, override? [y/N]");

        return (strtolower(trim($override)) == 'y') ? true : false;
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
            array('yes', 'y', InputOption::VALUE_NONE, 'If set we answer yes to all questions.'),
        );
    }

}