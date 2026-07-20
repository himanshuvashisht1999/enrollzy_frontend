@extends('layouts.app')

@section('meta_title', $blog->meta_title ?? $blog->title)
@section('meta_keywords', $blog->meta_keywords ?? '')
@section('meta_description', $blog->meta_description ?? $blog->excerpt)

@section('content')
<main>
    <!-- Blog Detail Header -->
    <section class="blog-detail-header ptb-70" style="background-color: #F8F9FA;">
        <div class="container text-center">
            <span class="badge bg-primary rounded-pill px-3 py-2 mb-3">{{ $blog->category ? $blog->category->name : 'Uncategorized' }}</span>
            <h1 class="display-5 fw-bold mb-4">{{ $blog->title }}</h1>
            <div class="d-flex align-items-center justify-content-center text-muted gap-4">
                <span><i class="fa-regular fa-user me-2"></i>{{ $blog->author ?? 'Admin User' }}</span>
                <span><i class="fa-regular fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($blog->published_at ?? $blog->created_at)->format('d M, Y') }}</span>
            </div>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="blog-content ptb-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    @if($blog->image)
                    <div class="blog-featured-image mb-5">
                        <img src="{{ str_starts_with($blog->image, 'http') ? $blog->image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($blog->image, '/') }}" alt="{{ $blog->title }}" class="img-fluid rounded shadow-sm w-100" style="max-height: 500px; object-fit: cover;">
                    </div>
                    @endif

                    <div class="blog-text fs-5" style="line-height: 1.8;">
                        {!! $blog->content !!}
                    </div>

                    <div class="border-top mt-5 pt-4 d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Category:</strong>
                            <a href="{{ route('blogs') }}" class="text-decoration-none ms-2">{{ $blog->category ? $blog->category->name : 'Uncategorized' }}</a>
                        </div>
                        <div>
                            <strong>Share:</strong>
                            <a href="#" class="text-muted ms-3"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="text-muted ms-3"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#" class="text-muted ms-3"><i class="fa-brands fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Blogs -->
    @if(isset($recent_blogs) && $recent_blogs->count() > 0)
    <section class="recent-blogs ptb-70" style="background-color: #F8F9FA;">
        <div class="container">
            <h3 class="fw-bold mb-4">Related Articles</h3>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($recent_blogs as $recent)
                <div class="col">
                    <div class="blog-card h-100 bg-white rounded shadow-sm" style="border: 1px solid #eee;">
                        <div class="blog-img-wrapper" style="height: 200px; overflow: hidden; border-radius: 5px 5px 0 0;">
                            <img src="{{ $recent->image ? (str_starts_with($recent->image, 'http') ? $recent->image : rtrim(env('BACKEND_URL', 'http://127.0.0.1:8001'), '/') . '/' . ltrim($recent->image, '/')) : asset('assets/images/blog-img-1.png') }}" alt="{{ $recent->title }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                        </div>
                        <div class="blog-card-body p-4 d-flex flex-column h-100">
                            <div class="mb-auto">
                                <span class="badge bg-light text-primary mb-2" style="border: 1px solid #dee2e6;">{{ $recent->category ? $recent->category->name : 'Uncategorized' }}</span>
                                <h4 class="h5 mb-3"><a href="{{ route('blog.detail', $recent->slug) }}" class="text-dark text-decoration-none">{{ Str::limit($recent->title, 50) }}</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</main>
@endsection
