@extends('layouts.admin')

@section('title', trans('actions.pages-title.page.edit'))

@section('content')
    <main class="main-container">
        <form method="post" action="{{route("$entity.update", $item->id)}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="page_block" value="{{$page_block}}">
            <input type="hidden" name="_method" value="PUT"/>

            <div class="row" id="inline-block-div">
                <div class="col-md-12">
                    <div class="my-card">
                        <div class="form-group required ">
                            <label for="exampleInputName">{{trans("forms.$entity.name")}}</label>
                            <input type="text" name="name" class="form-control" value="{{$item->name}}" required>
                        </div>
                        <div class="form-group required">
                            <label>{{trans("forms.$entity.body")}}</label>
                            @component('admin.form_elements.text_area_editor', [
                                    'editorName' => "body",
                                    'editorId' => 'body'
                                    ])
                                {{$item->body}}
                            @endcomponent
                        </div>
                    </div>
                    <br>
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
