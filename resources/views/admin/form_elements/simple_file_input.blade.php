@if ($fileInstance)

    <div class="row file-container">
        <div class="col-md-4">
            <img src="{{asset('storage/'.$fileInstance->file)}}" alt="" class="img-rounded fluid-img">
        </div>
        <div class="col-md-8">
            <div class="pull-right">
                @authorize
                    <button type="button" class="btn btn-danger" onclick="replaceImage('{{route("upload.delete", ["id" => $fileInstance->id])}}', '{{$inputName}}', '{{$reloadPage}}')">
                        {{trans('actions.replace')}}
                    </button>
                @endauthorize
            </div>
        </div>
    </div>
@else
    <input type="file" name="{{$inputName}}" multiple class="form-control-file" id="exampleInput{{$inputName}}" />
    @if ($errors->has($inputName))
        <div class="has-error">
             <span class="help-block">
                <strong>{{ $errors->first($inputName) }}</strong>
            </span>
        </div>
    @endif
@endif
