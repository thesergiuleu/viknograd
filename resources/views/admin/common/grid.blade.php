@component('common.search_input', ['showSearch' => $gridData['showSearch'],'route' => $route,'filterAttributes' => $gridData['filterAttributes'] ])

@endcomponent

<div class="table-responsive">
    <table class="table table-striped table-hover table-condensed">
        <thead class="thead-dark">
        <tr>
            @foreach($gridData['columns'] as $column)
                <th>
                    @component('common.sort_tmpl', [
                    'gridData' => $gridData,
                    'column' => (is_array($column) ? $column['original_field'] : $column),
                    'route' => $route])
                    @endcomponent
                </th>
            @endforeach
            @if(array_key_exists('actionsDisplay', $gridData))
                <th>
                    {{trans('grid.actions')}}
                </th>
            @endif
</tr>
</thead>

<tbody>
@foreach($items as $item)
<tr>
    @foreach($gridData['columns'] as $column)
        <td>
            {!! mapGridColumn($item, $column) !!}
        </td>
    @endforeach
    <td class="actions">
        @if(array_key_exists('actionsDisplay', $gridData)
        && isset($gridData['actionsDisplay']['edit'])
        && $gridData['actionsDisplay']['edit']
        )

                <a href="{{route($route.'.edit', ['id' => $item->id ])}}">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>

        @endif

        @if(array_key_exists('actionsDisplay', $gridData)
        && isset($gridData['actionsDisplay']['translate'])
        && $gridData['actionsDisplay']['translate'])
            <a href="{{route('translation.add', ['id' => $item->id, 'entity' => $gridData['entity'] ])}}"
               title="Add translation">
                <i class="glyphicon glyphicon-text-size"></i>
            </a>
        @endif

        @if(array_key_exists('actionsDisplay', $gridData)
        && isset($gridData['actionsDisplay']['info'])
        && $gridData['actionsDisplay']['info'])
                <a href="{{route($route.'.show', ['id' => $item->id ])}}">
                    <i class="glyphicon glyphicon-info-sign"></i>
                </a>
        @endif


        @if(array_key_exists('actionsDisplay', $gridData)
        && isset($gridData['actionsDisplay']['delete'])
        && $gridData['actionsDisplay']['delete'])
            @authorize
                <a href="{{route($route.'.delete', ['id' => $item->id ])}}"
                onclick="" title="Hide item">
                    <i class="glyphicon glyphicon-remove"></i>
                </a>
            @endauthorize
        @endif

        @if(array_key_exists('actionsDisplay', $gridData)
        && isset($gridData['actionsDisplay']['preview'])
        && $gridData['actionsDisplay']['preview'])
            <a href="#"
               data-url="{{route($route.'.preview', ['id' => $item->id ])}}"
               data-toggle="modal"
               data-target="#modal">
                <i class="glyphicon glyphicon-eye-open"></i>
            </a>
        @endif

    </td>
</tr>
@endforeach
@if($items->count() === 0)
<tr class="no-items">
    <td colspan="{{count($gridData['columns']) + 1}}">No items found</td>
</tr>
@endif
</tbody>

<tfoot>
<tr>
<td colspan="{{count($gridData['columns'])+1}}">
    {{ $items->appends(attachQueryParamsToPagination())->links() }}
</td>
</tr>
</tfoot>
</table>
</div>
