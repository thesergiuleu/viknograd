@extends('layouts.admin')

@section('title', trans('actions.pages-title.review.add'))

@section('content')
    <main class="main-container">
        <form method="post" action="{{route('review.store')}}">
            {{ csrf_field() }}
            <div class="form-group required">
                <label>{{trans('forms.review.media_title')}}</label>
                <input type="text" name="media[title]" class="form-control">
                @if ($errors->has('media.title'))
                    <div class="has-error">
                        <span class="help-block">
                            <strong>{{ $errors->first('media.title') }}</strong>
                        </span>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-11">
                    <div class="form-group required">
                        <label for="exampleInputName">{{trans('forms.review.media_url')}}</label>
                        <input type="text" name="media[url]" class="form-control" required>
                        @if ($errors->has('media.url'))
                            <div class="has-error">
                         <span class="help-block">
                            <strong>{{ $errors->first('media.url') }}</strong>
                        </span>
                            </div>

                        @endif
                    </div>
                </div>
                <div class="col-md-1">
                    <label for="eventStatus">{{trans('forms.review.is_active')}}</label>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="review[is_active]" value="0">
                            <input type="checkbox" name="review[is_active]" value="1" {{old('active') == 1 ? 'checked' : ''}}> {{trans('forms.criteria.is_active')}}
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group required">
                <label>{{trans('forms.review.description')}}</label>
                <textarea type="text" name="media[description]" class="form-control"></textarea>
                @if ($errors->has('media.description'))
                    <div class="has-error">
                        <span class="help-block">
                            <strong>{{ $errors->first('media.description') }}</strong>
                        </span>
                    </div>
                @endif
            </div>
            <h3>{{trans('forms.review.criterias')}}</h3>
            <div class="row">
                @if (empty($criterias))
                    <div class="form-group">
                        <label class="form-control" >No criteria found</label>
                    </div>
                @else
                @foreach ($criterias as $item)
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="form-control" for="criteria-check-{{$item->id}}">{{$item->title}}</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="checkbox">
                            <input id="criteria-check-{{$item->id}}" type="checkbox" name="criterias[]" value="{{$item->id}}" {{old('criteria_id') == $item->id ? 'checked' : ''}}>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
            <h3>{{trans('forms.review.proofs')}}</h3>
            <div class="row" id="proof-div">

            </div>
            <div class="form-group clearfix">
                <div class="pull-left">
                    <button type="button" onclick="addReviewSection('proofs')" class="btn btn-primary">{{trans('actions.add')}}</button>
                </div>
            </div>
            <h3>{{trans('forms.review.naratives')}}</h3>
            <div class="row" id="narative-div">

            </div>
            <div class="form-group clearfix">
                <div class="pull-left">
                    <button type="button" onclick="addReviewSection('naratives')" class="btn btn-primary">{{trans('actions.add')}}</button>
                </div>
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
