<?php

namespace App\Console\Commands;

use App\Libraries\Uploader\UploaderClass;
use App\Page;
use Illuminate\Console\Command;
use Illuminate\Http\UploadedFile;

class ImportCorporate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:corporate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import corporate';

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
        $itemPage = Page::whereId(57)->first();
        if ($itemPage) {
            for ($i = 1; $i < 6; $i++) {
                if (file_exists(public_path() . '/assets/corporate/' . $i . ".jpg")) {
                    $newFile = new UploadedFile( public_path() . '/assets/corporate/' . $i . ".jpg", $i . ".jpg", 'image/jpeg',null,null, true);
                    $entity = [
                        'entity_type' => Page::class,
                        'entity_id'   => $itemPage->id,
                        'position'    => 'top'
                    ];
                    $this->uploader->setDirectory('pages_' . $itemPage->id);
                    $this->uploader->storeFile($newFile, $entity);
                }
            }
        }
    }
}
