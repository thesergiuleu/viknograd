<?php

use Illuminate\Database\Seeder;

class AttachmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = file_get_contents(env('APP_URL') . '/attachments.json');
        foreach (json_decode($file) as $item) {
            \App\Attachment::updateOrCreate(['id' => $item->id], [
                'title' => $item->title,
                'file' => $item->file,
                'entity_type' => $item->entity_type,
                'entity_id' => $item->entity_id,
                'web_address' => $item->web_address,
                'file_type' => $item->file_type,
                'position' => $item->position,
            ]);
        }
    }
}
