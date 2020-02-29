<header class="container app-header">
    @component('common.menu', ['pages' => $pages, 'active' => $activeRoute])
    @endcomponent
        <div class="add-new">
            <a href="{{route('logout')}}" class="btn btn-danger">
                {{trans('actions.logout')}}
            </a>
            @if(isset($addNewRoute) && $addNewRoute != '')
                @authorize
                    <a href="{{route($addNewRoute, $page_block)}}" class="btn btn-primary">
                        {{trans('actions.add')}}
                    </a>
                @endauthorize
            @endif
        </div>

</header>
