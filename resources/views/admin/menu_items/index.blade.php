@extends('layouts.admin')

@section('title', trans('actions.pages-title.proof.list'))

@section('content')
    @if($items->isNotEmpty())
        <table style="width: 100%">
            <tr>
               @foreach ($items as $key => $item)
                    <td valign="top">
                        <table  class="datatable table table-striped table-bordered table-hover">
                            <tr>
                                <thead>
                                    <th>{{$item->page ? $item->page->name : ''}}
                                        <span class="pull-right">
                                             <a href="javascript:void(0)" onclick="changeParent(this)">
                                                    <i class="glyphicon glyphicon-edit"></i>
                                             </a>
                                        </span>
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
                                                <a href="javascript:void(0)" onclick="changeParent(this)">
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                </a>
                                            </span>
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
