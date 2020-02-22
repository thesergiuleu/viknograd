@if (count($errors->toArray()) > 0)
    @foreach($errors->toArray() as $errorKey => $message)
        @if(str_contains($errorKey, $inputName))
            <div class="has-error">
                <span class="help-block">
                        <strong>{{$message[0]}}</strong>
                    </span>
            </div>
        @endif
        @break
    @endforeach
@endif