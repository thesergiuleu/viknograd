@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Админ панель</div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

                Вы зашли за  <a href="{{route('logout')}}"> {{auth()->user()->name}}!</a>
        </div>
    </div>

@endsection
