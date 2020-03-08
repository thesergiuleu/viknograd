<?php

use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file_get_contents(env('APP_URL') . '/pages.json');
        foreach (json_decode($file) as $page) {
            \App\Page::updateOrCreate(['id' => $page->id], [
                'name' => $page->name,
                'page_header' => $page->page_header,
                'body' => $page->body,
                'page_block' => $page->page_block,
            ]);
        }
    }
}
