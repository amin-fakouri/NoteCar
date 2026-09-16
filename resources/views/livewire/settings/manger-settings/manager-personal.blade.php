<div class="max-w-lg mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 transition-colors">

    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">
        {{ __('اطلاعات حساب کاربری') }}
    </h2>

    {{-- ================= آلرت موفقیت ================= --}}
    @if (session()->has('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 4000)"
            class="mb-4 flex items-start gap-2 rounded-lg border border-green-300 bg-green-50 p-3 text-sm text-green-700
                   dark:border-green-700 dark:bg-green-900/40 dark:text-green-300 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="shrink-0 mt-0.5">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
            <span class="flex-1">{{ session('success') }}</span>
            <button type="button" @click="show = false" class="text-green-600 hover:text-green-800 dark:text-green-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </button>
        </div>
    @endif

    {{-- ================= آلرت خطا (خطای عمومی/سرور، جدا از خطاهای زیر هر فیلد) ================= --}}
    @if (session()->has('error'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 5000)"
            class="mb-4 flex items-start gap-2 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-700
                   dark:border-red-700 dark:bg-red-900/40 dark:text-red-300 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="shrink-0 mt-0.5">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
            </svg>
            <span class="flex-1">{{ session('error') }}</span>
            <button type="button" @click="show = false" class="text-red-600 hover:text-red-800 dark:text-red-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </button>
        </div>
    @endif

    {{-- ================= آلرت خطاهای اعتبارسنجی (اگر خطاهایی هست که به فیلد خاصی مربوط نمی‌شن) ================= --}}
    @if ($errors->any() && !$errors->has(['phone_number', 'password', 'password_confirmation']))
        <div class="mb-4 flex items-start gap-2 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-700
                     dark:border-red-700 dark:bg-red-900/40 dark:text-red-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="shrink-0 mt-0.5">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
            </svg>
            <span>{{ __('لطفاً خطاهای فرم را بررسی کنید.') }}</span>
        </div>
    @endif

    <form wire:submit="updateProfile" class="space-y-5">
        @csrf

        {{-- شماره تماس --}}
        <div>
            <label for="phone_number" class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('شماره تماس') }}
            </label>
            <input
                id="phone_number"
                type="text"
                inputmode="numeric"
                wire:model.live="phone_number"
                placeholder="{{ __('شماره تماس') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5
                       placeholder-gray-400 transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500">
            @error('phone_number')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- رمز عبور جدید --}}
        <div>
            <label for="password" class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('رمز عبور جدید') }}
            </label>
            <input
                id="password"
                type="password"
                autocomplete="new-password"
                wire:model.live="password"
                placeholder="{{ __('در صورت عدم تغییر خالی بگذارید') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5
                       placeholder-gray-400 transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500">
            @error('password')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- تکرار رمز عبور --}}
        <div>
            <label for="password_confirmation" class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('تکرار رمز عبور') }}
            </label>
            <input
                id="password_confirmation"
                type="password"
                autocomplete="new-password"
                wire:model.live="password_confirmation"
                placeholder="{{ __('تکرار رمز عبور جدید') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5
                       placeholder-gray-400 transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500">
            @error('password_confirmation')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- دکمه ذخیره --}}
        <button type="submit"
                wire:loading.attr="disabled"
                wire:target="updateProfile"
                class="w-full sm:w-auto text-white bg-teal-500 hover:bg-teal-600 focus:ring-4 focus:outline-none
                       focus:ring-teal-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                       inline-flex items-center justify-center gap-2 disabled:opacity-60
                       dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800 transition-all">
            <span wire:loading.remove wire:target="updateProfile">{{ __('ذخیره تغییرات') }}</span>
            <span wire:loading wire:target="updateProfile">{{ __('در حال ذخیره...') }}</span>
        </button>
        <hr>
        <a href="{{ route('ad_dash') }}"
           class="text-white mt-2 bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800 transition-all">
            {{__('برگشت')}}
        </a>
    </form>
</div>
