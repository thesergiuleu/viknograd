@extends('layouts.admin')

@section('title', trans('actions.pages-title.page.add'))

@section('content')
    <main class="main-container">
        <form method="post" action="{{route($entity . '.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="page_block" value="{{$page_block}}">
            <div class="form-group required">
                <label>{{trans("forms.$entity.name")}}</label>
                <input type="text" name="name" class="form-control">
                @if ($errors->has('name'))
                    <div class="has-error">
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputName">{{trans("forms.$entity.page_header")}}</label>
                        <input type="text" name="page_header" class="form-control">
                        @if ($errors->has('page_header'))
                            <div class="has-error">
                         <span class="help-block">
                            <strong>{{ $errors->first('page_header') }}</strong>
                        </span>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputName">{{trans("forms.$entity.created_at")}}</label>
                        <input type="date" name="created_at" class="form-control">
                        @if ($errors->has('created_at'))
                            <div class="has-error">
                         <span class="help-block">
                            <strong>{{ $errors->first('created_at') }}</strong>
                        </span>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label for="exampleInputLogo">{{trans("forms.$entity.thumbnail")}}</label>
                <div id="file-container">
                    @component('admin.form_elements.simple_file_input', [
                     'fileInstances' =>  false,
                     'inputName' => 'thumbnail',
                     'has_input' => true,
                     'columns' => 4
                     ])

                    @endcomponent
                </div>
            </div>
            <div class="form-group required">
                <label for="exampleInputDescription">{{trans("forms.$entity.body")}}</label>
                @component('admin.form_elements.text_area_editor', [
                                    'editorName' => 'body',
                                    'editorId' => 'body'
                                    ])
                    {{old('body')}}
                @endcomponent
                @if ($errors->has('body'))
                    <div class="has-error">
                 <span class="help-block">
                    <strong>{{ $errors->first('body') }}</strong>
                </span>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="exampleInputLogo">{{trans("forms.$entity.attachments")}}</label>
                <div id="file-container">
                    @component('admin.form_elements.simple_file_input', [
                     'fileInstances' =>  false,
                     'inputName' => 'attachments[]',
                     'has_input' => true,
                     'columns' => 4
                     ])

                    @endcomponent
                </div>
            </div>
            <h3>{{trans("forms.$entity.videos")}}</h3>
            <div class="row" id="video-div">

            </div>
            <div class="form-group clearfix">
                <div class="pull-left">
                    <button type="button" onclick="addSection('videos', false)" class="btn btn-primary">{{trans('actions.add')}}</button>
                </div>
            </div>
            <hr>
            <h3>{{trans("forms.$entity.inline_blocks")}}</h3>
            <div class="row" id="inline-block-div">

            </div>
            <div class="form-group clearfix">
                <div class="pull-left">
                    <button type="button" onclick="addSection('inline_blocks')" class="btn btn-primary">{{trans('actions.add')}}</button>
                </div>
            </div>
            <div class="form-group clearfix">
                <div class="pull-right">
                    <a href="{{route($entity)}}" class="btn btn-default">{{trans('actions.cancel')}}</a>
                    <button type="submit" class="btn btn-primary">{{trans('actions.save')}}</button>
                </div>
            </div>
        </form>
    </main>
@endsection
