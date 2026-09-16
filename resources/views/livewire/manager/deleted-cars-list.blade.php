<div class="max-w-4xl mx-auto p-6">

    {{-- هدر --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                {{ __('موارد حذف‌شده') }}
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                {{ __('رکوردهایی که توسط کارمندان حذف شده‌اند') }}
            </p>
        </div>

        <a href="{{ route('ad_dash') }}"
           wire:navigate
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white dark:bg-gray-800
                  text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-700
                  hover:bg-gray-100 dark:hover:bg-gray-700 transition text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            {{ __('بازگشت') }}
        </a>
    </div>

    {{-- پیام موفقیت --}}
    @if (session('message'))
        <div class="mb-4 flex items-center gap-2 p-3 rounded-lg bg-teal-50 text-teal-700 dark:bg-teal-900/20 dark:text-teal-400 text-sm">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('message') }}
        </div>
    @endif

    {{-- جدول --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
        <table class="w-full text-sm text-right">
            <thead class="bg-gray-50 dark:bg-gray-900/40 text-gray-500 dark:text-gray-400">
            <tr>
                <th class="px-4 py-3 font-medium">{{ __('نام خودرو') }}</th>
                <th class="px-4 py-3 font-medium">{{ __('حذف‌شده توسط') }}</th>
                <th class="px-4 py-3 font-medium">{{ __('تاریخ حذف') }}</th>
                <th class="px-4 py-3 font-medium text-left">{{ __('عملیات') }}</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            @forelse ($deletedCars as $car)
                <tr class="text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-900/30 transition-colors">
                    <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-100">
                        {{ $car->name }}
                    </td>
                    <td class="px-4 py-3">
                            <span class="inline-flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-300 dark:bg-gray-600"></span>
                                {{ $car->deleter->phone_number ?? __('نامشخص') }}
                            </span>
                    </td>
                    <td class="px-4 py-3 text-gray-500 dark:text-gray-400">
                        {{ $car->deleted_at->format('Y/m/d H:i') }}
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-start gap-2">
                            <button wire:click="restore({{ $car->id }})"
                                    wire:confirm="{{ __('آیا مطمئنید می‌خواهید این رکورد را بازگردانید؟') }}"
                                    wire:loading.attr="disabled"
                                    wire:target="restore({{ $car->id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg
                                               text-teal-600 bg-teal-50 hover:bg-teal-100
                                               dark:text-teal-400 dark:bg-teal-900/20 dark:hover:bg-teal-900/40
                                               text-xs font-medium transition disabled:opacity-50">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                {{ __('بازگردانی') }}
                            </button>

                            <button wire:click="forceDelete({{ $car->id }})"
                                    wire:confirm="{{ __('این عملیات غیرقابل بازگشت است. ادامه می‌دهید؟') }}"
                                    wire:loading.attr="disabled"
                                    wire:target="forceDelete({{ $car->id }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg
                                               text-red-600 bg-red-50 hover:bg-red-100
                                               dark:text-red-400 dark:bg-red-900/20 dark:hover:bg-red-900/40
                                               text-xs font-medium transition disabled:opacity-50">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                {{ __('حذف کامل') }}
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-12 text-center">
                        <div class="flex flex-col items-center gap-2 text-gray-400 dark:text-gray-500">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span class="text-sm">{{ __('موردی برای نمایش وجود ندارد') }}</span>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- صفحه‌بندی --}}
    <div class="mt-4">
        {{ $deletedCars->links() }}
    </div>

</div>
