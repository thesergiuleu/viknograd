@if ($fileInstances)
    <div class="row">
        @if($has_input)
            <div class="col-md-12 form-group">
                <div class="pull-left">
                    <input type="file" multiple name="{{$inputName}}" class="form-control-file" />
                </div>
            </div>
        @endif
    @foreach($fileInstances as $key => $fileInstance)
        <div class="col-md-{{$columns}}">
            <br>
            <div class="form-group">
                <div class="pull-left">
                    <button data-file_instance="{{json_encode($fileInstance)}}" data-input_name="{{$inputName}}" data-delete_url="{{route('attachment.delete', $fileInstance->id)}}" type="button" onclick="removeFile(this)" class="btn btn-danger">{{trans('actions.remove')}}</button>
                </div>
            </div>
            <br>
            <div class="form-control-file">
                <img style="height: 400px; width: 100%;" src="{{asset('assets/'.$fileInstance->file)}}" alt="" class="img-rounded fluid-img">
            </div>
            @if($has_input)
                <div class="form-check form-check-inline">
                    <input id="attachment-top" {{$fileInstance->position == "top" ? 'checked' : ''}} type="radio" onclick="changeAttachmentPosition('{{route('attachment.change_position', $fileInstance->id)}}', this)" value="top" class="form-check-input" />
                    <label for="attachment-top"  class="form-check-label"> {{trans('forms.top')}}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input id="attachment-bottom" type="radio" {{$fileInstance->position == "bottom" ? 'checked' : ''}} onclick="changeAttachmentPosition('{{route('attachment.change_position', $fileInstance->id)}}', this)" value="bottom" class="form-check-input" />
                    <label for="attachment-bottom" class="form-check-label"> {{trans('forms.bottom')}}</label>
                </div>
            @endif
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
