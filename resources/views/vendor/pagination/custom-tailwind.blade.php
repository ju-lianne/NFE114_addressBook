@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center my-4">
        <ul class="inline-flex items-center space-x-1">
            {{-- Afficher la première page et les ellipses si nécessaire --}}
            @if ($paginator->currentPage() > 3)
                <li>
                    <a href="#" wire:click.prevent="gotoPage(1)" class="px-2 text-gray-700">
                        1
                    </a>
                </li>
                <li>
                    <span class="px-2 text-gray-500">…</span>
                </li>
            @endif

            @php
                $start = max($paginator->currentPage() - 2, 1);
                $end   = min($paginator->currentPage() + 2, $paginator->lastPage());
            @endphp

            {{-- Affichage des pages centrales --}}
            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $paginator->currentPage())
                    <li>
                        <span class="px-2 font-bold text-blue-600">
                            {{ $page }}
                        </span>
                    </li>
                @else
                    <li>
                        <a href="#" wire:click.prevent="gotoPage({{ $page }})" class="px-2 text-gray-700">
                            {{ $page }}
                        </a>
                    </li>
                @endif
            @endfor

            {{-- Affichage de la dernière page et ellipses si nécessaire --}}
            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                <li>
                    <span class="px-2 text-gray-500">…</span>
                </li>
                <li>
                    <a href="#" wire:click.prevent="gotoPage({{ $paginator->lastPage() }})" class="px-2 text-gray-700">
                        {{ $paginator->lastPage() }}
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
