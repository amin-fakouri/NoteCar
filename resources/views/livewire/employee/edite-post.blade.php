@php use Illuminate\Support\Facades\URL; use Illuminate\Support\Facades\Storage; @endphp

<div
    x-data="{
        darkMode: document.documentElement.classList.contains('dark'),
        toggleTheme() {
            this.darkMode = !this.darkMode;
            document.documentElement.classList.toggle('dark', this.darkMode);
            localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
        }
    }"
>

    {{-- ================= آلارم بروزرسانی موفق ================= --}}
    @if($alert_mode == 0)

    @elseif($alert_mode == 1)
        <div class="fixed top-4 inset-x-0 sm:inset-x-auto sm:left-4 z-50 px-4 sm:px-0 w-full sm:w-72 mx-auto sm:mx-0">
            <div id="alert-3"
                 class="flex shadow-md items-center w-full p-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                 role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    با موفقیت بروزرسانی شد!
                </div>
                <button wire:click="close_alert" type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    {{-- ================= فرم ویرایش اطلاعات ================= --}}
    <form
        class="text-center p-4 sm:p-6 mx-4 sm:mx-auto w-auto sm:w-96 max-w-full dark:bg-gray-800 dark:text-white bg-gray-50 mt-6 rounded-lg shadow-md transition-colors"
        wire:submit="update({{ $find_id->id }})">
        <div class="grid grid-cols-3">
            <div class="m-2 col-span-3">
                <h1 class="font-bold">
                    {{__('ویرایش پست')}}
                </h1>
                <br>
                <hr>
            </div>

            <div class="col-span-3">
                <label for="promise_number"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('شماره قول نامه:') }}
                </label>
                <input id="promise_number"
                       wire:model="promise_number"
                       placeholder="{{ __('شماره قول نامه') }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                       placeholder-gray-400
                       transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>
                @error('promise_number')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3">
                <label for="identification_number"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('شماره شاستی:') }}
                </label>
                <input id="identification_number"
                       wire:model="identification_number"
                       placeholder="{{__('شماره شاستی')}}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                       placeholder-gray-400
                       transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>
                @error('identification_number')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3">
                <label for="mileage"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('کارکرد(کیلومتر):') }}
                </label>
                <input id="mileage"
                       wire:model="mileage"
                       placeholder="{{__('کارکرد(کیلومتر)')}}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                       placeholder-gray-400
                       transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>
                @error('mileage')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3">
                <label for="cylinder_type"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{__('نوع سیلندر:')}}
                </label>
                <select style="width: 100%" id="cylinder_type" wire:model="cylinder_type"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                       placeholder-gray-400
                       transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none">
                    <option value="{{__('۴ سیلندر')}}" @selected($cylinder_type === __('۴ سیلندر'))>{{__('۴ سیلندر')}}</option>
                    <option value="{{__('۶ سیلندر')}}" @selected($cylinder_type === __('۶ سیلندر'))>{{__('۶ سیلندر')}}</option>
                    <option value="{{__('۵ سیلندر')}}" @selected($cylinder_type === __('۵ سیلندر'))>{{__('۵ سیلندر')}}</option>
                    <option value="{{__('۸ سیلندر')}}" @selected($cylinder_type === __('۸ سیلندر'))>{{__('۸ سیلندر')}}</option>
                    <option value="{{__('۱۰ سیلندر')}}" @selected($cylinder_type === __('۱۰ سیلندر'))>{{__('۱۰ سیلندر')}}</option>
                    <option value="{{__('۱۲ سیلندر')}}" @selected($cylinder_type === __('۱۲ سیلندر'))>{{__('۱۲ سیلندر')}}</option>
                </select>
                @error('cylinder_type')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3" x-data="{
    rawPrice: '{{ $price_car }}',
    get formattedPrice() {
        if (!this.rawPrice) return '';
        let num = parseInt(this.rawPrice.replace(/,/g, ''));
        if (isNaN(num)) return '';

        if (num >= 1000000000) {
            return (num / 1000000000).toLocaleString('fa-IR', {maximumFractionDigits: 2}) + ' میلیارد تومان';
        } else if (num >= 1000000) {
            return (num / 1000000).toLocaleString('fa-IR', {maximumFractionDigits: 2}) + ' میلیون تومان';
        } else if (num >= 1000) {
            return (num / 1000).toLocaleString('fa-IR', {maximumFractionDigits: 0}) + ' هزار تومان';
        }
        return num.toLocaleString('fa-IR') + ' تومان';
    }
}">
                <label for="price_car"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('قیمت ماشین:') }}
                </label>
                <input id="price_car"
                       wire:model="price_car"
                       x-model="rawPrice"
                       x-on:input="rawPrice = $event.target.value.replace(/[^0-9]/g, '')"
                       placeholder="{{__('قیمت ماشین')}}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                       placeholder-gray-400
                       transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>
                <p class="text-sm text-gray-500 mt-1" x-show="formattedPrice" x-text="formattedPrice"></p>

                @error('price_car')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3 sm:col-span-1 m-0.5">
                <label for="plat_number"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('شماره پلاک:') }}
                </label>
                <input id="plat_number"
                       wire:model="plat_number"
                       type="tel"
                       placeholder="{{__('شماره پلاک')}}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                       placeholder-gray-400
                       transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>
                @error('plat_number')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3 sm:col-span-1 m-0.5">
                <label for="car_name"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('نام ماشین:') }}
                </label>
                <input id="car_name"
                       wire:model="car_name"
                       placeholder="{{__('نام ماشین')}}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                       placeholder-gray-400
                       transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>
                @error('car_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3 sm:col-span-1 m-0.5">
                <label for="model"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('مدل ماشین:') }}
                </label>
                <input id="model"
                       wire:model="model"
                       placeholder="{{__('مدل ماشین')}}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                       placeholder-gray-400
                       transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>
                @error('model')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3 sm:col-span-1 m-0.5">
                <label for="color"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('رنگ:') }}
                </label>
                <input id="color"
                       wire:model="color"
                       placeholder="{{__('رنگ')}}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                       placeholder-gray-400
                       transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>
                @error('color')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3 sm:col-span-1 m-0.5">
                <label for="car_fuel_type"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('نوع سوخت:') }}
                </label>
                <input id="car_fuel_type"
                       wire:model="car_fuel_type"
                       placeholder="{{__('نوع سوخت')}}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                       placeholder-gray-400
                       transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>
                @error('car_fuel_type')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3 sm:col-span-1 m-0.5">
                <label for="gearbox_type"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('نوع گیربوکس:') }}
                </label>
                <input id="gearbox_type"
                       wire:model="gearbox_type"
                       placeholder="{{__('نوع گیربوکس')}}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                       placeholder-gray-400
                       transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>
                @error('gearbox_type')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3">
                <label for="gear_type"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('نوع دنده:') }}
                </label>
                <input id="gear_type"
                       wire:model="gear_type"
                       placeholder="{{__('نوع دنده')}}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                       placeholder-gray-400
                       transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>
                @error('gear_type')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3">
                <label for="seller"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('نام و نام خانوادگی فروشنده:') }}
                </label>

                <input id="seller"
                       wire:model="seller"
                       placeholder="{{ __('نام و نام خانوادگی فروشنده') }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                  placeholder-gray-400
                  transition-all duration-200
                  focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                  dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>

                @error('seller')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3">
                <label for="mobile_seller"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('شماره تماس فروشنده:') }}
                </label>

                <input id="mobile_seller"
                       type="tel"
                       wire:model="mobile_seller"
                       placeholder="{{ __('شماره تماس فروشنده') }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                  placeholder-gray-400
                  transition-all duration-200
                  focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                  dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>

                @error('mobile_seller')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3">
                <label for="buyer"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('نام و نام خانوادگی خریدار:') }}
                </label>

                <input id="buyer"
                       wire:model="buyer"
                       placeholder="{{ __('نام و نام خانوادگی خریدار') }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                  placeholder-gray-400
                  transition-all duration-200
                  focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                  dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>

                @error('buyer')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3">
                <label for="mobile_buyer"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('شماره تماس خریدار:') }}
                </label>

                <input id="mobile_buyer"
                       type="tel"
                       wire:model="mobile_buyer"
                       placeholder="{{ __('شماره تماس خریدار') }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                  placeholder-gray-400
                  transition-all duration-200
                  focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                  dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>

                @error('mobile_buyer')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

