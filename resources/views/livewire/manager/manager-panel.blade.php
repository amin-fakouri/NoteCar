@php use Illuminate\Support\Facades\URL; @endphp

<div class="p-5">

    {{-- هدر --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                {{ __('پنل مدیریت') }}
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                {{ __('مدیریت نمایشگاه و کارمندان') }}
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('ad_dash') }}"
               wire:navigate
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white dark:bg-gray-800
                      text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-700
                      hover:bg-gray-100 dark:hover:bg-gray-700 transition text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                {{ __('خانه') }}
            </a>
        </div>
    </div>

    {{-- کارت‌های خلاصه --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">

        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-100 dark:border-gray-700 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('تعداد کارمندان') }}</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">
                        {{ $employees->count() }}
                    </p>
                </div>
                <div class="w-10 h-10 rounded-full bg-teal-50 dark:bg-teal-900/30 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person text-teal-600 h-5 w-5" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-100 dark:border-gray-700 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('تعداد خودروها') }}</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">
                        {{ $cars->count() }}
                    </p>
                </div>
                <div class="w-10 h-10 rounded-full bg-teal-50 dark:bg-teal-900/30 flex items-center justify-center">
                    <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 17h8m-8 0a2 2 0 11-4 0 2 2 0 014 0zm8 0a2 2 0 104 0 2 2 0 00-4 0zM3 13l1.5-5A2 2 0 016.4 6.5h11.2a2 2 0 011.9 1.5L21 13v4H3v-4z" />
                    </svg>
                </div>
            </div>
        </div>

    </div>

    {{-- اکشن‌ها --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-100 dark:border-gray-700 shadow-sm">
        <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-4">
            {{ __('اقدامات سریع') }}
        </h2>

        <div class="flex flex-wrap gap-3">
            {{-- افزودن کارمند جدید --}}
            <a href="{{ URL::signedRoute('create-employee') }}"
               wire:navigate
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-teal-500 hover:bg-teal-600
          text-white text-sm font-medium transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('اضافه کردن کارمند جدید') }}
            </a>

            {{-- لیست ماشین‌های حذف‌شده --}}
            <a href="{{ URL::signedRoute('del-cars-lst') }}"
               wire:navigate
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-slate-100 hover:bg-slate-200
          text-slate-700 text-sm font-medium transition dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                </svg>
                {{ __('لیست ماشین های حذف شده') }}
            </a>
        </div>
    </div>

</div>
