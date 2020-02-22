<section class="clearfix form-group">

    @if(isset($showSearch) && $showSearch)
        <div class="pull">
            <form class="form-inline" method="get" action="{{route($route)}}" >
                @if(count($filterAttributes) > 0)
                    @foreach($filterAttributes as $key => $filterAttribute)
                        @component('admin.form_elements.select_input', ['filterAttributes' => $filterAttribute, 'index' => $key]) @endcomponent
                    @endforeach
                @endif
                <div class="form-group">
                    <input type="text" class="form-control" id="inputsearch" name="search"
                           value="{{request()->input('search')}}"
                           placeholder="{{trans('forms.search_placeholder')}}">
                </div>
                @foreach(request()->all() as $key => $value)
                    @if($key !== 'search')
                        @if(is_array($value))
                            @foreach($value as $filter)
                                <input name="{{$key}}[]" type="hidden" value="{{$filter}}"/>
                            @endforeach
                        @else
                            <input name="{{$key}}" type="hidden" value="{{$value}}" placeholder="Search for"/>
                        @endif
                    @endif
                @endforeach
                <button type="reset" class="btn btn-danger" onclick="resetForm('{{route($route)}}')">{{trans('actions.reset')}}</button>
                <button type="submit" class="btn btn-default">{{trans('actions.search')}}</button>

            </form>
        </div>
    @endif
</section>
