@extends('layouts.admin')

@section('title', trans('actions.pages-title.page.list'))

@section('content')
    @component('admin.common.grid', [
    'items' => $items,
    'gridData'=> $gridData,
    'route' => 'contact'
    ])

    @endcomponent
@endsection
