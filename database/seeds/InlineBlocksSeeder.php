<?php

use Illuminate\Database\Seeder;

class InlineBlocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file_get_contents(env('APP_URL') . '/inline_blocks.json');
        foreach (json_decode($file) as $item) {
            \App\InlineBlock::updateOrCreate(['id' => $item->id], [
                'name' => $item->name,
                'page_id' => $item->page_id,
                'header' => $item->header,
                'url' => $item->url,
                'body' => $item->body,
            ]);
        }
    }
}
