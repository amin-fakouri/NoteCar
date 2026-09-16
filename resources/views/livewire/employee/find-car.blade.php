@php
    $images = $find_n_car->images ?? [];
        $imageUrls = collect($images)->map(fn($img) => route('car.image', basename($img)))->toArray();
@endphp

<div
    x-data="{
        darkMode: document.documentElement.classList.contains('dark'),
        toggleTheme() {
            this.darkMode = !this.darkMode;
            document.documentElement.classList.toggle('dark', this.darkMode);
            localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
        },
        selectedImage: 0,
        lightbox: false
    }"
    class="min-h-screen bg-gray-100 dark:bg-gray-900 transition-colors"
>
    <style>
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #06b6d4; border-radius: 999px; transition: background .2s ease; }
        ::-webkit-scrollbar-thumb:hover { background: #0891b2; }
        .dark ::-webkit-scrollbar-thumb { background: #22d3ee; }
        .dark ::-webkit-scrollbar-thumb:hover { background: #06b6d4; }
        * { scrollbar-width: thin; scrollbar-color: #06b6d4 transparent; }
        .dark * { scrollbar-color: #22d3ee transparent; }
    </style>

    {{-- ================= نوار بالای صفحه (فقط برگشت + تم، بدون هدر واقعی) ================= --}}
    <div class="flex items-center justify-between px-4 sm:px-8 py-4 max-w-5xl mx-auto">
        <a href="{{ \Illuminate\Support\Facades\URL::signedRoute('ad_dash') }}"
           class="text-teal-600 dark:text-teal-400 hover:underline text-sm font-medium inline-flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg>
            {{__('برگشت به نتایج')}}
        </a>
    </div>

    {{-- ================= کارت محصول ================= --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-8 pb-12">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2 gap-0 transition-colors">

            {{-- ---------- گالری عکس ---------- --}}
            <div class="p-4 sm:p-6">
                @if(collect($find_n_car)->isNotEmpty())
<div class="relative rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-700 aspect-square cursor-zoom-in"
     @click="lightbox = true">
    <template x-for="(imgUrl, i) in {{ json_encode($imageUrls) }}" :key="i">
        <img x-show="selectedImage === i"
             :src="imgUrl"
             class="w-full h-full object-cover">
    </template>
</div>

                    @if(count($images) > 0)
         <div class="flex gap-2 mt-3 overflow-x-auto pb-1">
        @foreach($images as $index => $image)
            <button type="button"
                    @click="selectedImage = {{ $index }}"
                    class="shrink-0 w-16 h-16 rounded-lg overflow-hidden border-2 transition-all"
                    :class="selectedImage === {{ $index }} ? 'border-teal-500' : 'border-transparent opacity-70 hover:opacity-100'">
                <img src="{{ route('car.image', basename($image)) }}"
                     class="w-full h-full object-cover">
            </button>
        @endforeach
    </div>
                    @endif
                @else
                    <div class="rounded-xl bg-gray-100 dark:bg-gray-700 aspect-square flex items-center justify-center">
                        <span class="text-gray-400 dark:text-gray-500 text-sm">{{__('عکسی ثبت نشده است')}}</span>
                    </div>
                @endif
            </div>

            {{-- ---------- اطلاعات محصول ---------- --}}
            <div class="p-4 sm:p-6 flex flex-col text-right border-t md:border-t-0 md:border-r border-gray-100 dark:border-gray-700">
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $find_n_car->car_name }}</h1>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ $find_n_car->model }} • {{ $find_n_car->color }}</p>
                    </div>
                    @if(isset($find_n_car->situation_mode))
                        <span class="shrink-0 px-3 py-1 rounded-full text-xs font-medium
                            {{ $find_n_car->situation_mode == __('فروخته شده') ? 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300' : 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300' }}">
                            {{ $find_n_car->situation_mode }}
                        </span>
                    @endif
                </div>

                {{-- ---------- قیمت + کارکرد، کنار هم و برجسته (دو فاکتور اصلی تصمیم خریدار) ---------- --}}
                <div class="mt-4 flex items-end justify-between flex-wrap gap-2">
                    <div>
                        <span class="text-3xl font-extrabold text-teal-600 dark:text-teal-400">
                            {{ number_format($find_n_car->price_car, 0) }}
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400 mr-1">{{__('تومان')}}</span>
                    </div>

                    <div class="inline-flex items-center gap-1.5 bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                             class="text-gray-500 dark:text-gray-400" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m0-1A7 7 0 1 1 8 1a7 7 0 0 1 0 14"/>
                        </svg>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ $find_n_car->mileage ? number_format($find_n_car->mileage, 0) . ' ' . __('کیلومتر') : __('کارکرد ثبت نشده') }}
                        </span>
                    </div>
                </div>

                <hr class="my-4 border-gray-100 dark:border-gray-700">

                {{-- ---------- مشخصات فنی، به شکل گرید مثل صفحه محصول فروشگاهی ---------- --}}
                <div class="grid grid-cols-2 gap-y-3 text-sm">
                    <div>
                        <span class="text-gray-400 dark:text-gray-500 block text-xs">{{__('کارکرد')}}</span>
                        <span class="text-gray-900 dark:text-white font-medium">
                            {{ $find_n_car->mileage ? number_format($find_n_car->mileage, 0) . ' ' . __('کیلومتر') : __('ثبت نشده') }}
                        </span>
                    </div>
                    <div>
                        <span class="text-gray-400 dark:text-gray-500 block text-xs">{{__('شماره پلاک')}}</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ $find_n_car->plat_number }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 dark:text-gray-500 block text-xs">{{__('شماره شاستی')}}</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ $find_n_car->identification_number }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 dark:text-gray-500 block text-xs">{{__('نوع سوخت')}}</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ $find_n_car->car_fuel_type }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 dark:text-gray-500 block text-xs">{{__('گیربوکس')}}</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ $find_n_car->gearbox_type }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 dark:text-gray-500 block text-xs">{{__('نوع دنده')}}</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ $find_n_car->gear_type }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 dark:text-gray-500 block text-xs">{{__('سیلندر')}}</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ $find_n_car->cylinder_type }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 dark:text-gray-500 block text-xs">{{__('شماره قول‌نامه')}}</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ $find_n_car->promise_number }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 dark:text-gray-500 block text-xs">{{__('تاریخ ثبت')}}</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ $find_n_car->created_post }}</span>
                    </div>
                </div>

                <hr class="my-4 border-gray-100 dark:border-gray-700">

                {{-- ---------- اطلاعات فروشنده/خریدار و سود/ضرر ---------- --}}
                <div class="grid grid-cols-2 gap-y-3 text-sm">
                    <div>
                        <span class="text-gray-400 dark:text-gray-500 block text-xs">{{__('فروشنده')}}</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ $find_n_car->seller }}</span>
                        <span class="text-gray-500 dark:text-gray-400 block text-xs">{{ $find_n_car->mobile_seller }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 dark:text-gray-500 block text-xs">{{__('خریدار')}}</span>
                        <span class="text-gray-900 dark:text-white font-medium">{{ $find_n_car->buyer ?: '—' }}</span>
                        <span class="text-gray-500 dark:text-gray-400 block text-xs">{{ $find_n_car->mobile_buyer }}</span>
                    </div>
{{--                    <div>--}}
{{--                        <span class="text-gray-400 dark:text-gray-500 block text-xs">{{__('سود')}}</span>--}}
{{--                        <span class="text-green-600 dark:text-green-400 font-medium">{{ $find_n_car->profit }}</span>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <span class="text-gray-400 dark:text-gray-500 block text-xs">{{__('ضرر')}}</span>--}}
{{--                        <span class="text-red-600 dark:text-red-400 font-medium">{{ $find_n_car->loss }}</span>--}}
{{--                    </div>--}}
                </div>

                @if($find_n_car->description)
                    <hr class="my-4 border-gray-100 dark:border-gray-700">
                    <div>
                        <span class="text-gray-400 dark:text-gray-500 block text-xs mb-1">{{__('توضیحات')}}</span>
                        <p class="text-gray-700 dark:text-gray-300 text-sm whitespace-pre-line">{{ $find_n_car->description }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ================= لایت‌باکس نمایش تمام‌صفحه عکس ================= --}}
    <div x-show="lightbox" x-cloak
         @click="lightbox = false"
         @keydown.escape.window="lightbox = false"
         class="fixed inset-0 bg-black/85 z-50 flex items-center justify-center p-4">
        <button type="button" @click="lightbox = false"
                class="absolute top-4 left-4 text-white/80 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
            </svg>
        </button>

        @if(collect($find_n_car)->isNotEmpty())
<template x-for="(imgUrl, i) in {{ json_encode($imageUrls) }}" :key="i">
    <img x-show="selectedImage === i"
         :src="imgUrl"
         class="w-full h-full object-cover">
</template>
        @endif
    </div>
</div>
