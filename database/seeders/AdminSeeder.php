<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'manage users',
            'manage roles',
            'manage permissions',
            'view dashboard',
            'manage content',
            'manage settings'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $adminPikrRole = Role::firstOrCreate(['name' => 'admin_pikr']);
        $adminBkbnRole = Role::firstOrCreate(['name' => 'admin_bkbn']);

        // Assign all permissions to admin role
        $adminRole->givePermissionTo(Permission::all());
        
        // Assign permissions to admin_pikr role
        $adminPikrRole->givePermissionTo(['view dashboard', 'manage content']);
        
        // Assign permissions to admin_bkbn role
        $adminBkbnRole->givePermissionTo(['view dashboard', 'manage content', 'manage settings']);
        
        // Assign basic permissions to user role
        $userRole->givePermissionTo(['view dashboard']);

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@genre.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Assign admin role to admin user
        $admin->assignRole('admin');

        // Create regular user for testing
        $user = User::firstOrCreate(
            ['email' => 'user@genre.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Assign user role to regular user
        $user->assignRole('user');
        
        // Create admin_bkbn user for testing
        $adminBkbn = User::firstOrCreate(
            ['email' => 'bkbn@genre.com'],
            [
                'name' => 'Admin BKBN',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Assign admin_bkbn role to admin_bkbn user
        $adminBkbn->assignRole('admin_bkbn');

        $this->command->info('Admin, User, and Admin BKBN accounts created successfully!');
        $this->command->info('Admin: admin@genre.com / password123');
        $this->command->info('User: user@genre.com / password123');
        $this->command->info('Admin BKBN: bkbn@genre.com / password123');
    }
}
