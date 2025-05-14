@extends('layouts.base')

@section('body')
    <div class="w-screen h-screen flex justify-center items-center">
        <div class="w-full max-w-[295px]">
            <div class="mb-7">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="mx-auto h-5">
            </div>
            <div>{{ $slot }}</div>
        </div>
    </div>
@endsection