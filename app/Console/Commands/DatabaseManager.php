<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Destination;

class DatabaseManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:manage {action} {table?} {id?} {--field=} {--value=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Database management console - CRUD operations for tables';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');
        $table = $this->argument('table');
        $id = $this->argument('id');
        $field = $this->option('field');
        $value = $this->option('value');

        switch ($action) {
            case 'list':
                $this->listTables();
                break;
            case 'show':
                $this->showTable($table);
                break;
            case 'create':
                $this->createRecord($table, $field, $value);
                break;
            case 'update':
                $this->updateRecord($table, $id, $field, $value);
                break;
            case 'delete':
                $this->deleteRecord($table, $id);
                break;
            case 'truncate':
                $this->truncateTable($table);
                break;
            default:
                $this->error("Unknown action: {$action}");
                $this->showHelp();
                break;
        }
    }

    private function listTables()
    {
        $tables = [
            'users' => User::class,
            'reservations' => Reservation::class,
            'destinations' => Destination::class,
        ];

        $this->info('Available tables:');
        foreach ($tables as $name => $model) {
            $count = $model::count();
            $this->line("  {$name} - {$count} records");
        }
    }

    private function showTable($table)
    {
        if (!$table) {
            $this->error('Please specify a table name');
            return;
        }

        $tables = [
            'users' => User::class,
            'reservations' => Reservation::class,
            'destinations' => Destination::class,
        ];

        if (!isset($tables[$table])) {
            $this->error("Unknown table: {$table}");
            return;
        }

        $model = $tables[$table];
        $records = $model::limit(10)->get();

        $this->info("Table: {$table}");
        $this->line(str_repeat('-', 50));

        if ($records->isEmpty()) {
            $this->line('No records found');
            return;
        }

        $headers = array_keys($records->first()->toArray());
        $this->table($headers, $records->toArray());
    }

    private function createRecord($table, $field, $value)
    {
        if (!$table || !$field || !$value) {
            $this->error('Usage: db:manage create --field=<field> --value=<value> <table>');
            return;
        }

        $tables = [
            'users' => ['name', 'email', 'password', 'is_admin', 'is_iroda'],
            'reservations' => ['full_name', 'email', 'phone', 'people_count', 'status', 'destination_id', 'user_id'],
            'destinations' => ['title', 'description', 'price_huf', 'start_date', 'end_date'],
        ];

        if (!isset($tables[$table])) {
            $this->error("Unknown table: {$table}");
            return;
        }

        if (!in_array($field, $tables[$table])) {
            $this->error("Invalid field '{$field}' for table '{$table}'");
            $this->line("Available fields: " . implode(', ', $tables[$table]));
            return;
        }

        $models = [
            'users' => User::class,
            'reservations' => Reservation::class,
            'destinations' => Destination::class,
        ];

        $model = $models[$table];
        $model::create([$field => $value]);

        $this->info("Record created in {$table}: {$field} = {$value}");
    }

    private function updateRecord($table, $id, $field, $value)
    {
        if (!$table || !$id || !$field || !$value) {
            $this->error('Usage: db:manage update <id> --field=<field> --value=<value> <table>');
            return;
        }

        $models = [
            'users' => User::class,
            'reservations' => Reservation::class,
            'destinations' => Destination::class,
        ];

        if (!isset($models[$table])) {
            $this->error("Unknown table: {$table}");
            return;
        }

        $model = $models[$table];
        $record = $model::find($id);

        if (!$record) {
            $this->error("Record not found in {$table} with ID: {$id}");
            return;
        }

        $record->update([$field => $value]);

        $this->info("Record updated in {$table} (ID: {$id}): {$field} = {$value}");
    }

    private function deleteRecord($table, $id)
    {
        if (!$table || !$id) {
            $this->error('Usage: db:manage delete <id> <table>');
            return;
        }

        $models = [
            'users' => User::class,
            'reservations' => Reservation::class,
            'destinations' => Destination::class,
        ];

        if (!isset($models[$table])) {
            $this->error("Unknown table: {$table}");
            return;
        }

        $model = $models[$table];
        $record = $model::find($id);

        if (!$record) {
            $this->error("Record not found in {$table} with ID: {$id}");
            return;
        }

        $record->delete();

        $this->info("Record deleted from {$table} (ID: {$id})");
    }

    private function truncateTable($table)
    {
        if (!$table) {
            $this->error('Usage: db:manage truncate <table>');
            return;
        }

        $tables = [
            'users' => User::class,
            'reservations' => Reservation::class,
            'destinations' => Destination::class,
        ];

        if (!isset($tables[$table])) {
            $this->error("Unknown table: {$table}");
            return;
        }

        if ($this->confirm("Are you sure you want to truncate {$table}? This will delete ALL records.")) {
            $model = $tables[$table];
            $model::truncate();
            $this->info("Table {$table} truncated successfully");
        }
    }

    private function showHelp()
    {
        $this->info('Database Manager Help:');
        $this->line('');
        $this->line('Actions:');
        $this->line('  list                    - List all tables with record counts');
        $this->line('  show <table>           - Show records in a table');
        $this->line('  create --field=<field> --value=<value> <table>  - Create new record');
        $this->line('  update <id> --field=<field> --value=<value> <table>  - Update record');
        $this->line('  delete <id> <table>    - Delete record');
        $this->line('  truncate <table>        - Delete all records in table');
        $this->line('');
        $this->line('Available tables: users, reservations, destinations');
        $this->line('');
        $this->line('Examples:');
        $this->line('  php artisan db:manage list');
        $this->line('  php artisan db:manage show reservations');
        $this->line('  php artisan db:manage create --field=full_name --value="John Doe" reservations');
        $this->line('  php artisan db:manage update 1 --field=status --value=confirmed reservations');
        $this->line('  php artisan db:manage delete 5 reservations');
        $this->line('  php artisan db:manage truncate reservations');
    }
}
