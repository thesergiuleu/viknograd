@if ($fileInstances)
    <div class="row">
    @foreach($fileInstances as $fileInstance)
        <div class="col-md-4">
            <div class="form-group">
                <div class="pull-left">
                    <button type="submit" class="btn btn-danger">{{trans('actions.remove')}}</button>
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
