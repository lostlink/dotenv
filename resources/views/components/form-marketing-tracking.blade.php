<span>
    {{-- UTM params --}}
    <input type="hidden" name="utm_source"
        value="{{ session('utm_source') }}">
    <input type="hidden" name="utm_medium"
        value="{{ session('utm_medium') }}">
    <input type="hidden" name="utm_campaign"
        value="{{ session('utm_campaign') }}">
    <input type="hidden" name="utm_term" value="{{ session('utm_term') }}">
    <input type="hidden" name="utm_content"
        value="{{ session('utm_content') }}">

    {{-- Other handy inputs for marketing ROIs --}}
    <input type="hidden" name="url" value="{{ request()->url() }}">
    <input type="hidden" name="ip_address" class="ip"
        value="{{ request()->ip() }}">
    <input type="hidden" name="locale" value="{{ app()->getLocale() }}">

    {{-- And you might want to add other inputs like: country, currency ..etc --}}
</span>
