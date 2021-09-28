<?php

use Illuminate\Database\Seeder;
use App\ReservationNotPossible;

class ReservationNotPossiblesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ReservationNotPossible::class, 10)->create();
    }
}
