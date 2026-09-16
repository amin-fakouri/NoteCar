<div class="max-w-2xl mx-auto space-y-6">

    {{-- کارت فرم ساخت کارمند --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 transition-colors">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="text-teal-500" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2 5s1 0 1-1-1-4-3-4-3 3-3 4 1 1 1 1zm4-6a.5.5 0 0 1 .5.5V9h1.5a.5.5 0 0 1 0 1H12v1.5a.5.5 0 0 1-1 0V10h-1.5a.5.5 0 0 1 0-1H11V7.5A.5.5 0 0 1 11.5 7"/>
            </svg>
            {{ __('ساخت کارمند جدید') }}
        </h2>

        <form wire:submit="create" class="space-y-4">
            @csrf

            <div>
                <label for="phone_number" class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('شماره تماس') }}
                </label>
                <input
                    id="phone_number"
                    wire:model="phone_number"
                    type="tel"
                    inputmode="numeric"
                    placeholder="{{ __('مثال: 09121234567') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5
                           placeholder-gray-400 transition-all duration-200
                           focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                           dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                           dark:focus:ring-teal-500 dark:focus:border-teal-500">
                @error('phone_number')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('رمز عبور') }}
                </label>
                <input
                    id="password"
                    wire:model="password"
                    type="password"
                    autocomplete="new-password"
                    placeholder="{{ __('حداقل ۸ کاراکتر') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5
                           placeholder-gray-400 transition-all duration-200
                           focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                           dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                           dark:focus:ring-teal-500 dark:focus:border-teal-500">
                @error('password')
                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    wire:loading.attr="disabled"
                    wire:target="create"
                    class="w-full sm:w-auto text-white bg-teal-500 hover:bg-teal-600 focus:ring-4 focus:outline-none
                           focus:ring-teal-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                           inline-flex items-center justify-center gap-2 disabled:opacity-60
                           dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800 transition-all">
                <svg wire:loading wire:target="create" class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                <span wire:loading.remove wire:target="create">{{ __('ایجاد کارمند') }}</span>
                <span wire:loading wire:target="create">{{ __('در حال ایجاد...') }}</span>
            </button>
            <hr>
            <a href="{{ \Illuminate\Support\Facades\URL::signedRoute('mg-panel') }}" wire:navigate
               class="text-white mt-2 bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800 transition-all">
            {{__('برگشت')}}
            </a>
        </form>
    </div>

    {{-- کارت لیست کارمندان --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 transition-colors">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                {{ __('لیست کارمندان') }}
            </h2>
            <button wire:click="sort_table" type="button"
                    class="text-teal-600 dark:text-teal-400 hover:text-teal-700 dark:hover:text-teal-300 text-sm font-medium inline-flex items-center gap-1 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zM3 9.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zM3 12.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
                </svg>
                {{ __('برعکس کردن') }}
            </button>
        </div>

        {{-- جدول - دسکتاپ --}}
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full text-sm text-right">
                <thead>
                <tr class="text-gray-500 dark:text-gray-400 border-b dark:border-gray-700">
                    <th class="p-2 font-medium">{{ __('#') }}</th>
                    <th class="p-2 font-medium">{{ __('شماره تماس') }}</th>
                    <th class="p-2 font-medium">{{ __('عملیات') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $index => $user)
                    <tr wire:key="user-{{ $user->id }}"
                        class="border-b last:border-0 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="p-2 text-gray-700 dark:text-gray-300">{{ $users->firstItem() + $index }}</td>
                        <td class="p-2 text-gray-700 dark:text-gray-300">{{ $user->phone_number }}</td>
                        <td class="p-2">
                            @if($user->role_code == 1)
                                <button class="bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 rounded-lg text-xs px-3 py-1.5 cursor-not-allowed" disabled type="button">
                                    {{ __('حذف') }}
                                </button>
                            @else
                                <button class="text-white bg-red-500 hover:bg-red-600 rounded-lg text-xs px-3 py-1.5 transition-all" type="button"
                                        wire:click="delete_table({{ $user->id }})"
                                        wire:confirm="مطمئنی می‌خوای این کارمند رو حذف کنی؟">
                                    {{ __('حذف') }}
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-400 dark:text-gray-500">
                            {{ __('کارمندی ثبت نشده است') }}
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- کارت‌ها - موبایل --}}
        <div class="sm:hidden space-y-2">
            @forelse($users as $index => $user)
                <div wire:key="user-mobile-{{ $user->id }}"
                     class="flex items-center justify-between border border-gray-200 dark:border-gray-700 rounded-lg p-3">
                    <div>
                        <p class="text-xs text-gray-400 dark:text-gray-500">#{{ $users->firstItem() + $index }}</p>
                        <p class="text-sm text-gray-800 dark:text-gray-200">{{ $user->phone_number }}</p>
                    </div>
                    @if($user->role_code == 1)
                        <button class="bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 rounded-lg text-xs px-3 py-1.5" disabled type="button">
                            {{ __('حذف') }}
                        </button>
                    @else
                        <button class="text-white bg-red-500 hover:bg-red-600 rounded-lg text-xs px-3 py-1.5 transition-all" type="button"
                                wire:click="delete_table({{ $user->id }})"
                                wire:confirm="مطمئنی می‌خوای این کارمند رو حذف کنی؟">
                            {{ __('حذف') }}
                        </button>
                    @endif
                </div>
            @empty
                <p class="text-center text-gray-400 dark:text-gray-500 py-4">
                    {{ __('کارمندی ثبت نشده است') }}
                </p>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
