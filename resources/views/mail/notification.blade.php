<x-mail::message>
{{ __('Hi') }}!

{{ $message }}

@if(isset($url) && !empty($url) )
<x-mail::button url="{{ $url }}">
	{{ (isset($url_text) && !empty($url_text)) ? $url_text : __('Click here') }}
</x-mail::button>
@endif

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
