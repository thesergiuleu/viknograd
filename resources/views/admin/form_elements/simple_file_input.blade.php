@if ($fileInstances)
    <div class="row">
        @if($has_input)
            <div class="col-md-12 form-group">
                <div class="pull-left">
                    <input type="file" multiple name="{{$inputName}}" class="form-control-file" />
                </div>
            </div>
        @endif
    @foreach($fileInstances as $fileInstance)
        <div class="col-md-4">
            <br>
            <div class="form-group">
                <div class="pull-left">
                    <button data-file_instance="{{json_encode($fileInstance)}}" data-input_name="{{$inputName}}" data-delete_url="{{route('attachment.delete', $fileInstance->id)}}" type="button" onclick="removeFile(this)" class="btn btn-danger">{{trans('actions.remove')}}</button>
                </div>
            </div>
            <br>
            <div class="form-control-file">
                <img src="{{asset('storage/'.$fileInstance->file)}}" alt="" class="img-rounded fluid-img">
            </div>
        </div>
    @endforeach
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
