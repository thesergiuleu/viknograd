@extends('layouts.admin')

@section('title', trans('actions.pages-title.static_content.edit'))

@section('scripts')
    @parent
    <script src="{{ asset('assets/js/plugins/file_manager.js') }}"></script>
@stop
@section('content')
    <main class="main-container">
        <form method="post" action="{{route('static_content.update', ['id' => $item->id])}}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT"/>
            <input type="hidden" name="page_block" value="{{$page_block}}">

            <div class="form-group required">
                <label for="exampleInputName">{{trans('forms.static_content.title')}}</label>
                <input type="text" name="title" class="form-control" value="{{$item->title}}" required>
                @if ($errors->has('title'))
                    <div class="has-error">
                         <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    </div>

                @endif
            </div>
            <div class="form-group required">
                <label for="exampleInputDescription">{{trans('forms.static_content.description')}}</label>
                @component('admin.form_elements.text_area_editor', [
                                    'editorName' => 'description',
                                    'editorId' => 'description'
                                    ])
                    {{$item->description}}
                @endcomponent
                @if ($errors->has('description'))
                    <div class="has-error">
                         <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    </div>
                @endif
            </div>

            <div class="form-group required">
                <label for="exampleInputAlias">{{trans('forms.static_content.alias')}}</label>
                <input type="text" readonly name="alias" class="form-control" id="exampleInputAlias" value="{{$item->alias}}">
                @if ($errors->has('alias'))
                    <div class="has-error">
                         <span class="help-block">
                            <strong>{{ $errors->first('alias') }}</strong>
                        </span>
                    </div>
                @endif
            </div>


            <div class="form-group">
                <label for="exampleInputPosition">{{trans('forms.static_content.group_by')}}</label>
                <select name="group_by" class="form-control">
                    @foreach ($groupBy as $key => $type)
                        <option value="{{$type}}"  {{($type === $item->group_by ? 'selected':'')}}>
                            {{$type}}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="checkbox">
                <label>
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" {{($item->is_active ? 'checked': '')}} value="1"> {{trans('forms.static_content.active')}}
                </label>
            </div>
            <div class="form-group clearfix">
                <div class="pull-right">
                    <a href="{{route('static_content')}}" class="btn btn-default">{{trans('actions.cancel')}}</a>
                    <button type="submit" class="btn btn-primary">{{trans('static_content.save')}}</button>
                </div>
            </div>
        </form>
    </main>
@endsection
