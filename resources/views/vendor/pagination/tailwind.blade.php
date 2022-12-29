@if ($paginator->hasPages())
<div class="row">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
            Mostrando
            @if ($paginator->firstItem())
                {{ $paginator->firstItem() }}
                até
                {{ $paginator->lastItem() }}
            @else
                {{ $paginator->count() }}
            @endif
            de
            {{ $paginator->total() }}
            resultados
        </div>
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            <ul class="pagination">
                @php
                $disabled = "";
                if ($paginator->onFirstPage()) {
                    $disabled = "disabled";
                }
                @endphp
                <li class="paginate_button page-item previous {{ $disabled }}" id="example2_previous">
                    <a href="{{ $paginator->previousPageUrl() }}" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Página Anterior</a>
                </li>

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="paginate_button page-item ">
                            <a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">{{ $element }}</a>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="paginate_button page-item active">
                                    <a href="#" aria-controls="example2" data-dt-idx="{{ $page }}" tabindex="{{ $i }}" class="page-link">{{ $page }}</a>
                                </li>
                            @else
                                <li class="paginate_button page-item ">
                                    <a href="{{ $url }}" aria-controls="example2" data-dt-idx="{{ $page }}" tabindex="{{ $i }}" class="page-link">{{ $page }}</a>
                                </li>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    @endif
                @endforeach

                @php
                    $disabled = "disabled";
                    if ($paginator->hasMorePages()) {
                    $disabled = "";
                    }
                @endphp
                <li class="paginate_button page-item next {{ $disabled }}" id="example2_next">
                    <a href="{{ $paginator->nextPageUrl() }}" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Próxima Página</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endif

