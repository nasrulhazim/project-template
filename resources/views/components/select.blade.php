<select {{ $attributes->merge(['class' => 'block w-full rounded-md shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600']) }}>
    <option>{{ __('Please select') }}</option>
    {{ $slot }}
</select>
