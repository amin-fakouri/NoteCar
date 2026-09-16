<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl"
      data-theme="silk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('MoltiStylist|مولتی استایلیست')}}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* اسکرول‌بار مدرن با پشتیبانی از حالت تاریک/روشن */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #06b6d4;
            border-radius: 999px;
            transition: background 0.2s ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #0891b2;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #22d3ee;
        }

        .dark ::-webkit-scrollbar-thumb:hover {
            background: #06b6d4;
        }

        /* پشتیبانی از فایرفاکس (که از webkit-scrollbar پشتیبانی نمی‌کنه) */
        * {
            scrollbar-width: thin;
            scrollbar-color: #06b6d4 transparent;
        }

        .dark * {
            scrollbar-color: #22d3ee transparent;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
{{ $slot }}
</body>
</html>

