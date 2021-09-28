<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => '管理者用テストユーザー',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('adminadmin'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        factory(Admin::class, 10)->create();
    }
}
