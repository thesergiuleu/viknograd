@extends('layouts.admin')

@section('title', trans('actions.pages-title.criteria.show'))

@section('content')
    <main class="main-container">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group required">
                    <label for="exampleInputName">{{trans('forms.criteria.title')}}</label>
                    <div class="form-control">{{$item->title}}</div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>{{trans('forms.criteria.supper_criterias')}}</label>
                    <div class="form-control">{{$item->supper_criteria}}</div>
                </div>
            </div>
            <div class="col-md-2">
                <label for="eventStatus">{{trans('forms.criteria.is_active')}}</label>
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="is_active" value="0">
                        <input disabled type="checkbox" name="is_active" value="1" {{$item->is_active == 1 ? 'checked' : ''}}> {{trans('forms.criteria.is_active')}}
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group required">
            <label>{{trans('forms.criteria.description')}}</label>
            <div class="form-control">{{$item->description}}</div>
        </div>
    </main>
@endsection
