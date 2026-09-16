<div x-data="{ showPassword: false }">

{{--    <x-auth-session-status class="mb-4" :status="session('status')"/>--}}


{{--    @error('all_alert')--}}
{{--    <div--}}
{{--        x-data="{ show: true }"--}}
{{--        x-show="show"--}}
{{--        x-init="setTimeout(() => show = false, 5000)"--}}
{{--        class="mb-4 flex items-start gap-2 rounded-lg border border-red-300 bg-red-50 p-3 text-sm text-red-700--}}
{{--                   dark:border-red-700 dark:bg-red-900/40 dark:text-red-300 transition-all">--}}
{{--        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="shrink-0 mt-0.5">--}}
{{--            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>--}}
{{--            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>--}}
{{--        </svg>--}}
{{--        <span class="flex-1">{{ $message }}</span>--}}
{{--        <button type="button" @click="show = false" class="text-red-600 hover:text-red-800 dark:text-red-400">--}}
{{--            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">--}}
{{--                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>--}}
{{--            </svg>--}}
{{--        </button>--}}
{{--    </div>--}}
{{--    @enderror--}}


{{--    <div class="flex items-center justify-between mb-4">--}}
{{--        <h1 class="text-2xl font-bold dark:text-white">{{ __('ورود به سیستم') }}</h1>--}}
{{--    </div>--}}

{{--    <br>--}}
{{--    <hr>--}}
{{--    <br>--}}

{{--    <form wire:submit="login">--}}
{{--        <!-- Phone Number -->--}}
{{--        <div class="relative">--}}
{{--            <label for="phone_number"--}}
{{--                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('شماره تماس') }}</label>--}}
{{--            <input type="tel" required autofocus autocomplete="phone_number" wire:model="phone_number"--}}
{{--                   id="phone_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5--}}
{{--                       placeholder-gray-400 transition-all duration-200--}}
{{--                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none--}}
{{--                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white--}}
{{--                       dark:focus:ring-teal-500 dark:focus:border-teal-500"--}}
{{--                   placeholder="{{ __('شماره تماس') }}"--}}
{{--                   name="phone_number">--}}
{{--            <x-input-error :messages="$errors->get('form.phone_number')" class="mt-2"/>--}}
{{--            @error('phone_number')--}}
{{--            <span class="text-red-500 text-sm">{{ $message }}</span>--}}
{{--            @enderror--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4 relative">--}}
{{--            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('رمز عبور') }}</label>--}}

{{--            <div class="relative">--}}
{{--                <input wire:model="password"--}}
{{--                       :type="showPassword ? 'text' : 'password'"--}}
{{--                       name="password"--}}
{{--                       required autocomplete="current-password" id="inp_password"--}}
{{--                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 pl-10--}}
{{--                       placeholder-gray-400 transition-all duration-200--}}
{{--                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none--}}
{{--                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white--}}
{{--                       dark:focus:ring-teal-500 dark:focus:border-teal-500"--}}
{{--                       placeholder="{{ __('••••••••') }}">--}}

{{--                --}}{{-- دکمه تاگل نمایش رمز عبور --}}
{{--                <button type="button"--}}
{{--                        @click="showPassword = !showPassword"--}}
{{--                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">--}}
{{--                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>--}}
{{--                    </svg>--}}
{{--                    <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"--}}
{{--                         viewBox="0 0 24 24">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 012.132-3.411m3.35-2.987A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.957 9.957 0 01-1.563 3.029M3 3l18 18"/>--}}
{{--                    </svg>--}}
{{--                </button>--}}

{{--                @error('password')--}}
{{--                <span class="text-red-500 text-sm absolute p-0.5">{{ $message }}</span>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Remember Me -->--}}
{{--        <div class="block mt-7">--}}
{{--            <label for="remember" class="inline-flex items-center cursor-pointer">--}}
{{--                <input type="checkbox" wire:model="remember" id="remember"--}}
{{--                       class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-teal-600 shadow-sm--}}
{{--                              focus:ring-teal-500 dark:focus:ring-teal-600 dark:focus:ring-offset-gray-800 transition-all"--}}
{{--                       name="remember">--}}
{{--                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('به‌خاطر بسپار') }}</span>--}}
{{--            </label>--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <x-primary-button>--}}
{{--                <div wire:loading class="mr-2">--}}
{{--                    <svg aria-hidden="true" role="status"--}}
{{--                         class="inline w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101"--}}
{{--                         fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <path--}}
{{--                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"--}}
{{--                            fill="currentColor"/>--}}
{{--                        <path--}}
{{--                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"--}}
{{--                            fill="#000000FF"/>--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--                {{ __('ورود به سیستم') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}





    <x-auth-session-status class="mb-4" :status="session('status')"/>


    @error('all_alert')
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
        <span class="flex-1">{{ $message }}</span>
        <button type="button" @click="show = false" class="text-red-600 hover:text-red-800 dark:text-red-400">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
            </svg>
        </button>
    </div>
    @enderror


    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold dark:text-white">{{ __('ورود به سیستم') }}</h1>
    </div>

    <br>
    <hr>
    <br>

    <div class="mt-4 flex items-center gap-2" x-data="{ quickFillRole: '' }">
        <select x-model="quickFillRole"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5
                   focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                   dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <option value="">{{ __('انتخاب کاربر تست') }}</option>
            <option value="admin">{{ __('مدیر') }}</option>
            <option value="employee">{{ __('کارمند') }}</option>
        </select>

        <button type="button"
                @click="
                if (quickFillRole === 'admin') {
                    $wire.set('phone_number', '09111111111');
                    $wire.set('password', '12345678');
                } else if (quickFillRole === 'employee') {
                    $wire.set('phone_number', '09222222222');
                    $wire.set('password', '12345678');
                }
            "
                class="px-4 py-2.5 rounded-lg bg-slate-200 hover:bg-slate-300 text-slate-700 text-sm font-medium
                   dark:bg-slate-700 dark:hover:bg-slate-600 dark:text-slate-200 transition">
            {{ __('ثبت') }}
        </button>
    </div>

    <form wire:submit="login">
        @csrf
        <!-- Phone Number -->
        <div class="relative">
            <label for="phone_number"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('شماره تماس') }}</label>
            <input type="tel" required autofocus autocomplete="phone_number" wire:model="phone_number"
                   id="phone_number" class="bg-gray-50 text-center border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5
                       placeholder-gray-400 transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500"
                   placeholder="{{ __('شماره تماس') }}"
                   name="phone_number">
            <x-input-error :messages="$errors->get('form.phone_number')" class="mt-2"/>
            @error('phone_number')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('رمز عبور') }}</label>

            <div class="relative">
                <input wire:model="password"
                       :type="showPassword ? 'text' : 'password'"
                       name="password"
                       required autocomplete="current-password" id="inp_password"
                       class="bg-gray-50 border text-center border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 pl-10
                       placeholder-gray-400 transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500"
                       placeholder="{{ __('••••••••') }}">

                {{-- دکمه تاگل نمایش رمز عبور --}}
                <button type="button"
                        @click="showPassword = !showPassword"
                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 012.132-3.411m3.35-2.987A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.957 9.957 0 01-1.563 3.029M3 3l18 18"/>
                    </svg>
                </button>

                @error('password')
                <span class="text-red-500 text-sm absolute p-0.5">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Remember Me -->
        <div class="block mt-7">
            <label for="remember" class="inline-flex items-center cursor-pointer">
                <input type="checkbox" wire:model="remember" id="remember"
                       class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-teal-600 shadow-sm
                              focus:ring-teal-500 dark:focus:ring-teal-600 dark:focus:ring-offset-gray-800 transition-all"
                       name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('به‌خاطر بسپار') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                <div wire:loading class="mr-2">
                    <svg aria-hidden="true" role="status"
                         class="inline w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101"
                         fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor"/>
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="#000000FF"/>
                    </svg>
                </div>
                {{ __('ورود به سیستم') }}
            </x-primary-button>
        </div>
    </form>

</div>
