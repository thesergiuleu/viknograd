<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class ImportUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import a user';

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
        $name       = $this->ask('Name');
        $mail       = $this->ask('Email');
        if (User::whereEmail($mail)->exists()) {
            $this->info('This email already exists');
            exit();
        }
        $password   = $this->ask('Password');

        User::create([
            'name'      => $name,
            'email'     => $mail,
            'password'  => bcrypt($password),
        ]);
    }
}
