<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeIrodaUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:iroda {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make an existing user an Iroda user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email '{$email}' not found.");
            return 1;
        }
        
        if ($user->is_iroda) {
            $this->info("User '{$email}' is already an Iroda user.");
            return 0;
        }
        
        $user->is_iroda = true;
        $user->save();
        
        $this->info("User '{$email}' has been made an Iroda user successfully!");
        return 0;
    }
}
