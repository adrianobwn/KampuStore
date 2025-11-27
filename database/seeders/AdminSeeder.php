<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('');
        $this->command->info('╔═══════════════════════════════════════════════════════════╗');
        $this->command->info('║     🔐 MEMBUAT ADMIN DUMMY - KAMPUSTORE                  ║');
        $this->command->info('╚═══════════════════════════════════════════════════════════╝');
        $this->command->info('');
        
        // Cek apakah admin sudah ada
        $adminExists = User::where('email', 'admin@kampustore.com')->exists();
        
        if (!$adminExists) {
            User::create([
                'name' => 'Admin KampuStore',
                'email' => 'admin@kampustore.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]);
            
            $this->command->info('✅ Admin dummy berhasil dibuat!');
            $this->command->info('📧 Email: admin@kampustore.com');
            $this->command->info('🔑 Password: admin123');
        } else {
            $this->command->warn('⚠️  Admin sudah ada di database.');
        }
        
        $this->command->info('');
        
        // Buat beberapa admin tambahan jika diperlukan
        $adminList = [
            [
                'name' => 'Admin Verifikator 1',
                'email' => 'verifikator1@kampustore.com',
                'password' => 'verifikator123',
            ],
            [
                'name' => 'Admin Verifikator 2',
                'email' => 'verifikator2@kampustore.com',
                'password' => 'verifikator123',
            ],
        ];
        
        foreach ($adminList as $admin) {
            $exists = User::where('email', $admin['email'])->exists();
            
            if (!$exists) {
                User::create([
                    'name' => $admin['name'],
                    'email' => $admin['email'],
                    'password' => Hash::make($admin['password']),
                    'is_admin' => true,
                    'email_verified_at' => now(),
                ]);
                
                $this->command->info("✅ {$admin['name']} berhasil dibuat!");
            }
        }
        
        $this->command->info('');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->line('🌐 <fg=cyan>LOGIN URL:</fg=cyan> http://127.0.0.1:8000/login');
        $this->command->line('📋 <fg=cyan>ADMIN DASHBOARD:</fg=cyan> http://127.0.0.1:8000/admin/dashboard');
        $this->command->line('🏪 <fg=cyan>VERIFIKASI TOKO:</fg=cyan> http://127.0.0.1:8000/admin/toko/registrasi');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->info('');
        $this->command->line('📝 <fg=yellow>Lihat dokumentasi lengkap di:</fg=yellow>');
        $this->command->line('   • ADMIN_CREDENTIALS.md');
        $this->command->line('   • QUICK_START.md');
        $this->command->info('');
    }
}
