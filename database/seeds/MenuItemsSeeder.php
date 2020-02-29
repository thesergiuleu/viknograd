<?php

use Illuminate\Database\Seeder;

class MenuItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file_get_contents(env('APP_URL') . '/menu_items.json');
        foreach (json_decode($file) as $item) {
            \App\ApiMenuItem::updateOrCreate(['id' => $item->id], [
                'parent_id' => $item->parent_id,
                'page_id' => $item->page_id,
            ]);
        }
    }
}
