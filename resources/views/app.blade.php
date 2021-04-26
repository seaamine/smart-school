<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet" type="text/css">
        <link href="https://unpkg.com/primevue/resources/themes/saga-blue/theme.css" rel="stylesheet">
        <link href="https://unpkg.com/primevue/resources/primevue.min.css" rel="stylesheet">
        <link href="https://unpkg.com/primeicons/primeicons.css" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">

    </head>
    <body class="font-sans antialiased">

    <!-- Scripts -->
    @routes
    <script src="{{ asset(mix('js/app.js')) }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.prod.js" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/quasar@2.0.0-beta.12/dist/quasar.umd.prod.js" defer></script>
        @inertia
    </body>
</html>
