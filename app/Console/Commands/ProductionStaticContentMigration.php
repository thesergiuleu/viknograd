<?php

namespace App\Console\Commands;

use App\StaticContent;
use Illuminate\Console\Command;

class ProductionStaticContentMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'content:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed production database with new content static';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $ticket = 'static-content';
        $content = file_get_contents(database_path() . '/seeds/static_content.json');
        if (isset(json_decode($content)->{$ticket}) && $items = json_decode($content)->{$ticket}) {
            foreach ($items as $item) {
                $staticContent = StaticContent::whereAlias($item->alias)->first();
                if (!$staticContent) {
                    StaticContent::create([
                        'title'       => $item->title,
                        'description' => $item->description,
                        'alias'       => $item->alias,
                        'group_by'    => $item->group_by,
                        'active'      => 1,
                    ]);
                }
            }

            $this->info('Seeds are done');
        }
    }
}
