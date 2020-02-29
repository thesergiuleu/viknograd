<?php

namespace App\Libraries\Uploader;

use App\Attachment;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Illuminate\Support\Facades\Storage;

class UploaderClass
{
    private $directory = './';

    private $request;

    private $repository;

    private $location = 'public';


    function __construct(Attachment $model, Request $request)
    {
        $this->repository = $model;
        $this->request    = $request;
    }

    public function storeFile($file, $entity = [])
    {

        try {
            if ($file && $file instanceof UploadedFile) {
                $entity['file_type'] = $this->getFileType($file->getClientMimeType());
                $entity['file'] = $file->storePublicly($this->directory, $this->location);
                if ($entity['file']) {
                    return $this->repository->create($entity);
                }
            }
        } catch (UploadException $e) {
            return $e->getMessage();
        }

    }

    /**
     * @param string $key
     * @param array $entity
     * @return mixed|Attachment
     */
    public function storeFileFromRequest($key, $entity = [])
    {

        try {
            $isFile = $this->request->hasFile($key);

            if ($isFile) {
                $file = $this->request->file($key);
                $entity['file_type'] = $this->getFileType($file->getClientMimeType());
                $entity['file'] = $file->storePublicly($this->directory, $this->location);
                if ($entity['file']) {
                    return $this->repository->create($entity);
                }

            }
        } catch (UploadException $e) {
            return $e->getMessage();
        }
    }

    public function storeMultipleFiles($files = [], $data = [])
    {
        foreach ($files as $key => $file) {
            $data['entity']['web_address'] = $data['web_addresses'][$key];
            $data['entity']['title']       = $data['titles'][$key];
            $this->storeFile($file, $data['entity']);
        }
    }


    public function destroy($fileID)
    {
        try {
            $fileModel = $this->repository->find($fileID);

            if ($fileModel) {
                $deleted = Storage::disk('public')->delete($fileModel->file);
                if ($deleted) {
                    return $this->repository->destroy($fileID);
                }
                return $deleted;
            }
        } catch (UploadException $e) {
            return $e->getMessage();
        }
    }

    public function validate($key, $rules)
    {
        if ($this->request instanceof Request) {
            return $this->request->validate([
                $key => $rules,
            ]);
        }
        throw new UploadException('There is no request instance !!!');
    }

    public function setDirectory($path)
    {
        $this->directory = $path;
    }

    /**
     * @param $file_mime
     * @return string
     */
    private function getFileType($file_mime)
    {
        $types = config('filesystems.file_mimes');
        if (array_key_exists($file_mime, $types)) {
            return $types[$file_mime];
        }

        return $file_mime;
    }
}
