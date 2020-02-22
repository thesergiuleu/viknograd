@extends('layouts.admin')

@section('title', trans('actions.pages-title.narative.list'))

@section('content')
    @component('admin.common.grid', [
    'items' => $items,
    'gridData'=> $gridData,
    'route' => 'narative'
    ])

    @endcomponent
@endsection
