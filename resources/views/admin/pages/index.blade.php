@extends('layouts.admin')

@section('title', trans('actions.pages-title.page.list'))

@section('content')
    @if($items->isNotEmpty())
        <div style="display: flex">
        @foreach($items as $key => $item)
            <ul data-url="{{route('change_menu_position')}}" style="flex: 1 1 auto!important" id="{{$item->id}}" class="connectedSortable list-group">
                <li id="{{$item->id}}" class="list-group-item">
                    @if(array_key_exists('actionsDisplay', $gridData)
                        && isset($gridData['actionsDisplay']['edit'])
                        && $gridData['actionsDisplay']['edit']
                        )
                        @if($item->page->page_block && in_array($item->page->page_block, \App\Page::PAGE_BLOCKS))
                            <a href="{{$item->page->url()}}">
                                {{$item->page ? $item->page->name : ''}}
                            </a>
                        @else
                            <a href="{{route('page.edit', ['id' => $item->page->id , 'page_block' => $item->page->page_block])}}">
                                {{$item->page ? $item->page->name : ''}}
                            </a>
                        @endif
                    @else
                        {{$item->page ? $item->page->name : ''}}
                    @endif
                </li>
                @foreach($item->children as $k => $child)
                    <li id="{{$child->id}}" class="list-group-item">
                        <span class="pull-right">
                                            <a href="{{route('page.delete', ['id' => $child->page->id ])}}"
                                               onclick="deleteItem(event, this, 'page', false)" title="Удалить">
                                                <i class="glyphicon glyphicon-remove"></i>
                                            </a>
                                        </span>
                        @if(array_key_exists('actionsDisplay', $gridData)
                        && isset($gridData['actionsDisplay']['edit'])
                        && $gridData['actionsDisplay']['edit']
                        )
                            @if($child->page->page_block && in_array($child->page->page_block, \App\Page::PAGE_BLOCKS))
                                <a href="{{$child->page->url()}}">
                                    {{$child->page ? $child->page->name : ''}}
                                </a>
                            @else
                                <a href="{{route('page.edit', ['id' => $child->page->id , 'page_block' => $child->page->page_block])}}">
                                    {{$child->page ? $child->page->name : ''}}
                                </a>
                            @endif
                        @else
                            {{$child->page ? $child->page->name : ''}}
                        @endif
                    </li>
                @endforeach
            </ul>
        @endforeach
        </div>
    @endif
@endsection
