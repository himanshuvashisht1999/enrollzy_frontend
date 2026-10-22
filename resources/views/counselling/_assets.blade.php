{{-- Fonts, styles and script of the exam / counselling pages (client design). Header and footer stay the site's own. --}}
@push('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/css/counselling.css') }}?v={{ @filemtime(public_path('assets/css/counselling.css')) }}">
    @if(!empty($canonical))
        <link rel="canonical" href="{{ $canonical }}">
    @endif
@endpush
@push('scripts')
    <script src="{{ asset('assets/js/counselling.js') }}?v={{ @filemtime(public_path('assets/js/counselling.js')) }}"></script>
@endpush
