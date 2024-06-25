<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Flashcard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link type="image/png" sizes="16x16" rel="icon" href="/favicon.png">
</head>
<body>
<div id="app" class="w-full mx-auto bg-gray-100 min-h-screen"></div>
@vite('resources/js/app.js')
</body>
</html>
