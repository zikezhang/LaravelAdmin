<?php namespace Verecom\Admin\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallCommand extends Command {

    /**
    * The console command name.
    *
    * @var string
    */
    protected $name = 'admin:install';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'publish assets,configs and run migration';

    /**
     * Exceute the console command
     *
     * @author Steve Montambeault
     * @link   http://verecom.com
     *
     * @return void
     */
    public function fire()
    {
        $this->call('migrate', array('--env' => $this->option('env'), '--package' => 'cartalyst/sentry' ) );
        $this->call('migrate', array('--env' => $this->option('env'), '--package' => 'verecom/admin' ) );
        $this->call('config:publish', array('package' => 'cartalyst/sentry' ) );
        $this->call('config:publish', array('package' => 'anahkiasen/former' ) );
        $this->call('config:publish', array('package' => 'verecom/admin' ) );
        $this->call('asset:publish', array('package' => 'verecom/admin' ) );

        if ($this->confirm('Do you wish to create a user? [yes|no]'))
        {
            $this->call('admin:user');
        }
    }


    public function getOptions()
    {
        return array(
            array('env', null, InputOption::VALUE_OPTIONAL, 'The environment the command should run under.', null),
        );
    }
}
