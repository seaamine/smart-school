<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">
        <link href="https://unpkg.com/primevue@2.4.1/resources/themes/saga-blue/theme.css" rel="stylesheet" type="text/css">
        <link href="https://unpkg.com/primevue@2.4.1/resources/primevue.min.css" rel="stylesheet" type="text/css">
        <link href="https://unpkg.com/primeicons@4.1.0/primeicons.css" rel="stylesheet" type="text/css">

    </head>
    <body class="bg-gray-100 font-sans antialiased">

    <!-- Scripts -->
    @routes
    <script src="{{ asset(mix('js/app.js')) }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.prod.js" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/quasar@2.0.0-beta.12/dist/quasar.umd.prod.js" defer></script>
        @inertia
    </body>
</html>
