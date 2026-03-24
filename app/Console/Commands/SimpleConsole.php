<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SimpleConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simple:console';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Interactive console application for basic operations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🎉 SmartVoyager Console Application');
        $this->info('=====================================');
        $this->info('Welcome to the interactive console!');
        $this->line('');

        while (true) {
            $command = $this->ask('Enter command (or type "help" for options):');

            switch (strtolower($command)) {
                case 'help':
                    $this->showHelp();
                    break;
                case 'exit':
                case 'quit':
                    $this->info('Goodbye! 👋');
                    return;
                case 'clear':
                    $this->clearScreen();
                    break;
                case 'status':
                    $this->showStatus();
                    break;
                case 'files':
                    $this->listFiles();
                    break;
                case 'logs':
                    $this->showLogs();
                    break;
                case 'config':
                    $this->showConfig();
                    break;
                default:
                    $this->error("Unknown command: {$command}");
                    $this->showHelp();
                    break;
            }
        }
    }

    private function showHelp()
    {
        $this->info('Available Commands:');
        $this->line('  help     - Show this help message');
        $this->line('  clear    - Clear the screen');
        $this->line('  status   - Show system status');
        $this->line('  files    - List important files');
        $this->line('  logs     - Show recent logs');
        $this->line('  config   - Show configuration');
        $this->line('  exit     - Exit the console');
        $this->line('');
    }

    private function clearScreen()
    {
        // Clear screen (Windows compatible)
        $this->line(str_repeat(PHP_EOL, 50));
    }

    private function showStatus()
    {
        $this->info('📊 System Status:');
        $this->line('  Laravel Version: ' . app()->version());
        $this->line('  Environment: ' . config('app.env'));
        $this->line('  Debug Mode: ' . (config('app.debug') ? 'ON' : 'OFF'));
        $this->line('  Database: ' . (config('database.default') ?? 'Not configured'));
        $this->line('  Storage: ' . (Storage::exists('app/public') ? 'Available' : 'Not available'));
        $this->line('');
    }

    private function listFiles()
    {
        $this->info('📁 Important Files:');
        
        $files = [
            '.env' => 'Environment configuration',
            'composer.json' => 'PHP dependencies',
            'package.json' => 'Node.js dependencies',
            'README.md' => 'Project documentation',
            'routes/web.php' => 'Web routes',
            'routes/api.php' => 'API routes',
        ];

        foreach ($files as $file => $description) {
            $exists = File::exists(base_path($file));
            $status = $exists ? '✅' : '❌';
            $this->line("  {$status} {$file} - {$description}");
        }
    }

    private function showLogs()
    {
        $this->info('📋 Recent Logs:');
        
        $logFiles = [
            'storage/logs/laravel.log' => 'Laravel application log',
        ];

        foreach ($logFiles as $file => $description) {
            if (File::exists($file)) {
                $size = number_format(File::size($file) / 1024, 2);
                $this->line("  📄 {$file} ({$size} KB) - {$description}");
            } else {
                $this->line("  ❌ {$file} - Not found");
            }
        }
    }

    private function showConfig()
    {
        $this->info('⚙️ Configuration:');
        $this->line('  App Name: ' . config('app.name'));
        $this->line('  App URL: ' . config('app.url'));
        $this->line('  Timezone: ' . config('app.timezone'));
        $this->line('  Locale: ' . config('app.locale'));
        $this->line('  Mail Driver: ' . config('mail.default'));
        $this->line('  Queue Connection: ' . config('queue.default'));
    }
}
