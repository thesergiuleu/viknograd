<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(PagesSeeder::class);
         $this->call(InlineBlocksSeeder::class);
         $this->call(AttachmentsSeeder::class);
         $this->call(MenuItemsSeeder::class);
         $this->call(VideosSeeder::class);
    }
}
