<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{__('جست و جو')}}</title>
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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-100 text-gray-900 antialiased dark:bg-gray-900">
{{ $slot }}
</body>
</html>
