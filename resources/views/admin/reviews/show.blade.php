@extends('layouts.admin')

@section('title', trans('actions.pages-title.review.show'))

@section('content')
    <main class="main-container">
        <form method="post" action="{{route('review.update', $item->id)}}">
            <input type="hidden" name="_method" value="PUT"/>
            {{ csrf_field() }}
            <div class="form-group required">
                <label>{{trans('forms.review.media_title')}}</label>
                <div class="form-control">{{$item->media->title}}</div>
            </div>
            <div class="row">
                <div class="col-md-11">
                    <div class="form-group required">
                        <label for="exampleInputName">{{trans('forms.review.media_url')}}</label>
                        <div class="form-control">{{$item->media->url}}</div>
                    </div>
                </div>
                <div class="col-md-1">
                    <label for="eventStatus">{{trans('forms.review.is_active')}}</label>
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="review[is_active]" value="0">
                            <input type="checkbox" name="review[is_active]" disabled value="1" {{$item->is_active == 1 ? 'checked' : ''}}> {{trans('forms.criteria.is_active')}}
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group required">
                <label>{{trans('forms.review.description')}}</label>
                <div class="form-control">{{$item->media->description}}</div>
            </div>
            <h3>{{trans('forms.review.criterias')}}</h3>
            <div class="row">
                @foreach ($criterias as $criteria)
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="form-control" for="criteria-check-{{$criteria->id}}">{{$criteria->title}}</label>
                        </div>
                    </div>
                    {{--<div class="col-md-1">--}}
                        {{--<div class="checkbox">--}}
                            {{--<input id="criteria-check-{{$criteria->id}}" type="checkbox" name="criterias[]" value="{{$criteria->id}}" {{in_array($criteria->id, $checked_criterias) ? 'checked' : ''}}>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                @endforeach
            </div>
            <h3>{{trans('forms.review.proofs')}}</h3>
            <div class="row" id="proof-div">
                @foreach($item->proofs as $key => $proof)
                    <div class="col-md-12">
                        <div class="my-card">
                            <input type="hidden" name="proofs[{{$key}}][id]" value="{{$proof->id}}">
                            <div class="form-group required">
                                <label>{{trans('forms.review.proof_title')}} </label>
                                <input type="text" name="proofs[{{$key}}][title]" value="{{$proof->title}}" class="form-control card-body" disabled>
                            </div>
                            <div class="form-group required">
                                <label>{{trans('forms.review.proof_body')}}</label>
                                <textarea type="text" name="proofs[{{$key}}][body]" class="form-control" disabled>{{$proof->body}}</textarea>
                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            </div>
            {{--<div class="form-group clearfix">--}}
                {{--<div class="pull-left">--}}
                    {{--<button type="button" onclick="addReviewSection('proofs')" class="btn btn-primary">{{trans('actions.add')}}</button>--}}
                {{--</div>--}}
            {{--</div>--}}
            <h3>{{trans('forms.review.naratives')}}</h3>
            <div class="row" id="narative-div">
                @foreach($item->naratives as $key => $narative)
                    <div class="col-md-12">
                        <div class="my-card">
                            <input type="hidden" name="naratives[{{$key}}][id]" value="{{$narative->id}}">
                            <div class="form-group required">
                                <label for="exampleInputName">{{trans('forms.review.narative_title')}}</label>
                                <input type="text" name="naratives[{{$key}}][title]" value="{{$narative->title}}" class="form-control" disabled>
                            </div>
                            <div class="form-group required">
                                <label>{{trans('forms.review.narative_body')}}</label>
                                <textarea type="text" name="naratives[{{$key}}][body]" class="form-control" disabled>{{$narative->body}}</textarea>
                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            </div>
            {{--<div class="form-group clearfix">--}}
                {{--<div class="pull-left">--}}
                    {{--<button type="button" onclick="addReviewSection('naratives')" class="btn btn-primary">{{trans('actions.add')}}</button>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="form-group clearfix">--}}
                {{--<div class="pull-right">--}}
                    {{--<a href="{{route('criteria')}}" class="btn btn-default">{{trans('actions.cancel')}}</a>--}}
                    {{--<button type="submit" class="btn btn-primary">{{trans('actions.save')}}</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        </form>
    </main>
@endsection
