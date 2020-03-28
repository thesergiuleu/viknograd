@extends('layouts.admin')

@section('title', trans('actions.pages-title.static_content.list'))

@section('content')
    @component('admin.common.grid', [
    'items' => $items,
    'gridData'=> $gridData,
    'route' => 'static_content'
    ])

    @endcomponent
@endsection
