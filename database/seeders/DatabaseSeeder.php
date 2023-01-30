<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Akun Admin 
        DB::table('users')->delete();

        $users = [
            ['id' => 1, 'name' => 'Dhamar Adhi Susyatama Putra', 'email' => 'dhamar@admin.com', 'password' => Hash::make('admin123')],
            ['id' => 2, 'name' => 'Zanita Athira', 'email' => 'athira@admin.com', 'password' => Hash::make('admin123')],
        ];

        User::insert($users);

        // Kategori
        DB::table('categories')->delete();

        $categories = [
            ['id' => 1, 'name' => 'Makanan'],
            ['id' => 2, 'name' => 'Minuman'],
            ['id' => 3, 'name' => 'Pakaian'],
            ['id' => 4, 'name' => 'Kosmetik'],
            ['id' => 5, 'name' => 'Elektronik'],
            ['id' => 6, 'name' => 'Gadget Dan Aksesoris'],
            ['id' => 7, 'name' => 'Buku Dan Alat Tulis'],
            ['id' => 8, 'name' => 'Game'],
            ['id' => 9, 'name' => 'Otomotif'],
            ['id' => 10, 'name' => 'Travel'],
            ['id' => 11, 'name' => 'Tiket Hiburan'],
            ['id' => 12, 'name' => 'Rumah Tangga'],
        ];

        Category::insert($categories);
    }
}
