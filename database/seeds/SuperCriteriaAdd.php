<?php

use Illuminate\Database\Seeder;

class SuperCriteriaAdd extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\SuperCriteria::create([
            'name' => $this->command->ask('Super Criteria name')
        ]);
    }
}
