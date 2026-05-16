@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between mt-3">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination pagination-sm">
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">« Anterior</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">« Anterior</a>
                    </li>
                @endif

                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Siguiente »</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Siguiente »</span>
                    </li>
                @endif
            </ul>
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted">
                    Mostrando <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    al <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    de <span class="fw-semibold">{{ $paginator->total() }}</span> resultados
                </p>
            </div>

            <div>
                <ul class="pagination pagination-sm">
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">« Anterior</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">« Anterior</a>
                        </li>
                    @endif

                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Siguiente »</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Siguiente »</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif