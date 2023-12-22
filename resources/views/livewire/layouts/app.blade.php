<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HRD System - {{ $title ?? 'Atomic Indonesia' }}</title>
    @livewireStyles
    @include('livewire.layouts.styles')
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <div id="app">
        <div style="position: fixed; top: 0; bottom: 0; left: 0; right: 0; background: #000; z-index: 99999; height: 100%; width: 100%; opacity: 0.7;"
            wire:loading>
            <div class="justify-content-center align-items-center d-flex" style="height: 100%;">
                <img src="{{ asset('assets/compiled/svg/oval.svg') }}" class="me-4" style="width: 3rem" alt="audio">
            </div>
        </div>
        <div id="sidebar">
            <livewire:layouts.sidebar />
        </div>
        <div id="main" class='layout-navbar navbar-fixed'>
            <livewire:layouts.header />
            {{ $slot }}
            <livewire:layouts.footer />
        </div>
    </div>
    @include('livewire.layouts.scripts')
    @livewireScriptConfig
</body>

</html>
