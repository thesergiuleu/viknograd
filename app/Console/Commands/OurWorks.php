<?php

namespace App\Console\Commands;

use App\InlineBlock;
use App\Libraries\Uploader\UploaderClass;
use App\Page;
use Illuminate\Console\Command;
use Illuminate\Http\UploadedFile;

class OurWorks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:our_works';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Our Works';
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
        $itemPage = Page::wherePageBlock(Page::OUR_WORKS)->first();
        if ($itemPage) {
            for ($i = 1; $i < 25; $i++) {
                if (file_exists(public_path() . '/assets/works/' . $i . ".jpg")) {
                    $newFile = new UploadedFile( public_path() . '/assets/works/' . $i . ".jpg", $i . ".jpg", 'image/jpeg',null,null, true);
                    $entity = [
                        'entity_type' => Page::class,
                        'entity_id'   => $itemPage->id,
                        'position'    => 'bottom'
                    ];
                    $this->uploader->setDirectory('pages_' . $itemPage->id);
                    $this->uploader->storeFile($newFile, $entity);
                }
            }
        }
    }
}
