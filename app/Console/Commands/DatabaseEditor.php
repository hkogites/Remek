<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Destination;

class DatabaseEditor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:edit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Interactive database editor with menu-driven interface';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🗄️  Database Editor');
        $this->info('==================');
        $this->info('Welcome to the interactive database editor!');
        $this->line('');

        while (true) {
            $this->showMainMenu();
            $choice = $this->ask('Enter your choice (1-6):');

            switch ($choice) {
                case '1':
                    $this->editUsers();
                    break;
                case '2':
                    $this->editReservations();
                    break;
                case '3':
                    $this->editDestinations();
                    break;
                case '4':
                    $this->viewAllTables();
                    break;
                case '5':
                    $this->quickActions();
                    break;
                case '6':
                    $this->info('Goodbye! 👋');
                    return;
                default:
                    $this->error('Invalid choice. Please try again.');
                    break;
            }
        }
    }

    private function showMainMenu()
    {
        $this->line('📋 Main Menu:');
        $this->line('1. 👥 Edit Users');
        $this->line('2. 📝 Edit Reservations');
        $this->line('3. 🗺️  Edit Destinations');
        $this->line('4. 📊 View All Tables');
        $this->line('5. ⚡ Quick Actions');
        $this->line('6. 🚪 Exit');
        $this->line('');
    }

    private function editUsers()
    {
        $this->info('👥 User Management');
        $this->line(str_repeat('-', 20));

        while (true) {
            $this->showUserMenu();
            $choice = $this->ask('Enter your choice (1-6):');

            switch ($choice) {
                case '1':
                    $this->listUsers();
                    break;
                case '2':
                    $this->createUser();
                    break;
                case '3':
                    $this->updateUser();
                    break;
                case '4':
                    $this->deleteUser();
                    break;
                case '5':
                    $this->searchUsers();
                    break;
                case '6':
                    return;
                default:
                    $this->error('Invalid choice. Please try again.');
                    break;
            }
        }
    }

    private function showUserMenu()
    {
        $this->line('👤 User Operations:');
        $this->line('1. 📋 List Users');
        $this->line('2. ➕ Create User');
        $this->line('3. ✏️  Update User');
        $this->line('4. 🗑️  Delete User');
        $this->line('5. 🔍 Search Users');
        $this->line('6. ⬅️  Back to Main Menu');
        $this->line('');
    }

    private function listUsers()
    {
        $users = User::select('id', 'name', 'email', 'is_admin', 'is_iroda')
                    ->orderBy('id')
                    ->limit(20)
                    ->get();

        if ($users->isEmpty()) {
            $this->warn('No users found.');
            return;
        }

        $this->info('📋 Users List:');
        $headers = ['ID', 'Name', 'Email', 'Admin', 'Iroda'];
        $rows = $users->map(function($user) {
            return [
                $user->id,
                $user->name,
                $user->email,
                $user->is_admin ? '✅' : '❌',
                $user->is_iroda ? '✅' : '❌'
            ];
        });
        $this->table($headers, $rows->toArray());
    }

    private function createUser()
    {
        $this->info('➕ Create New User');
        
        $name = $this->ask('Enter user name:');
        $email = $this->ask('Enter user email:');
        
        // Check if email exists
        if (User::where('email', $email)->exists()) {
            $this->error('Email already exists!');
            return;
        }
        
        $password = $this->secret('Enter password:');
        $isAdmin = $this->confirm('Is this user an admin?');
        $isIroda = $this->confirm('Is this user an iroda user?');

        try {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'is_admin' => $isAdmin,
                'is_iroda' => $isIroda,
            ]);

            $this->info('✅ User created successfully!');
        } catch (\Exception $e) {
            $this->error('❌ Error creating user: ' . $e->getMessage());
        }
    }

    private function updateUser()
    {
        $this->info('✏️ Update User');
        
        $userId = $this->ask('Enter user ID to update:');
        $user = User::find($userId);

        if (!$user) {
            $this->error('User not found!');
            return;
        }

        $this->info("Current user: {$user->name} ({$user->email})");
        
        $name = $this->ask("Enter new name [{$user->name}]:") ?: $user->name;
        $email = $this->ask("Enter new email [{$user->email}]:") ?: $user->email;
        
        if ($email !== $user->email && User::where('email', $email)->exists()) {
            $this->error('Email already exists!');
            return;
        }

        $changePassword = $this->confirm('Change password?');
        $password = $changePassword ? $this->secret('Enter new password:') : null;
        $isAdmin = $this->confirm("Is admin? [Current: " . ($user->is_admin ? 'Yes' : 'No') . "]");
        $isIroda = $this->confirm("Is iroda? [Current: " . ($user->is_iroda ? 'Yes' : 'No') . "]");

        try {
            $updateData = [
                'name' => $name,
                'email' => $email,
                'is_admin' => $isAdmin,
                'is_iroda' => $isIroda,
            ];

            if ($password) {
                $updateData['password'] = bcrypt($password);
            }

            $user->update($updateData);
            $this->info('✅ User updated successfully!');
        } catch (\Exception $e) {
            $this->error('❌ Error updating user: ' . $e->getMessage());
        }
    }

    private function deleteUser()
    {
        $this->info('🗑️ Delete User');
        
        $userId = $this->ask('Enter user ID to delete:');
        $user = User::find($userId);

        if (!$user) {
            $this->error('User not found!');
            return;
        }

        $this->warn("User to delete: {$user->name} ({$user->email})");
        
        if ($this->confirm('Are you sure you want to delete this user?')) {
            try {
                $user->delete();
                $this->info('✅ User deleted successfully!');
            } catch (\Exception $e) {
                $this->error('❌ Error deleting user: ' . $e->getMessage());
            }
        }
    }

    private function searchUsers()
    {
        $searchTerm = $this->ask('Enter search term (name or email):');
        
        $users = User::where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%")
                    ->limit(10)
                    ->get();

        if ($users->isEmpty()) {
            $this->warn('No users found matching your search.');
            return;
        }

        $this->info("🔍 Search Results for '{$searchTerm}':");
        $headers = ['ID', 'Name', 'Email', 'Admin', 'Iroda'];
        $rows = $users->map(function($user) {
            return [
                $user->id,
                $user->name,
                $user->email,
                $user->is_admin ? '✅' : '❌',
                $user->is_iroda ? '✅' : '❌'
            ];
        });
        $this->table($headers, $rows->toArray());
    }

    private function editReservations()
    {
        $this->info('📝 Reservation Management');
        $this->line(str_repeat('-', 25));

        while (true) {
            $this->showReservationMenu();
            $choice = $this->ask('Enter your choice (1-6):');

            switch ($choice) {
                case '1':
                    $this->listReservations();
                    break;
                case '2':
                    $this->updateReservationStatus();
                    break;
                case '3':
                    $this->deleteReservation();
                    break;
                case '4':
                    $this->searchReservations();
                    break;
                case '5':
                    $this->createReservation();
                    break;
                case '6':
                    return;
                default:
                    $this->error('Invalid choice. Please try again.');
                    break;
            }
        }
    }

    private function showReservationMenu()
    {
        $this->line('📋 Reservation Operations:');
        $this->line('1. 📋 List Reservations');
        $this->line('2. ✏️  Update Status');
        $this->line('3. 🗑️  Delete Reservation');
        $this->line('4. 🔍 Search Reservations');
        $this->line('5. ➕ Create Reservation');
        $this->line('6. ⬅️  Back to Main Menu');
        $this->line('');
    }

    private function listReservations()
    {
        $reservations = Reservation::with(['destination', 'user'])
                                 ->select('id', 'full_name', 'email', 'phone', 'people_count', 'status', 'destination_id', 'user_id', 'created_at')
                                 ->orderBy('created_at', 'desc')
                                 ->limit(20)
                                 ->get();

        if ($reservations->isEmpty()) {
            $this->warn('No reservations found.');
            return;
        }

        $this->info('📋 Reservations List:');
        $headers = ['ID', 'Name', 'Email', 'Status', 'People', 'Destination', 'Date'];
        $rows = $reservations->map(function($reservation) {
            return [
                $reservation->id,
                $reservation->full_name,
                $reservation->email,
                $reservation->status,
                $reservation->people_count,
                $reservation->destination->title ?? 'N/A',
                $reservation->created_at->format('Y-m-d')
            ];
        });
        $this->table($headers, $rows->toArray());
    }

    private function updateReservationStatus()
    {
        $this->info('✏️ Update Reservation Status');
        
        $reservationId = $this->ask('Enter reservation ID:');
        $reservation = Reservation::find($reservationId);

        if (!$reservation) {
            $this->error('Reservation not found!');
            return;
        }

        $this->info("Current status: {$reservation->status}");
        $this->line('Available statuses: pending, confirmed, cancelled');
        
        $newStatus = $this->ask('Enter new status:');
        
        if (!in_array($newStatus, ['pending', 'confirmed', 'cancelled'])) {
            $this->error('Invalid status!');
            return;
        }

        try {
            $reservation->update(['status' => $newStatus]);
            $this->info('✅ Reservation status updated successfully!');
        } catch (\Exception $e) {
            $this->error('❌ Error updating reservation: ' . $e->getMessage());
        }
    }

    private function deleteReservation()
    {
        $this->info('🗑️ Delete Reservation');
        
        $reservationId = $this->ask('Enter reservation ID to delete:');
        $reservation = Reservation::find($reservationId);

        if (!$reservation) {
            $this->error('Reservation not found!');
            return;
        }

        $this->warn("Reservation to delete: {$reservation->full_name} ({$reservation->email})");
        
        if ($this->confirm('Are you sure you want to delete this reservation?')) {
            try {
                $reservation->delete();
                $this->info('✅ Reservation deleted successfully!');
            } catch (\Exception $e) {
                $this->error('❌ Error deleting reservation: ' . $e->getMessage());
            }
        }
    }

    private function searchReservations()
    {
        $searchTerm = $this->ask('Enter search term (name, email, or status):');
        
        $reservations = Reservation::where('full_name', 'like', "%{$searchTerm}%")
                                  ->orWhere('email', 'like', "%{$searchTerm}%")
                                  ->orWhere('status', 'like', "%{$searchTerm}%")
                                  ->limit(10)
                                  ->get();

        if ($reservations->isEmpty()) {
            $this->warn('No reservations found matching your search.');
            return;
        }

        $this->info("🔍 Search Results for '{$searchTerm}':");
        $headers = ['ID', 'Name', 'Email', 'Status', 'People', 'Date'];
        $rows = $reservations->map(function($reservation) {
            return [
                $reservation->id,
                $reservation->full_name,
                $reservation->email,
                $reservation->status,
                $reservation->people_count,
                $reservation->created_at->format('Y-m-d')
            ];
        });
        $this->table($headers, $rows->toArray());
    }

    private function createReservation()
    {
        $this->info('➕ Create New Reservation');
        
        $fullName = $this->ask('Enter full name:');
        $email = $this->ask('Enter email:');
        $phone = $this->ask('Enter phone:');
        $peopleCount = $this->ask('Enter number of people:');
        $status = $this->choice('Select status:', ['pending', 'confirmed', 'cancelled'], 0);

        // Get destinations
        $destinations = Destination::all();
        if ($destinations->isEmpty()) {
            $this->warn('No destinations available. Please create a destination first.');
            return;
        }

        $this->info('Available destinations:');
        foreach ($destinations as $index => $destination) {
            $this->line(($index + 1) . ". {$destination->title} - {$destination->price_huf} HUF");
        }
        
        $destinationChoice = $this->ask('Select destination number:');
        $destination = $destinations->get($destinationChoice - 1);

        if (!$destination) {
            $this->error('Invalid destination choice!');
            return;
        }

        try {
            Reservation::create([
                'full_name' => $fullName,
                'email' => $email,
                'phone' => $phone,
                'people_count' => $peopleCount,
                'status' => $status,
                'destination_id' => $destination->id,
                'user_id' => 1, // Default to admin user
            ]);

            $this->info('✅ Reservation created successfully!');
        } catch (\Exception $e) {
            $this->error('❌ Error creating reservation: ' . $e->getMessage());
        }
    }

    private function editDestinations()
    {
        $this->info('🗺️ Destination Management');
        $this->line(str_repeat('-', 25));

        while (true) {
            $this->showDestinationMenu();
            $choice = $this->ask('Enter your choice (1-6):');

            switch ($choice) {
                case '1':
                    $this->listDestinations();
                    break;
                case '2':
                    $this->createDestination();
                    break;
                case '3':
                    $this->updateDestination();
                    break;
                case '4':
                    $this->deleteDestination();
                    break;
                case '5':
                    $this->searchDestinations();
                    break;
                case '6':
                    return;
                default:
                    $this->error('Invalid choice. Please try again.');
                    break;
            }
        }
    }

    private function showDestinationMenu()
    {
        $this->line('🗺️ Destination Operations:');
        $this->line('1. 📋 List Destinations');
        $this->line('2. ➕ Create Destination');
        $this->line('3. ✏️  Update Destination');
        $this->line('4. 🗑️  Delete Destination');
        $this->line('5. 🔍 Search Destinations');
        $this->line('6. ⬅️  Back to Main Menu');
        $this->line('');
    }

    private function listDestinations()
    {
        $destinations = Destination::select('id', 'title', 'price_huf', 'start_date', 'end_date')
                                 ->orderBy('title')
                                 ->limit(20)
                                 ->get();

        if ($destinations->isEmpty()) {
            $this->warn('No destinations found.');
            return;
        }

        $this->info('📋 Destinations List:');
        $headers = ['ID', 'Title', 'Price (HUF)', 'Start Date', 'End Date'];
        $rows = $destinations->map(function($destination) {
            return [
                $destination->id,
                $destination->title,
                number_format($destination->price_huf, 0),
                $destination->start_date,
                $destination->end_date
            ];
        });
        $this->table($headers, $rows->toArray());
    }

    private function createDestination()
    {
        $this->info('➕ Create New Destination');
        
        $title = $this->ask('Enter destination title:');
        $description = $this->ask('Enter description:');
        $price = $this->ask('Enter price (HUF):');
        $startDate = $this->ask('Enter start date (YYYY-MM-DD):');
        $endDate = $this->ask('Enter end date (YYYY-MM-DD):');

        try {
            Destination::create([
                'title' => $title,
                'description' => $description,
                'price_huf' => $price,
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);

            $this->info('✅ Destination created successfully!');
        } catch (\Exception $e) {
            $this->error('❌ Error creating destination: ' . $e->getMessage());
        }
    }

    private function updateDestination()
    {
        $this->info('✏️ Update Destination');
        
        $destinationId = $this->ask('Enter destination ID to update:');
        $destination = Destination::find($destinationId);

        if (!$destination) {
            $this->error('Destination not found!');
            return;
        }

        $this->info("Current destination: {$destination->title}");
        
        $title = $this->ask("Enter new title [{$destination->title}]:") ?: $destination->title;
        $description = $this->ask("Enter new description:") ?: $destination->description;
        $price = $this->ask("Enter new price [{$destination->price_huf}]:") ?: $destination->price_huf;
        $startDate = $this->ask("Enter new start date [{$destination->start_date}]:") ?: $destination->start_date;
        $endDate = $this->ask("Enter new end date [{$destination->end_date}]:") ?: $destination->end_date;

        try {
            $destination->update([
                'title' => $title,
                'description' => $description,
                'price_huf' => $price,
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);

            $this->info('✅ Destination updated successfully!');
        } catch (\Exception $e) {
            $this->error('❌ Error updating destination: ' . $e->getMessage());
        }
    }

    private function deleteDestination()
    {
        $this->info('🗑️ Delete Destination');
        
        $destinationId = $this->ask('Enter destination ID to delete:');
        $destination = Destination::find($destinationId);

        if (!$destination) {
            $this->error('Destination not found!');
            return;
        }

        $this->warn("Destination to delete: {$destination->title}");
        
        if ($this->confirm('Are you sure you want to delete this destination?')) {
            try {
                $destination->delete();
                $this->info('✅ Destination deleted successfully!');
            } catch (\Exception $e) {
                $this->error('❌ Error deleting destination: ' . $e->getMessage());
            }
        }
    }

    private function searchDestinations()
    {
        $searchTerm = $this->ask('Enter search term (title or description):');
        
        $destinations = Destination::where('title', 'like', "%{$searchTerm}%")
                                  ->orWhere('description', 'like', "%{$searchTerm}%")
                                  ->limit(10)
                                  ->get();

        if ($destinations->isEmpty()) {
            $this->warn('No destinations found matching your search.');
            return;
        }

        $this->info("🔍 Search Results for '{$searchTerm}':");
        $headers = ['ID', 'Title', 'Price (HUF)', 'Start Date', 'End Date'];
        $rows = $destinations->map(function($destination) {
            return [
                $destination->id,
                $destination->title,
                number_format($destination->price_huf, 0),
                $destination->start_date,
                $destination->end_date
            ];
        });
        $this->table($headers, $rows->toArray());
    }

    private function viewAllTables()
    {
        $this->info('📊 Database Overview');
        $this->line(str_repeat('-', 20));

        $tables = [
            'Users' => User::count(),
            'Reservations' => Reservation::count(),
            'Destinations' => Destination::count(),
        ];

        $this->table(['Table', 'Records'], array_map(function($count, $table) {
            return [$table, $count];
        }, $tables, array_keys($tables)));

        $this->line('');
        $this->info('Recent Activity:');
        
        $recentUsers = User::latest('id')->limit(3)->pluck('name');
        $recentReservations = Reservation::latest('created_at')->limit(3)->pluck('full_name');
        $recentDestinations = Destination::latest('id')->limit(3)->pluck('title');

        $this->line('👥 Recent Users: ' . $recentUsers->implode(', '));
        $this->line('📝 Recent Reservations: ' . $recentReservations->implode(', '));
        $this->line('🗺️ Recent Destinations: ' . $recentDestinations->implode(', '));
    }

    private function quickActions()
    {
        $this->info('⚡ Quick Actions');
        $this->line(str_repeat('-', 15));

        while (true) {
            $this->showQuickActionsMenu();
            $choice = $this->ask('Enter your choice (1-5):');

            switch ($choice) {
                case '1':
                    $this->clearPendingReservations();
                    break;
                case '2':
                    $this->createTestUser();
                    break;
                    case '3':
                    $this->showStatistics();
                    break;
                case '4':
                    $this->backupData();
                    break;
                case '5':
                    return;
                default:
                    $this->error('Invalid choice. Please try again.');
                    break;
            }
        }
    }

    private function showQuickActionsMenu()
    {
        $this->line('⚡ Quick Actions:');
        $this->line('1. 🧹 Clear Pending Reservations');
        $this->line('2. 👤 Create Test User');
        $this->line('3. 📊 Show Statistics');
        $this->line('4. 💾 Backup Data');
        $this->line('5. ⬅️  Back to Main Menu');
        $this->line('');
    }

    private function clearPendingReservations()
    {
        $pendingCount = Reservation::where('status', 'pending')->count();
        
        if ($pendingCount === 0) {
            $this->info('No pending reservations to clear.');
            return;
        }

        $this->warn("Found {$pendingCount} pending reservations.");
        
        if ($this->confirm('Clear all pending reservations?')) {
            $deleted = Reservation::where('status', 'pending')->delete();
            $this->info("✅ Cleared {$deleted} pending reservations!");
        }
    }

    private function createTestUser()
    {
        $email = 'test@example.com';
        
        if (User::where('email', $email)->exists()) {
            $this->warn('Test user already exists!');
            return;
        }

        User::create([
            'name' => 'Test User',
            'email' => $email,
            'password' => bcrypt('password'),
            'is_admin' => true,
            'is_iroda' => true,
        ]);

        $this->info('✅ Test user created successfully!');
        $this->info('Email: test@example.com');
        $this->info('Password: password');
    }

    private function showStatistics()
    {
        $this->info('📊 Database Statistics');
        $this->line(str_repeat('-', 20));

        $stats = [
            'Total Users' => User::count(),
            'Admin Users' => User::where('is_admin', true)->count(),
            'Iroda Users' => User::where('is_iroda', true)->count(),
            'Total Reservations' => Reservation::count(),
            'Pending Reservations' => Reservation::where('status', 'pending')->count(),
            'Confirmed Reservations' => Reservation::where('status', 'confirmed')->count(),
            'Cancelled Reservations' => Reservation::where('status', 'cancelled')->count(),
            'Total Destinations' => Destination::count(),
        ];

        foreach ($stats as $label => $value) {
            $this->line("{$label}: {$value}");
        }
    }

    private function backupData()
    {
        $this->info('💾 Creating data backup...');
        
        $backup = [
            'timestamp' => now()->toDateTimeString(),
            'users' => User::all()->toArray(),
            'reservations' => Reservation::with(['destination', 'user'])->get()->toArray(),
            'destinations' => Destination::all()->toArray(),
        ];

        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.json';
        $path = storage_path("app/backups/{$filename}");
        
        // Create backups directory if it doesn't exist
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        file_put_contents($path, json_encode($backup, JSON_PRETTY_PRINT));
        
        $this->info("✅ Backup created: {$filename}");
        $this->info("Location: {$path}");
    }
}
