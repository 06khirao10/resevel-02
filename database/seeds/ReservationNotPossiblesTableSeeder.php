<?php

use Illuminate\Database\Seeder;

class ReservationNotPossiblesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ReservationNotPossible::class, 10)->create();
    }
}
