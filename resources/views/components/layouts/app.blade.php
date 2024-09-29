<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>
    @livewireStyles
    @vite(['resources/js/app.js'])
    @vite('resources/css/app.css')

</head>
<body>
    @auth
    @livewire('layout.navigation')
    @endauth

    {{$slot}}
@livewireScripts
</body>
</html>



