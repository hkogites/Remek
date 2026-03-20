<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ListUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all users with their roles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all(['email', 'is_admin', 'is_iroda']);
        
        $this->info('Current users:');
        $this->info(str_repeat('-', 80));
        
        foreach ($users as $user) {
            $admin = $user->is_admin ? 'Yes' : 'No';
            $iroda = $user->is_iroda ? 'Yes' : 'No';
            
            $this->line("{$user->email} | Admin: {$admin} | Iroda: {$iroda}");
        }
        
        $this->info(str_repeat('-', 80));
        $this->info('Total users: ' . $users->count());
        
        return 0;
    }
}
