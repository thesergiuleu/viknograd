@extends('layouts.admin')

@section('title', trans('actions.pages-title.criteria.add'))

@section('content')
    <main class="main-container">
        <form method="post" action="{{route('criteria.store')}}">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group required">
                        <label for="exampleInputName">{{trans('forms.criteria.title')}}</label>
                        <input type="text" name="title" class="form-control" required>
                        @if ($errors->has('title'))
                            <div class="has-error">
                         <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                            </div>

                        @endif
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label>{{trans('forms.criteria.supper_criterias')}}</label>
                        <select name="supper_criteria_id" class="form-control">
                            @foreach ($supper_criterias as $key => $supper_criteria)
                                <option value="{{$key}}" {{(old('supper_criteria_id') === $key ? 'selected' : '')}}>
                                    {{$supper_criteria}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="eventStatus">{{trans('forms.criteria.is_active')}}</label>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" {{old('active') == 1 ? 'checked' : ''}}> {{trans('forms.criteria.is_active')}}
                        </label>
                    </div>
                </div>
            </div>
            {{ csrf_field() }}

            <div class="form-group required">
                <label>{{trans('forms.criteria.description')}}</label>
                <textarea type="text" name="description" class="form-control"></textarea>
                @if ($errors->has('description'))
                    <div class="has-error">
                 <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
                    </div>

                @endif
            </div>
            <div class="form-group clearfix">
                <div class="pull-right">
                    <a href="{{route('criteria')}}" class="btn btn-default">{{trans('actions.cancel')}}</a>
                    <button type="submit" class="btn btn-primary">{{trans('actions.save')}}</button>
                </div>
            </div>
        </form>
    </main>
@endsection
