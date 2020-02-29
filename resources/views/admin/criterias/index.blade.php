@extends('layouts.admin')

@section('title', trans('actions.pages-title.criteria.list'))

@section('content')
    @component('admin.common.grid', [
    'items' => $items,
    'gridData'=> $gridData,
    'route' => 'criteria'
    ])

    @endcomponent
@endsection
