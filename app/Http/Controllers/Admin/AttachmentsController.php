<?php

namespace App\Http\Controllers\Admin;

use App\Attachment;
use App\Libraries\Uploader\UploaderClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class AttachmentsController extends AdminBaseController
{
    private $uploader;

    public function __construct(Request $request, UploaderClass $uploader)
    {
        $this->uploader = $uploader;
        $this->request = $request;
        parent::__construct();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->uploader->destroy($id);
        $stateData = ($deleted) ? ['success', 200] : ['failed', 400];
        $message = trans('messages.uploader.'.$stateData[0]);
        if (request()->wantsJson()) {

            return response()->json([
                'message' => $message,
                'status' => $deleted,
            ], $stateData[1]);
        }

        return redirect()->back()->with('message', $message);
    }

    public function upload_from_editor(Request $request)
    {
        request()->validate([
            'attachments' => ['required', 'image'],
        ]);
        $path = $request->file('attachments')->storePublicly('files', 'public');

        $files = Storage::files('public/files/');
        $key = count($files);
        $view = View::make('admin.file_manager.item', [
            'file' => $path,
            'original_files' => [$key=> 'public/'.$path],
            'key' => $key
        ]);
        return response()->json(['html' => $view->render()]);

    }

    public function change_position($id)
    {
        $attachment = Attachment::query()->findOrFail($id);
        $attachment->position = $this->request->get('value');
        $attachment->save();
        return response()->json($attachment);
    }
}
