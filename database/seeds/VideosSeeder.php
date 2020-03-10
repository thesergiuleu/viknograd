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
        $file = file_get_contents(env('APP_URL') . '/videos.json');
        foreach (json_decode($file) as $item) {
            \App\Video::updateOrCreate(['id' => $item->id], [
                'name' => $item->name,
                'header' => $item->header,
                'url' => $item->url,
                'position' => $item->position,
            ]);
        }
    }
}
