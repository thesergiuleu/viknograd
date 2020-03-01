@extends('layouts.admin')

@section('title', trans('actions.pages-title.page.list'))

@section('content')
    @if($items->isNotEmpty())
        <table style="width: 100%">
            <tr>
                @foreach ($items as $key => $item)
                    <td valign="top">
                        <table  class="datatable table table-striped table-bordered table-hover">
                            <tr>
                                <thead>
                                <th>
                                    <span class="pull-right">
                                            <a href="{{route('page.delete', ['id' => $item->page->id ])}}"
                                               onclick="deleteItem(event, this, 'page', false)" title="Hide item">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </a>
                                        </span>
                                    {{$item->page ? $item->page->name : ''}}
                                    @if(array_key_exists('actionsDisplay', $gridData)
                                        && isset($gridData['actionsDisplay']['edit'])
                                        && $gridData['actionsDisplay']['edit']
                                        )
                                        <span class="pull-right">
                                            <a href="{{route('page.edit', ['id' => $item->page->id , 'page_block' => $item->page->page_block])}}">
                                                <i class="glyphicon glyphicon-edit"></i>
                                            </a>
                                        </span>
                                    @endif
                                </th>
                                <ul id="page_div_{{$item->id}}" class="page-div list-group">

                                </ul>
                                </thead>
                            </tr>
                            <tbody id="sortable">
                            @foreach($item->children as $child)
                                <tr>
                                    <td style="position: relative">
                                            <span>
                                                {{$child->page->name}}
                                            </span>
                                        <span class="pull-right">
                                            <a href="{{route('page.delete', ['id' => $item->page->id ])}}"
                                               onclick="deleteItem(event, this, 'page', false)" title="Hide item">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </a>
                                        </span>
                                        @if(array_key_exists('actionsDisplay', $gridData)
                                            && isset($gridData['actionsDisplay']['edit'])
                                            && $gridData['actionsDisplay']['edit']
                                            )
                                            <span class="pull-right">
                                                <a href="{{route('page.edit', ['id' => $child->page->id , 'page_block' => $child->page->page_block])}}">
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                </a>
                                            </span>
                                        @endif
                                    </td>
                                    <ul id="page_div_{{$item->id}}" class="page-div list-group">

                                    </ul>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </td>
                @endforeach
            </tr>
        </table>
    @endif
@endsection
