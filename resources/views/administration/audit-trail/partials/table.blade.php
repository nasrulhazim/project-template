<table class="min-w-full divide-y divide-gray-300">
    <thead>
        <tr>
            <th scope="col"
                class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                Field</th>
            <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                Value</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-white">
        @forelse ($values as $key => $value)
            @if(! str($key)->contains('id', '_id', 'uuid'))
                <tr>
                    <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm text-gray-500 sm:pl-0">{{ strtoupper(str($key)->headline()) }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">
                        @if(is_valid_json($value))
                            @include('administration.audit-trail.partials.table', ['values' => json_decode($value, JSON_OBJECT_AS_ARRAY)])
                        @else
                            @if(str($key)->contains('is_'))
                                <x-status :condition="$value"
                                    okLabel=""
                                    falseLabel=""/>
                            @else
                                @if(is_array($value))
                                    @include('administration.audit-trail.partials.table', ['values' => $value])
                                @else
                                    <span @if(strlen($value) > 80) x-data x-tooltip="{{ $value }}" @endif>{{ $value }}</span>
                                @endif
                            @endif
                        @endif
                    </td>
                </tr>
            @endif
        @empty
        <tr>
            <td colspan=2 class="whitespace-nowrap py-2 pl-4 pr-3 text-sm text-gray-500 sm:pl-0 italic">{{ __('No information available.') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>
