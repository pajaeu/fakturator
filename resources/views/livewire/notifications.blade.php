<div class="fixed top-0 left-1/2 -translate-x-1/2 z-30 mt-3 flex flex-col gap-y-2">
    @foreach($notifications as $notification)
        <div wire-key="{{ $notification->id }}" x-data="{ closed: false }" x-show="!closed"
             x-init="setTimeout(function() {
                closed = true;

                $wire.call('removeNotification', '{{ $notification->id }}')
             }, 3000)"
             x-transition:leave="ease-in duration-300"
             x-transition:leave-start="opacity-100 sm:scale-100"
             x-transition:leave-end="opacity-0 sm:scale-95"
             class="w-max min-w-46 py-2.5 px-2 flex items-center gap-2 font-medium text-xs text-white {{ $notification->color() }} rounded-lg shadow">
            @if($notification->icon())
                <x-dynamic-component :component="$notification->icon()" class="size-4"/>
            @endif
            <span>{{ $notification->message }}</span>
        </div>
    @endforeach
</div>