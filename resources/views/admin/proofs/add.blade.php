@extends('layouts.admin')

@section('title', trans('actions.pages-title.proof.add'))

@section('content')
    <main class="main-container">
        <form method="post" action="{{route('proof.store')}}">
            {{ csrf_field() }}
            <div class="form-group required">
                <label for="exampleInputName">{{trans('forms.proof.title')}}</label>
                <input type="text" name="title" class="form-control" required>
                @if ($errors->has('title'))
                    <div class="has-error">
                         <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    </div>

                @endif
            </div>
            <div class="form-group">
                <label>{{trans('forms.proof.body')}}</label>
                <textarea type="text" name="body" class="form-control"></textarea>
                @if ($errors->has('body'))
                    <div class="has-error">
                 <span class="help-block">
                    <strong>{{ $errors->first('body') }}</strong>
                </span>
                    </div>

                @endif
            </div>
            <div class="form-group clearfix">
                <div class="pull-right">
                    <a href="{{route('proof')}}" class="btn btn-default">{{trans('actions.cancel')}}</a>
                    <button type="submit" class="btn btn-primary">{{trans('actions.save')}}</button>
                </div>
            </div>
        </form>
    </main>
@endsection
