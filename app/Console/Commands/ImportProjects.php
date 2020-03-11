<?php

namespace App\Console\Commands;

use App\InlineBlock;
use App\Libraries\Uploader\UploaderClass;
use App\Page;
use Illuminate\Console\Command;
use Illuminate\Http\UploadedFile;

class ImportProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:projects';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Projects';
    /**
     * @var UploaderClass
     */
    private $uploader;

    /**
     * Create a new command instance.
     *
     * @param UploaderClass $uploader
     */
    public function __construct(UploaderClass $uploader)
    {
        parent::__construct();
        $this->uploader = $uploader;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $projects = json_decode(file_get_contents(database_path() . '/imports/projects.json'), true);
        $projectPage = Page::wherePageBlock(Page::PROJECTS)->first();
        if ($projectPage) {
            foreach ($projects as $key => $project) {
                $data[$key]['page_id'] = $projectPage->id;
                $data[$key]['name']    = $project['desc'];
                $data[$key]['url']     = $project['link'];
                $data[$key]['body']    = $project['price'];
                $inlineBlock = InlineBlock::create($data[$key]);
                $newFile = new UploadedFile( public_path() . '/assets/projects/' . $project['imgPath'], $project['imgPath'], 'image/jpeg',null,null, true);
                $entity = [
                    'entity_type' => InlineBlock::class,
                    'entity_id'   => $inlineBlock->id,
                    'position'    => 'top'
                ];
                $this->uploader->setDirectory('inline_blocks_' . $inlineBlock->id);
                $this->uploader->storeFile($newFile, $entity);
            }
        }
    }
}
