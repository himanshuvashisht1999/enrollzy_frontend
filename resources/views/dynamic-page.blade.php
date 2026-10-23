@extends('layouts.app')

@section('meta_title', $page->meta_title ?? $page->title)
@section('meta_keywords', $page->meta_keywords ?? '')
@section('meta_description', $page->meta_description ?? '')

@section('content')
<main class="dynamic-page-section">
    <div class="container py-5">
        <h1 class="mb-4">{{ $page->title }}</h1>
        <div class="page-content">
            {!! $page->content !!}
        </div>
    </div>
</main>
@endsection
