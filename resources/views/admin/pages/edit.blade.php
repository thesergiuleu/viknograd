@extends('layouts.admin')

@section('title', trans('actions.pages-title.page.edit'))

@section('content')
    <main class="main-container">
        <form method="post" action="{{route($entity . '.update', $item->id)}}" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT"/>
            <input type="hidden" name="page_block" value="{{$page_block}}">
            {{ csrf_field() }}
            <div class="form-group required">
                <label>{{trans("forms.$entity.name")}}</label>
                <input type="text" name="name" class="form-control" required value="{{$item->name}}">
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
                    <div class="form-group required">
                        <label for="exampleInputName">{{trans("forms.$entity.page_header")}}</label>
                        <input type="text" name="page_header" class="form-control" value="{{$item->page_header}}">
                        @if ($errors->has('page_header'))
                            <div class="has-error">
                         <span class="help-block">
                            <strong>{{ $errors->first('page_header') }}</strong>
                        </span>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group required">
                <label for="exampleInputDescription">{{trans("forms.$entity.body")}}</label>
                @component('admin.form_elements.text_area_editor', [
                                    'editorName' => 'body',
                                    'editorId' => 'body'
                                    ])
                    {{$item->body}}
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
                     'fileInstances' =>  $item->attachments->isNotEmpty() ? $item->attachments : false,
                     'inputName' => 'attachments[]',
                     'has_input' => true,
                     ])

                    @endcomponent
                </div>
            </div>
            <h3>{{trans("forms.$entity.videos")}}</h3>
            <div class="row" id="video-div">
                @foreach($item->videos as $key => $video)
                    <div class="col-md-12" data-counter="{{$key}}videos">
                        <div class="my-card">
                            <input type="hidden" value="{{$video->id}}" name="videos[{{$key}}][id]">
                            <div class="form-group required ">
                                <span style="color: #3097d1; cursor: pointer" data-data="videos" data-id="{{$key}}" onclick="removeReviewSection(this)" class="pull-right"><i class="glyphicon glyphicon-remove"></i></span>
                                <label for="exampleInputName">URL</label>
                                <input type="text" name="videos[{{$key}}][url]" value="{{$video->url}}" class="form-control" required>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="video-top" {{$video->position == "top" ? 'checked' : ''}} type="radio" value="top" name="videos[{{$key}}][position]" class="form-check-input" />
                                <label for="video-top"  class="form-check-label"> Position Top</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="video-bottom" type="radio" {{$video->position == "bottom" ? 'checked' : ''}} value="bottom" name="videos[{{$key}}][position]" class="form-check-input" />
                                <label for="video-bottom" class="form-check-label"> Position Bottom</label>
                            </div>
                        </div>
                        <br>
                    </div>

                @endforeach
            </div>
            <div class="form-group clearfix">
                <div class="pull-left">
                    <button type="button" onclick="addSection('videos', false)" class="btn btn-primary">{{trans('actions.add')}}</button>
                </div>
            </div>
            <hr>
            <h3>{{trans("forms.$entity.inline_blocks")}}</h3>
            <div class="row" id="inline-block-div">
                @foreach($item->inline_blocks as $key => $inlineBlock)
                    <div class="col-md-12" data-counter="{{$key}}inline_blocks">
                        <div class="my-card">
                            <input type="hidden" value="{{$inlineBlock->id}}" name="inline_blocks[{{$key}}][id]">
                            <div class="form-group required ">
                                <span style="color: #3097d1; cursor: pointer" data-data="inline_blocks" data-id="{{$key}}" onclick="removeReviewSection(this)" class="pull-right"><i class="glyphicon glyphicon-remove"></i></span>
                                <label for="exampleInputName">Title</label>
                                <input type="text" name="inline_blocks[{{$key}}][name]" class="form-control" value="{{$inlineBlock->name}}" required>
                                </div>
                            <div class="form-group required">
                                <label>Body</label>
                                @component('admin.form_elements.text_area_editor', [
                                        'editorName' => "inline_blocks[$key][body]",
                                        'editorId' => 'body_'.$key
                                        ])
                                    {{$inlineBlock->body}}
                                @endcomponent
                                </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input class="form-control" type="text" name="inline_blocks[{{$key}}][url]" value="{{$inlineBlock->url}}">
                            </div>
                            <div class="form-group required">
                                @component('admin.form_elements.simple_file_input', [
                                     'fileInstances' =>  $inlineBlock->attachments->isNotEmpty() ? $inlineBlock->attachments : false,
                                     'inputName' => "inline_blocks[$key][attachments]",
                                     'has_input' => false,
                                     ])
                                @endcomponent
                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
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
