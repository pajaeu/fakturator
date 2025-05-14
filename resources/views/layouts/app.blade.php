@extends('layouts.base')

@section('body')
    @include('layouts.components.header')
    <main class="py-6">
        <x-container>{{ $slot }}</x-container>
    </main>
    @include('layouts.components.footer')
@endsection