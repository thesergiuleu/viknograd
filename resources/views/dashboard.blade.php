@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            You are <a href="{{route('logout')}}">logged in as {{auth()->user()->name}}!</a>
        </div>
    </div>

@endsection
