@if(isset($gridData['sort']) && in_array($column, $gridData['sort']['columns']))
    <a href="{{route($route)}}?orderColumn={{$column}}&sortedOrder={{getSortByState($gridData['sort'], $column)}}">
        {{trans('grid.'.$gridData['entity'].'.'.$column)}}
        <i class="glyphicon glyphicon-{{getSortCssClassState($gridData['sort'], $column)}}"></i>
    </a>
@else
    {{ trans('grid.'.$gridData['entity'].'.'.$column) }}
@endif