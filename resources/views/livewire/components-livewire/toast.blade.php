<div id="toast-default" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
    class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800 absolute top-10 right-10"
    role="alert">
    <div
        class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <flux:icon.check />
    </div>
    <div class="ms-3 text-sm font-normal">{{ $message }}</div>
</div>