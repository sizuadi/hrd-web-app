<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'HRD System' }}</title>
    @livewireStyles
    @include('livewire.layouts.styles')
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <div id="app">
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
    @livewireScripts
</body>

</html>
