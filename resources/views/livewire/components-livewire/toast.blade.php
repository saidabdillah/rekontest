<div id="toast-default" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
    class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800 absolute top-10 right-10"
    role="alert">
    <div
        class="inline-flex items-center justify-center shrink-0 w-8 h-8 {{ $type == 'success' ? 'bg-green-100 text-green-500' : 'bg-red-100 text-red-500' }} rounded-lg {{ $type == 'success' ? 'dark:bg-green-800 dark:text-green-200' : 'dark:bg-red-800 dark:text-red-200' }}">
        @switch($type)
        @case('success')
        <flux:icon.check />
        @break

        @case('error')
        <flux:icon.x-mark />
        @break

        @endswitch
    </div>
    <div class="ms-3 text-sm font-normal">{{ $message }}</div>
</div>