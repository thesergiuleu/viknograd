@extends('layouts.admin')

@section('title', trans('actions.pages-title.proof.list'))

@section('content')
    @component('admin.common.grid', [
    'items' => $items,
    'gridData'=> $gridData,
    'route' => 'proof'
    ])

    @endcomponent
@endsection
