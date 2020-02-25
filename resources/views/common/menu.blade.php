@isset($pages)
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="clearfix">
                <div class="pull-left">
                    <button type="button" class="navbar-toggle collapsed"
                            data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1"
                            aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    @foreach ($pages as $page)
                        <li class="{{$active === $page['ext'] || checkMenuIsActive($page, $active, 'children', 'ext') ? 'active':''}}">
                            @if (isset($page['children']))
                                <a href="#" class="dropdown-toggle"
                                   data-toggle="dropdown"
                                   role="button"
                                   aria-haspopup="true"
                                   aria-expanded="false">{{$page['title']}} <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    @foreach ($page['children'] as $child)
                                        <li class="{{$active === $child['ext'] ? 'active':''}}">
                                            <a href="{{route($child['ext'])}}">{{$child['title']}}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            @else
                                <a href="{{route($page['ext'], $page['id'])}}">{{$page['title']}}</a>
                            @endif
                        </li>
                    @endforeach

                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
@endisset
