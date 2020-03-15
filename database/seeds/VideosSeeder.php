<?php

use Illuminate\Database\Seeder;

class VideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file_get_contents(database_path() . '/imports/videos.json');
        foreach (json_decode($file) as $item) {
            \App\Video::updateOrCreate(['id' => $item->id], [
                'page_id' => $item->page_id,
                'header' => $item->header,
                'url' => $item->url,
                'position' => $item->position,
            ]);
        }
    }
}
