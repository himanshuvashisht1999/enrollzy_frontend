@extends('layouts.app')
@section('meta_title', 'Please try again - Enrollzy')
@section('content')
    @include('counselling._assets')
    <main class="cz">
        <div class="cz-page cz-gutter">
            <div class="cz-container">
                <div class="cz-card cz-empty">
                    <b>This page could not load right now</b>
                    Exam and counselling details are temporarily unavailable. Please try again in a minute.
                    <p style="margin:14px auto 0"><a class="cz-btn cz-btn-outline" href="{{ url()->current() }}">Try again</a></p>
                </div>
            </div>
        </div>
    </main>
@endsection
