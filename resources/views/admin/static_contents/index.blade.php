@extends('layouts.admin')

@section('title', trans('actions.pages-title.static_content.list'))

@section('content')
    <div class="col-md-12">
        <form method="POST" action="{{route('static_content.attachment')}}" enctype="multipart/form-data">
            <div class="form-group required">
                @component('admin.form_elements.simple_file_input', [
                     'fileInstances' =>  $attachments->isNotEmpty() ? $attachments : false,
                     'inputName' => "attachments",
                     'has_input' => false,
                     'columns'   => 12
                     ])
                @endcomponent
            </div>
            @if($attachments->isEmpty())
                <div class="form-group clearfix">
                    <div class="pull-left">
                        <button type="submit" class="btn btn-primary">{{trans('actions.save')}}</button>
                    </div>
                </div>
            @endif
        </form>
    </div>

    <hr>
    @component('admin.common.grid', [
    'items' => $items,
    'gridData'=> $gridData,
    'route' => 'static_content'
    ])

    @endcomponent

@endsection
