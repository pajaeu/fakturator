<div class="fixed top-0 right-0 z-30 mt-3 mr-3 flex flex-col items-end gap-y-4">
    @foreach($notifications as $notification)
        <div wire-key="{{ $notification->id }}" x-data="{ closed: false }" x-show="!closed"
             x-init="setTimeout(function() {
                closed = true;

                $wire.call('removeNotification', '{{ $notification->id }}')
             }, 3000)"
             x-transition:leave="ease-in duration-300"
             x-transition:leave-start="opacity-100 sm:scale-100"
             x-transition:leave-end="opacity-0 sm:scale-95"
             class="w-max min-w-64 py-3 px-4 flex items-center gap-3 font-medium text-gray-800 rounded-lg border border-gray-200 shadow bg-white">
            @if($notification->icon())
                <x-dynamic-component :component="$notification->icon()" class="size-5 {{ $notification->color() }}"/>
            @endif
            <span>{{ $notification->message }}</span>
        </div>
    @endforeach
</div>