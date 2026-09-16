@php use Illuminate\Support\Facades\URL; @endphp
<div
    x-data="{
        darkMode: document.documentElement.classList.contains('dark'),
        searchOpen: false,
        toggleTheme() {
            this.darkMode = !this.darkMode;
            document.documentElement.classList.toggle('dark', this.darkMode);
            localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
        }
    }"
    @keydown.escape.window="searchOpen = false"
>

    {{-- ================= آلارم موفقیت (منطق دست‌نخورده) ================= --}}
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
                    با موفقیت ایجاد شد!
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

    {{-- ================= نوار بالا (Top Bar) ================= --}}
    <div class="bg-gray-50 dark:bg-gray-800 w-full sticky top-0 z-30 shadow-md transition-colors">
        <div class="px-3 py-2 flex flex-wrap md:flex-nowrap items-center gap-2 md:gap-3">

            {{-- سرچ: روی موبایل ردیف کامل و اول از همه --}}
            <div class="order-1 md:order-2 w-full md:w-auto md:flex-1 relative min-w-0"
                 x-data="{ open: false }"
                 @click.outside="open = false"
                 @keydown.escape.window="open = false">

                <form class="flex" wire:submit="search_car">
                    <input
                        id="search-input"
                        wire:model.live.debounce.300ms="search"
                        @input="open = $event.target.value.length > 0"
                        @focus="if ($el.value.length > 0) open = true"
                        type="text"
                        autocomplete="off"
                        role="combobox"
                        :aria-expanded="open"
                        aria-controls="search-results-panel"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
                    placeholder-gray-400 transition-all duration-200
                    focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
                    dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                    dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"
                        placeholder="جست و جو">

                    <button title="{{ __('جست و جو') }}" type="submit"
                            class="text-white mr-2 bg-teal-500 hover:bg-teal-600 focus:ring-4 focus:outline-none focus:ring-teal-500 font-medium rounded-full text-sm p-3 text-center inline-flex items-center shrink-0 dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </form>

                {{-- باکس نتایج --}}
                <div id="search-results-panel"
                     x-show="open" x-cloak x-transition
                     class="absolute right-0 left-0 mt-2 z-40 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg max-h-72 overflow-y-auto">
                    @if($specifications->count())
                        <table class="w-full text-sm text-right">
                            <thead class="sticky top-0 bg-white dark:bg-gray-800">
                            <tr class="text-gray-500 dark:text-gray-400 border-b dark:border-gray-700">
                                <th class="p-2 font-medium">#</th>
                                <th class="p-2 font-medium hidden sm:table-cell">{{ __('نام ماشین') }}</th>
                                <th class="p-2 font-medium">{{ __('پلاک ماشین') }}</th>
                                <th class="p-2 font-medium hidden md:table-cell">{{ __('شماره شاستی ماشین') }}</th>
                                <th class="p-2 font-medium hidden md:table-cell">{{ __('تاریخ ثبت') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($specifications as $i => $specification)
                                <tr wire:key="spec-{{ $specification->id }}"
                                    @click="open = false; $wire.set('search', @js($specification->car_name))"
                                    class="search-item hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer border-b last:border-0 dark:border-gray-700 transition-colors">
                                    <td class="p-2 text-gray-700 dark:text-gray-300">{{ $i + 1 }}</td>
                                    <td class="p-2 text-gray-700 dark:text-gray-300 hidden sm:table-cell">{{ $specification->car_name }}</td>
                                    <td class="p-2 text-gray-700 dark:text-gray-300">{{ $specification->plat_number }}</td>
                                    <td class="p-2 text-gray-700 dark:text-gray-300 hidden md:table-cell">{{ $specification->identification_number }}</td>
                                    <td class="p-2 text-gray-700 dark:text-gray-300 hidden md:table-cell">{{ $specification->created_post }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="p-3 text-sm text-gray-500 dark:text-gray-400 text-center">
                            {{ __('نتیجه‌ای یافت نشد') }}
                        </p>
                    @endif
                </div>
            </div>

            {{-- سمت راست: خروج + تم + منوی کاربر --}}
            <div class="order-2 md:order-1 flex items-center gap-2 shrink-0">
                <button wire:click="logout"
                        title="{{ __('خروج از سیستم') }}"
                        class="text-red-600 bg-red-50 hover:bg-red-100 focus:ring-4 focus:outline-none focus:ring-red-200
                   font-medium rounded-lg text-sm px-3 md:px-5 py-2.5 text-center inline-flex items-center gap-2
                   dark:text-red-400 dark:bg-red-900/20 dark:hover:bg-red-900/30 dark:focus:ring-red-900/50
                   transition-all">
                    <span class="hidden sm:inline">{{ __('خروج از سیستم') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         viewBox="0 0 16 16">
                        <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
                        <path
                            d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117M11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z"/>
                    </svg>
                </button>
            </div>

            <div class="order-3 flex items-center gap-2 shrink-0 mr-auto md:mr-0">


                {{-- منوی کاربر (Admin/Personal) به‌جای دو دکمه جدا --}}
                @auth
                    @if(auth()->user()->role_code == 1)
                        <div class="relative" x-data="{ userMenu: false }" @click.outside="userMenu = false">
                            <button @click="userMenu = !userMenu" type="button"
                                    class="text-white bg-teal-500 hover:bg-teal-600 focus:ring-4 focus:outline-none focus:ring-teal-500 font-medium rounded-lg text-sm px-3 md:px-5 py-2.5 inline-flex items-center gap-1 dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800 transition-all">
                                <span class="hidden sm:inline">{{ __('پنل کاربری') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                     viewBox="0 0 16 16">
                                    <path d="M8 11L3 6h10z"/>
                                </svg>
                            </button>
                            <div x-show="userMenu" x-cloak x-transition
                                 class="absolute left-0 mt-2 w-40 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 overflow-hidden">
                                <a href="{{ URL::signedRoute('mg-panel') }}"
                                   class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    {{ __('Admin') }}
                                </a>
                                <a href="{{ URL::signedRoute('mg-personal') }}"
                                   class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    {{ __('Personal') }}
                                </a>
                            </div>
                        </div>
                    @elseif(auth()->user()->role_code == 2)
                        <a href="{{ URL::signedRoute('em-personal') }}"
                           class="text-white bg-teal-500 hover:bg-teal-600 focus:ring-4 focus:outline-none focus:ring-teal-500 font-medium rounded-lg text-sm px-3 md:px-5 py-2.5 text-center inline-flex items-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800 transition-all">
                            {{ __('Personal') }}
                        </a>
                    @endif
                @endauth
            </div>

        </div>
    </div>

    {{-- ================= فرم ایجاد پست ================= --}}
    {{-- روی موبایل: تمام عرض با حاشیه‌ی کناری. روی دسکتاپ: عرض ثابت و وسط‌چین.
         (منطق Livewire/Laravel این بخش دست‌نخورده باقی مونده، فقط کلاس‌های چیدمان اصلاح شدن) --}}
    <form
        class="text-center p-4 sm:p-6 mx-4 sm:mx-auto w-auto sm:w-96 max-w-full dark:bg-gray-800 dark:text-white bg-gray-50 mt-6 rounded-lg shadow-md transition-colors"
        wire:submit="create">
        <div class="grid grid-cols-3">
            <div class="m-2 col-span-3">
                <h1 class="font-bold">
                    {{__('ثبت ماشین')}}
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
                       class="bg-gray-50 text-center border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
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
                       class="bg-gray-50 text-center border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
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
                       class="bg-gray-50 text-center border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
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
                    <option selected>{{__('نوع سیلندر')}}</option>
                    <option value="{{__('۴ سیلندر')}}">{{__('۴ سیلندر')}}</option>
                    <option value="{{__('۶ سیلندر')}}">{{__('۶ سیلندر')}}</option>
                    <option value="{{__('۵ سیلند')}}">{{__('۵ سیلندر')}}</option>
                    <option value="{{__('۸ سیلند')}}">{{__('۸ سیلندر')}}</option>
                    <option value="{{__('۱۰ سیلندر')}}">{{__('۱۰ سیلندر')}}</option>
                    <option value="{{__('۱۲ سیلندر')}}">{{__('۱۲ سیلند')}}</option>
                </select>
                @error('cylinder_type')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3" x-data="{
    rawPrice: '',
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
                       class="bg-gray-50 border text-center border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
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
                       type="text"
                       placeholder="{{__('شماره پلاک')}}"
                       class="bg-gray-50 border text-right border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
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
                       class="bg-gray-50 border text-center border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
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
                  focus:ring-2 focus:ring-teal-400 text-center focus:border-teal-400 focus:outline-none
                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                  dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>

                @error('mobile_buyer')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

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
                     dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"></textarea>

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
                    <option selected>{{__('وضعیت')}}</option>
                    <option value="{{__('موجود')}}">{{__('موجود')}}</option>
                    <option value="{{__('درحال مذاکره')}}">{{__('درحال مذاکره')}}</option>
                    <option value="{{__('فروخته شده')}}">{{__('فروخته شده')}}</option>
                </select>

                @error('situation_mode')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-span-3">
                 <label for="images"
           class="block m-2 text-sm font-medium text-gray-900 dark:text-white text-right">
        {{ __('عکس:') }}
    </label>
    <input id="images"
           type="file"
           multiple
           wire:model="images"
           placeholder="{{ __('عکس') }}"
           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 block w-full
              placeholder-gray-400
              transition-all duration-200
              focus:ring-2 focus:ring-teal-400 focus:border-teal-400 focus:outline-none
              dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
              dark:focus:ring-teal-500 dark:focus:border-teal-500 dark:focus:outline-none"/>

    <div wire:loading wire:target="images" class="text-sm text-teal-500 mt-1">
        {{__('در حال آپلود پیش‌نمایش...')}}
    </div>

    @if($images)
        <div class="grid grid-cols-3 sm:grid-cols-4 gap-2 mt-3">
            @foreach($images as $index => $image)
                <div class="relative group" wire:key="new-image-{{ $index }}">
                    <img src="{{ $image->temporaryUrl() }}"
                         class="rounded-lg object-cover w-full h-20 border-2 border-teal-400">
                    <button type="button"
                            wire:click="removeImage({{ $index }})"
                            class="absolute -top-2 -left-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs shadow-md transition-all">
                        ✕
                    </button>
                </div>
            @endforeach
        </div>
    @endif

    @error('images')
    <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
    @error('images.*')
    <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
            </div>
        </div>





        <x-primary-button type="submit" class="mb-3 mt-3">
            {{__('درج اطلاعات')}}
        </x-primary-button>

        <hr>

        <a href="{{ URL::signedRoute('detail') }}"
           class="text-white mt-2 bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800 transition-all">
            {{__('دیدن اطلاعت')}}
        </a>
    </form>


    <script>


        function initSearchPanel() {
            const searchInput = document.getElementById('search-input');
            const searchPanel = document.getElementById('search-results-panel');
            const container = document.getElementById('search-container');

            if (!searchInput || !searchPanel || !container) return;

            function showPanel() {
                searchPanel.style.display = 'block';
            }

            function hidePanel() {
                searchPanel.style.display = 'none';
            }

            searchInput.addEventListener('input', () => {
                if (searchInput.value.length > 0) {
                    showPanel();
                } else {
                    hidePanel();
                }
            });

            searchInput.addEventListener('focus', () => {
                if (searchInput.value.length > 0) {
                    showPanel();
                }
            });

            document.addEventListener('click', (e) => {
                if (!container.contains(e.target)) {
                    hidePanel();
                }
            });

            // بستن با Escape - تجربه کاربری بهتر
            searchInput.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') hidePanel();
            });

            // انتخاب نتیجه - dispatch به‌جای دستکاری مستقیم internal API
            window.selectResult = function (element) {
                const carName = element.getAttribute('data-name');
                const wireEl = container.closest('[wire\\:id]');

                if (wireEl) {
                    Livewire.find(wireEl.getAttribute('wire:id')).set('search', carName);
                }

                hidePanel();
            };
        }
    </script>

</div>