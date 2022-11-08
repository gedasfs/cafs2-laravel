<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/sass/app.scss'])

    <title>{{config('app.name')}}</title>
</head>
<body>
    <div class="container mt-4">
        <div id="shop"></div>
    </div>

    @vite(['resources/js/vue/app.js'])
</body>
</html>
