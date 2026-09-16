@props(['disabled' => false])

<input  {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                    focus:ring-teal-400 focus:border-teal-400 block w-full p-2.5 dark:bg-gray-700
                     dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-teal-500
                      dark:focus:border-teal-500 m-2  focus:rounded-lg transition-all focus:transition-all hover:transition-all']) !!}>
