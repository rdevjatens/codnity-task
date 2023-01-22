<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;

class createUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {username} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $login = new Login;
        $login->username =  $this->argument('username');
        $login->password = Hash::make($this->argument('password'));
        $login->save();
        return Command::SUCCESS;
    }
}
