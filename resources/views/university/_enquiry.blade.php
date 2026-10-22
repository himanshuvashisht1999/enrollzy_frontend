{{-- "Talk to an admission expert": a call-back request saved as a lead (same endpoint as the site's contact form).
     $id: unique form id; $course: optional programme name to prefill. --}}
<form class="uz-form" data-uz-enquiry action="{{ route('contact.submit') }}" method="POST" id="{{ $id }}">
    @csrf
    <input type="hidden" name="organisation_name" value="{{ $u->org['name'] }}">
    <input type="hidden" name="subject" value="University enquiry: {{ $u->org['name'] }}" data-uz-subject>
    <label for="{{ $id }}-name">Name<input id="{{ $id }}-name" name="name" required maxlength="255" placeholder="Your name" autocomplete="name"></label>
    <label for="{{ $id }}-phone">Phone<input id="{{ $id }}-phone" name="phone" required maxlength="20" inputmode="tel" pattern="[0-9+\s-]{10,15}" placeholder="10-digit mobile" autocomplete="tel"></label>
    @if($u->campuses->count() > 1)
        <label for="{{ $id }}-campus">Preferred campus
            <select id="{{ $id }}-campus" data-uz-campus>
                <option value="">Any campus</option>
                @foreach($statesByCampus as $state => $cs)
                    <optgroup label="{{ $state ?: 'Other' }}">@foreach($cs as $cc)<option value="{{ $cc['name'] }}" @selected($scope === $cc['id'])>{{ $cc['name'] }}</option>@endforeach</optgroup>
                @endforeach
            </select>
        </label>
    @endif
    <input type="hidden" name="programme" value="{{ $course ?? '' }}" data-uz-programme>
    <input type="hidden" name="message" value="" data-uz-message>
    <button class="cz-btn cz-btn-orange" type="submit">Get a call back</button>
    <div class="ok" data-uz-ok hidden role="status"></div>
</form>
