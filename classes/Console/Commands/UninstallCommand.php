<?php

namespace App\WordPress\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Input\InputOption;

class UninstallCommand extends Command
{
    use EnvironmentTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'wordpress:uninstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall wordpress tables.';

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
     * @return mixed
     */
    public function handle()
    {
        // entrance
        $this->logo();

        // prepare
        $this->bootstrapForSinglesiteSetup();

        // title
        $this->info('-- Wordpress Uninstall --');

        // confirm
        if ($this->option('force') === false && $this->confirm('Are you sure?') === false) {
            return;
        }

        $this->process();
    }

    protected function process()
    {
        global $wpdb;

        // We need to create references to ms global tables to enable Network.
        foreach ($this->singlesiteTables() as $table => $prefixed_table) {
            $this->line('Dropping table: '.$prefixed_table);
            Schema::dropIfExists($prefixed_table);
        }

        $this->line('Done.');
    }

    /**
     * @return array
     */
    protected function getArguments()
    {
        return [
        ];
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Don\'t confirm for run.'],
        ];
    }
}
