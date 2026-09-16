<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl"
      data-theme="silk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src=""></script>
    <title>{{__('ثبت نام')}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4">--}}

</head>
<body>
<form>
    @csrf
</form>
</body>
</html>
