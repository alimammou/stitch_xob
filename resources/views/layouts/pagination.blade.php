@if ($paginator->hasPages())
    <div class="divPaginationMain">
        <div class="divPM">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <div class="divPMArrow dPMALeft"><a class="btn btnPMA" class="btn btn-primary" type="button"href="?page=1"><i class="fa fa-angle-double-left"></i></a><a class="btn btnPMA" class="btn btn-primary" type="button"><i class="fa fa-angle-left"></i></a></div>
            @else
                <div class="divPMArrow dPMALeft"><a class="btn btnPMA" class="btn btn-primary" type="button"href="?page=1"><i class="fa fa-angle-double-left"></i></a><a class="btn btnPMA" class="btn btn-primary" type="button"href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a></div>
            @endif
            <div class="divPMNumbers">
            {{-- Pagination Elements --}}

            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a  ><span>{{ $element }}</span></a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                                <a class="btn btnPMN bPMNActive" class="btn btn-primary" >{{ $page }}</a>
                        @else
                                <a class="btn btnPMN " class="btn btn-primary" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            </div>
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <div class="divPMArrow dPMARight"><a class="btn btnPMA"  class="btn btn-primary" href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a><a  class="btn btnPMA" href="{{end($elements[0])}}"><i class="fa fa-angle-double-right"></i></a></div>
            @else
            <div class="divPMArrow dPMARight"><a class="btn btnPMA"  class="btn btn-primary">   <i class="fa fa-angle-right"></i></a><a   class="btn btnPMA" class="btn btn-primary" href="{{end($elements[0])}}"><i class="fa fa-angle-double-right"></i></a></div>
            @endif
        </div>
        </div>
@endif
