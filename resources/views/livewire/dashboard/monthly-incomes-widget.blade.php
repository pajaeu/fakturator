<x-card>
    <div class="flex mb-4 items-center">
        <h2 class="text-lg font-semibold">{{ __('Monthly overview') }}</h2>
        <x-button wire:click="resetData" variant="outline-gray" class="ms-auto">
            <x-icons.refresh class="size-5 text-blue-600"/>
            <span>{{ __('Recalculate statistics') }}</span>
        </x-button>
    </div>
    <div class="relative h-[350px]">
        <div wire:loading.remove>
            <x-dashboard.monthly-incomes-chart/>
        </div>
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2" wire:loading>
            <x-icons.loader class="size-6 text-blue-600 animate-spin"/>
        </div>
    </div>
    <p class="text-end text-sm text-gray-400">{{ __('statistics are being calculated each hour') }}</p>
</x-card>