@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-between p-0.25">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-500 bg-white border border-zinc-300 cursor-default leading-5 focus:outline-none rounded-md dark:text-zinc-600 dark:bg-zinc-800 dark:border-zinc-600">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:navigate
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 leading-5 rounded-md hover:text-zinc-500 focus:outline-none focus:ring ring-zinc-300 focus:border-orange-300 active:bg-zinc-100 active:text-zinc-700 transition ease-in-out duration-150 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-300 dark:focus:border-orange-700 dark:active:bg-zinc-700 dark:active:text-zinc-300">
                {!! __('pagination.previous') !!}
            </button>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:navigate
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 leading-5 rounded-md hover:text-zinc-500 focus:outline-none focus:ring ring-zinc-300 focus:border-orange-300 active:bg-zinc-100 active:text-zinc-700 transition ease-in-out duration-150 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-300 dark:focus:border-orange-700 dark:active:bg-zinc-700 dark:active:text-zinc-300">
                {!! __('pagination.next') !!}
            </button>
        @else
            <span
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-500 bg-white border border-zinc-300 cursor-default leading-5 rounded-md focus:outline-none dark:text-zinc-600 dark:bg-zinc-800 dark:border-zinc-600">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
