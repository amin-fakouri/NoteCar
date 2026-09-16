@php use Illuminate\Support\Facades\URL; use Illuminate\Support\Facades\Storage; @endphp

{{--
    | همون اسکریپت تم که توی نوار بالا استفاده کردیم؛ اینجا هم لازمه چون این
    | ویو مستقل از اون یکیه و ممکنه کاربر مستقیم واردش بشه. کلید localStorage
    | یکسانه ("theme")، پس انتخاب کاربر بین همه‌ی صفحات مشترک می‌مونه.
--}}

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

    {{-- ================= هدر صفحه ================= --}}
    <div class="bg-gray-50 w-full relative shadow-md p-3 dark:bg-gray-800 dark:text-white transition-colors">
        <h1 class="font-semibold text-xl sm:text-3xl">{{__('دیدن اطلاعات')}}</h1>
        <br>
        <hr>
        <br>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ URL::signedRoute('ad_dash') }}"
               class="text-white bg-teal-500 hover:bg-teal-600 focus:ring-4 focus:outline-none focus:ring-teal-500 font-medium rounded-lg text-sm p-3 text-center inline-flex items-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800 transition-all">
                برگشت
            </a>

            <button type="submit" wire:click="sort"
                    class="text-white bg-teal-500 hover:bg-teal-600 focus:ring-4 focus:outline-none focus:ring-teal-500 font-medium rounded-full text-sm p-3 text-center inline-flex items-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800 transition-all"
                    aria-label="مرتب‌سازی">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5m-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5"/>
                </svg>
            </button>
        </div>
    </div>

    <br>

    {{-- ================= جدول اطلاعات =================
         یک جدول واحد که هم برای حالت پیش‌فرض و هم حالت مرتب‌شده استفاده می‌شه.
         (قبلاً دو بلاک تکراری بود که با پیاده‌سازی pagination، نگه‌داشتنشون
         عملاً غیرممکن می‌شد چون لینک‌های صفحه‌بندی باید به یک کوئری واحد وصل باشن) --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">{{__('ثبت شده توسط')}}</th>
                <th scope="col" class="px-6 py-3">{{__('شماره قول نامه')}}</th>
                <th scope="col" class="px-6 py-3">{{__('شماره شاستی')}}</th>
                <th scope="col" class="px-6 py-3">{{__('سیلندر')}}</th>
                <th scope="col" class="px-6 py-3">{{__('قیمت')}}</th>
                <th scope="col" class="px-6 py-3">{{__('کارکرد')}}</th>
                <th scope="col" class="px-6 py-3">{{__('پلاک خودرو')}}</th>
                <th scope="col" class="px-6 py-3">{{__('نام خودرو')}}</th>
                <th scope="col" class="px-6 py-3">{{__('مدل')}}</th>
                <th scope="col" class="px-6 py-3">{{__('رنگ')}}</th>
                <th scope="col" class="px-6 py-3">{{__('نوع سوخت')}}</th>
                <th scope="col" class="px-6 py-3">{{__('نوع گیربوکس')}}</th>
                <th scope="col" class="px-6 py-3">{{__('نوع دنده')}}</th>
                <th scope="col" class="px-6 py-3">{{__('نام و نام خانوادگی فروشنده')}}</th>
                <th scope="col" class="px-6 py-3">{{__('شماره تماس فروشنده')}}</th>
                <th scope="col" class="px-6 py-3">{{__('نام و نام خانوادگی خریدار')}}</th>
                <th scope="col" class="px-6 py-3">{{__('شماره تماس خریدار')}}</th>
{{--                <th scope="col" class="px-6 py-3">{{__('سود')}}</th>--}}
{{--                <th scope="col" class="px-6 py-3">{{__('ضرر')}}</th>--}}
                <th scope="col" class="px-6 py-3">{{__('وضعیت')}}</th>
                <th scope="col" class="px-6 py-3">{{__('جزئیات')}}</th>
                <th scope="col" class="px-6 py-3">{{__('گالری')}}</th>
                <th scope="col" class="px-6 py-3">{{__('تاریخ ثبت')}}</th>
                <th scope="col" class="px-6 py-3">{{__('حذف')}}</th>
                <th scope="col" class="px-6 py-3">{{__('ویرایش')}}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($specifications as $specification)
                <tr wire:key="spec-{{ $specification->id }}"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $loop->iteration + ($specifications->currentPage() - 1) * $specifications->perPage() }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $specification->submitted_by }}
                        @if($specification->edited_by !== '...')
                            <span class="text-xs text-gray-500">
                                (ویرایش شده توسط {{ $specification->edited_by }})
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $specification->promise_number }}</td>
                    <td class="px-6 py-4">{{ $specification->identification_number }}</td>
                    <td class="px-6 py-4">{{ $specification->cylinder_type }}</td>
                    <td class="px-6 py-4">{{ number_format((int) $specification->price_car) }}</td>
                    <td class="px-6 py-4">
                        {{ $specification->mileage ? number_format($specification->mileage, 0) . ' ' . __('کیلومتر') : __('ثبت نشده') }}
                    </td>
                    <td class="px-6 py-4">{{ $specification->plat_number }}</td>
                    <td class="px-6 py-4">{{ $specification->car_name }}</td>
                    <td class="px-6 py-4">{{ $specification->model }}</td>
                    <td class="px-6 py-4">{{ $specification->color }}</td>
                    <td class="px-6 py-4">{{ $specification->car_fuel_type }}</td>
                    <td class="px-6 py-4">{{ $specification->gearbox_type }}</td>
                    <td class="px-6 py-4">{{ $specification->gear_type }}</td>
                    <td class="px-6 py-4">{{ $specification->seller }}</td>
                    <td class="px-6 py-4">{{ $specification->mobile_seller }}</td>
                    <td class="px-6 py-4">{{ $specification->buyer }}</td>
                    <td class="px-6 py-4">{{ $specification->mobile_buyer }}</td>
{{--                    <td class="px-6 py-4">{{ $specification->profit }}</td>--}}
{{--                    <td class="px-6 py-4">{{ $specification->loss }}</td>--}}
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            {{ $specification->situation_mode === 'sold' ? 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300' : 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300' }}">
                            {{ $specification->situation_mode }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <button type="button" wire:click="find_id({{ $specification->id }})"
                                class="text-center justify-center mx-auto flex text-teal-600 hover:underline dark:text-teal-400">{{__('نمایش')}}</button>
                    </td>
                    <td class="px-6 py-4">
                        <button type="button" wire:click="show_gallery({{ $specification->id }})"
                                class="text-white bg-indigo-500 hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-500 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center gap-1 dark:bg-indigo-600 dark:hover:bg-indigo-700 transition-all">
                            {{__('گالری')}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 viewBox="0 0 16 16">
                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                <path
                                    d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm10 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z"/>
                            </svg>
                        </button>
                    </td>
                    <td class="px-6 py-4">{{ $specification->created_post }}</td>
                    <td class="px-6 py-4">
                        <button type="button" wire:click="delete({{ $specification->id }})"
                                wire:confirm="{{ __('آیا از حذف این رکورد مطمئن هستید؟') }}"
                                class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 transition-all">
                            {{__('حذف')}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-trash mr-2" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                            </svg>
                        </button>
                    </td>
                    <td class="px-6 py-3">
                        <a type="button"
                           href="{{ URL::signedRoute('edite', ['post_id' => $specification->id]) }}"
                           class="text-white bg-teal-500 hover:bg-teal-600 focus:ring-4 focus:outline-none focus:ring-teal-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800 transition-all">
                            {{__('ویرایش')}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-pencil-square mr-2" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd"
                                      d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="25" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                        {{__('رکوردی یافت نشد')}}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- ================= لینک‌های صفحه‌بندی ================= --}}
    <div class="mt-4 px-2">
        {{ $specifications->links() }}
    </div>

    <br><br><br><br>

    {{-- ================= مودال‌ها ================= --}}
    @if($modal == 0)

    @elseif($modal == 1)
        {{-- مودال نمایش جزئیات کامل خودرو --}}
        <div
            class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 animate__animated animate__fadeIn"
            wire:click.self="close_modal">
            <div
                class="bg-gray-100 dark:bg-gray-800 dark:text-white rounded-lg w-full max-w-xl max-h-[85vh] overflow-y-auto p-4 transition-colors">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="font-bold text-lg">{{__('جزئیات خودرو')}}</h1>
                    <button type="button" wire:click="close_modal"
                            class="text-gray-500 hover:text-red-500 dark:text-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                             viewBox="0 0 16 16">
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </button>
                </div>
                <hr class="mb-4">

                @if($find_data)
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div><span
                                class="text-gray-500 dark:text-gray-400">{{__('نام خودرو:')}}</span> {{ $find_data->car_name }}
                        </div>
                        <div><span
                                class="text-gray-500 dark:text-gray-400">{{__('مدل:')}}</span> {{ $find_data->model }}
                        </div>
                        <div><span
                                class="text-gray-500 dark:text-gray-400">{{__('رنگ:')}}</span> {{ $find_data->color }}
                        </div>
                        <div><span
                                class="text-gray-500 dark:text-gray-400">{{__('پلاک:')}}</span> {{ $find_data->plat_number }}
                        </div>
                        <div><span
                                class="text-gray-500 dark:text-gray-400">{{__('شماره شاستی:')}}</span> {{ $find_data->identification_number }}
                        </div>
                        <div><span
                                class="text-gray-500 dark:text-gray-400">{{__('شماره قول‌نامه:')}}</span> {{ $find_data->promise_number }}
                        </div>
                        <div><span
                                class="text-gray-500 dark:text-gray-400">{{__('نوع سوخت:')}}</span> {{ $find_data->car_fuel_type }}
                        </div>
                        <div><span
                                class="text-gray-500 dark:text-gray-400">{{__('گیربوکس:')}}</span> {{ $find_data->gearbox_type }}
                        </div>
                        <div><span
                                class="text-gray-500 dark:text-gray-400">{{__('نوع دنده:')}}</span> {{ $find_data->gear_type }}
                        </div>
                        <div><span
                                class="text-gray-500 dark:text-gray-400">{{__('سیلندر:')}}</span> {{ $find_data->cylinder_type }}
                        </div>
                        <div>
                            <span class="text-gray-500 dark:text-gray-400">{{__('قیمت:')}}</span>
                                {{ number_format((int) $find_data->price_car) }}
                        </div>
                        <div><span
                                class="text-gray-500 dark:text-gray-400">{{__('کارکرد:')}}</span> {{ $find_data->mileage ? number_format((float) $find_data->mileage, 0) . ' ' . __('کیلومتر') : __('ثبت نشده') }}}
                        </div>
                        <div><span
                                class="text-gray-500 dark:text-gray-400">{{__('فروشنده:')}}</span> {{ $find_data->seller }}
                            ({{ $find_data->mobile_seller }})
                        </div>
                        <div><span
                                class="text-gray-500 dark:text-gray-400">{{__('خریدار:')}}</span> {{ $find_data->buyer }}
                            ({{ $find_data->mobile_buyer }})
                        </div>
                        <div><span
                                class="text-gray-500 dark:text-gray-400">{{__('وضعیت:')}}</span> {{ $find_data->situation_mode }}
                        </div>
                        <div><span
                                class="text-gray-500 dark:text-gray-400">{{__('تاریخ ثبت:')}}</span> {{ $find_data->created_post }}
                        </div>
                    </div>
                    <hr class="my-4">
                    <div>
                        <span class="text-gray-500 dark:text-gray-400 block mb-1">{{__('توضیحات:')}}</span>
                        <p class="whitespace-pre-line">{{ $find_data->description }}</p>
                    </div>
                @endif
            </div>
        </div>

    @elseif($modal == 2)

        <div
            class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 animate__animated animate__fadeIn"
            wire:click.self="close_modal">
            <div
                class="bg-gray-100 dark:bg-gray-800 dark:text-white rounded-lg w-full max-w-2xl max-h-[85vh] overflow-y-auto p-4 transition-colors">
                <div class="flex justify-between items-center mb-4">
                    <h1 class="font-bold text-lg">{{__('گالری تصاویر')}}</h1>
                    <button type="button" wire:click="close_modal"
                            class="text-gray-500 hover:text-red-500 dark:text-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                             viewBox="0 0 16 16">
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </button>
                </div>
                <hr class="mb-4">


                
                @if(count($gallery_images) > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
        @foreach($gallery_images as $image)
            @php
                $filename = basename($image);
            @endphp
            <a href="{{ route('car.image', $filename) }}" target="_blank" rel="noopener">
                <img src="{{ route('car.image', $filename) }}"
                     loading="lazy"
                     class="rounded-lg object-cover w-full h-28 sm:h-36 hover:opacity-80 hover:scale-[1.02] transition-all cursor-pointer">
            </a>
        @endforeach
    </div>
@else
    <p class="text-center text-gray-500 dark:text-gray-400 py-8">{{__('عکسی برای این خودرو ثبت نشده است')}}</p>
@endif
                
                
            </div>
        </div>
    @endif

</div>