{{--            <div class="col-span-3">--}}
{{--                <label for="profit"--}}
{{--                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">--}}
{{--                    {{ __('سود:') }}--}}
{{--                </label>--}}

{{--                <input id="profit"--}}
{{--                       type="tel"--}}
{{--                       wire:model="profit"--}}
{{--                       placeholder="{{ __('سود') }}"--}}
{{--                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full--}}
{{--                  placeholder-gray-400--}}
{{--                  transition-all duration-200--}}
{{--                  focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none--}}
{{--                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white--}}
{{--                  dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>--}}

{{--                @error('profit')--}}
{{--                <span class="text-red-500 text-sm">{{ $message }}</span>--}}
{{--                @enderror--}}
{{--            </div>--}}

{{--            <div class="col-span-3">--}}
{{--                <label for="loss"--}}
{{--                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">--}}
{{--                    {{ __('ضرر:') }}--}}
{{--                </label>--}}

{{--                <input id="loss"--}}
{{--                       type="tel"--}}
{{--                       wire:model="loss"--}}
{{--                       placeholder="{{ __('ضرر') }}"--}}
{{--                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full--}}
{{--                  placeholder-gray-400--}}
{{--                  transition-all duration-200--}}
{{--                  focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none--}}
{{--                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white--}}
{{--                  dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>--}}

{{--                @error('loss')--}}
{{--                <span class="text-red-500 text-sm">{{ $message }}</span>--}}
{{--                @enderror--}}
{{--            </div>--}}

            <div class="col-span-3">
                <label for="description"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('توضیحات:') }}
                </label>

                <textarea id="description"
                          wire:model="description"
                          placeholder="{{ __('توضیحات') }}"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                     placeholder-gray-400
                     transition-all duration-200
                     focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                     dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                     dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none">{{ $description }}</textarea>

                @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3">
                <label for="situation_mode"
                       class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{__('وضعیت:')}}
                </label>
                <select style="width: 100%" id="situation_mode" wire:model="situation_mode"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                       placeholder-gray-400
                       transition-all duration-200
                       focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                       dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                       dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none">
                    <option value="{{ $situation_mode }}">{{ $situation_mode }}</option>
                    <option value="{{__('موجود')}}">{{__('موجود')}}</option>
                    <option value="{{__('درحال مذاکره')}}">{{__('درحال مذاکره')}}</option>
                    <option value="{{__('فروخته شده')}}">{{__('فروخته شده')}}</option>
                </select>

                @error('situation_mode')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- ================= گالری تصاویر =================
                 عکس‌های قبلی با دکمه‌ی حذف نمایش داده می‌شن (حذف فوری، مستقل از
                 submit فرم). عکس‌های جدید انتخاب و پیش‌نمایش می‌شن، ولی موقع
                 submit فرم (متد update) واقعاً آپلود و ذخیره می‌شن. --}}
            <div class="col-span-3">
                <label class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
                    {{ __('عکس:') }}
                </label>

                @if(count($existing_images ?? []) > 0)
                    <div class="grid grid-cols-3 sm:grid-cols-4 gap-2 mb-3">
                        @foreach($existing_images as $index => $image)
                            <div class="relative group" wire:key="existing-image-{{ $index }}">
                                <img src="{{ route('car.image', basename($image)) }}"
                                     class="rounded-lg object-cover w-full h-20 border dark:border-gray-600">
                                <button type="button"
                                        wire:click="removeExistingImage({{ $index }})"
                                        wire:confirm="{{ __('مطمئنی می‌خوای این عکس حذف بشه؟') }}"
                                        class="absolute -top-2 -left-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs shadow-md transition-all">
                                    ✕
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{__('عکسی ثبت نشده است')}}</p>
                @endif

                <input id="new_images"
                       type="file"
                       multiple
                       accept="image/*"
                       wire:model="new_images"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                  placeholder-gray-400
                  transition-all duration-200
                  focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                  dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>

                <div wire:loading wire:target="new_images" class="text-sm text-teal-500 mt-1">
                    {{__('در حال آپلود پیش‌نمایش...')}}
                </div>

                @if($new_images)
                    <div class="grid grid-cols-3 sm:grid-cols-4 gap-2 mt-3">
                        @foreach($new_images as $index => $image)
                            <img wire:key="new-image-{{ $index }}"
                                 src="{{ $image->temporaryUrl() }}"
                                 class="rounded-lg object-cover w-full h-20 border-2 border-teal-400">
                        @endforeach
                    </div>
                @endif

                @error('new_images.*')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <x-primary-button type="submit" class="mb-3 mt-3">
            <span wire:loading.remove wire:target="update">{{__('بروزرسانی اطلاعات')}}</span>
            <span wire:loading wire:target="update">{{__('در حال ذخیره...')}}</span>
        </x-primary-button>

        <hr>

        <div class="flex flex-wrap items-center justify-center gap-2 mt-2">
            <a href="{{ URL::signedRoute('detail') }}"
               class="text-white mt-2 bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800 transition-all">
                {{__('دیدن اطلاعت')}}
            </a>
        </div>
    </form>
</div>
