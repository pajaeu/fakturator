@extends('layouts.base')

@section('body')
    @include('layouts.components.header')
    @persist('notifications')
        <livewire:notifications/>
    @endpersist
    <main class="py-6">
        <x-container>{{ $slot }}</x-container>
    </main>
    @include('layouts.components.footer')
@endsection