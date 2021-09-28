<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'テストユーザー',
                'email' => 'test@gmail.com',
                'password' => Hash::make('testtest'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        factory(User::class, 10)->create();
    }
}
