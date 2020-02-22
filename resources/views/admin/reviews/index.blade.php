@extends('layouts.admin')

@section('title', trans('actions.pages-title.review.list'))

@section('content')
    @component('admin.common.grid', [
    'items' => $items,
    'gridData'=> $gridData,
    'route' => 'review'
    ])

    @endcomponent
@endsection
