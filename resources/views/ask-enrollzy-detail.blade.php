@extends('layouts.app')

@section('content')
<main class="about-hero-section ptb-70 pb-0">
    <div class="bg-square">
        <img style="height: auto;" src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
    </div>
    <div class="ask-page-wrapper">
        <div class="container py-4">

            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('ask.enrollzy') }}" class="text-decoration-none text-muted">AskEnrollzy</a></li>
                    @if($question->category)
                        <li class="breadcrumb-item"><a href="{{ route('ask.enrollzy', ['category' => $question->category->id]) }}" class="text-decoration-none text-muted">{{ $question->category->name }}</a></li>
                    @endif
                    <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Question #{{ $question->id }}</li>
                </ol>
            </nav>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4">
                <!-- Left Main Column: Question & Answers -->
                <div class="col-lg-8 col-12">
                    
                    <!-- Main Question Box -->
                    <div class="post-card mb-4 shadow-sm border-0 rounded-4 p-4" style="background: #fff;">
                        <div class="post-header mb-3">
                            <div class="d-flex align-items-center gap-2">
                                @php
                                    $avatar = asset('assets/images/team_member_1.png');
                                    if (!empty($question->user->avatar)) {
                                        $avatar = str_starts_with($question->user->avatar, 'http') ? $question->user->avatar : asset('storage/' . $question->user->avatar);
                                    }
                                @endphp
                                <img src="{{ $avatar }}" class="post-author-avatar rounded-circle" style="width: 44px; height: 44px; object-fit: cover;" alt="Avatar" onError="this.src='{{ asset('assets/images/team_member_1.png') }}'">
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">{{ $question->user->name ?? 'Enrollzy Member' }}</h6>
                                    <span class="post-time text-muted small">{{ $question->created_at ? $question->created_at->diffForHumans() : 'Recently' }}</span>
                                    @if($question->category)
                                        <span class="badge bg-primary-subtle text-primary ms-2 fw-normal" style="font-size: 0.75rem;">{{ $question->category->name }}</span>
                                    @endif
                                </div>
                            </div>
                            <span class="badge bg-light text-secondary ms-auto"><i class="fa-regular fa-eye me-1"></i> {{ $question->views }} views</span>
                        </div>

                        <h1 class="post-title fs-3 fw-bold text-dark mb-3" style="line-height: 1.4;">{{ $question->question_text }}</h1>

                        @if(!empty($question->image))
                            @php
                                $imgUrl = asset('storage/' . $question->image);
                                if (str_starts_with($question->image, 'http')) {
                                    $imgUrl = $question->image;
                                } elseif (file_exists(public_path('assets/images/' . $question->image))) {
                                    $imgUrl = asset('assets/images/' . $question->image);
                                }
                            @endphp
                            <div class="my-3 text-center bg-light p-2 rounded-3">
                                <img src="{{ $imgUrl }}" class="img-fluid rounded-3" style="max-height: 450px; object-fit: contain;" alt="Question Attached Image">
                            </div>
                        @endif

                        <div class="post-footer-buttons d-flex align-items-center gap-2 pt-3 border-top mt-4">
                            <a href="#" class="post-pill-btn text-decoration-none btn-vote-toggle" data-question-id="{{ $question->id }}"><i class="fa-solid fa-arrow-up text-primary"></i> <span class="vote-count-span">{{ $question->likes_count ?? ($question->likes ? $question->likes->count() : 0) }}</span> Upvotes</a>
                            <a href="#reply-form" class="post-pill-btn text-decoration-none"><i class="fa-regular fa-comment"></i> {{ $question->replies_count ?? ($question->replies ? $question->replies->count() : 0) }} Answers</a>
                            <a href="#" class="post-pill-btn text-decoration-none" onclick="copyQuestionUrl(event)"><i class="fa-solid fa-arrow-up-from-bracket"></i> Share</a>
                        </div>
                    </div>

                    <!-- Answers / Replies Section -->
                    <div class="answers-section mb-4">
                        <h4 class="fw-bold text-dark mb-3">
                            <i class="fa-regular fa-comments text-primary me-2"></i> Answers & Counselor Responses ({{ $question->replies ? $question->replies->count() : 0 }})
                        </h4>

                        @forelse($question->replies as $reply)
                            <div class="card border-0 shadow-sm rounded-4 mb-3 p-3" style="background: #ffffff;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        @php
                                            $replyAvatar = asset('assets/images/mentor_1.png');
                                            if (!empty($reply->user->avatar)) {
                                                $replyAvatar = str_starts_with($reply->user->avatar, 'http') ? $reply->user->avatar : asset('storage/' . $reply->user->avatar);
                                            }
                                        @endphp
                                        <img src="{{ $replyAvatar }}" class="rounded-circle" style="width: 36px; height: 36px; object-fit: cover;" alt="User Avatar" onError="this.src='{{ asset('assets/images/mentor_1.png') }}'">
                                        <div>
                                            <span class="fw-bold text-dark d-block leading-tight">{{ $reply->user->name ?? 'Academic Counselor' }}</span>
                                            <span class="text-muted small">{{ $reply->created_at ? $reply->created_at->diffForHumans() : 'Recently' }}</span>
                                        </div>
                                    </div>
                                    <p class="card-text text-dark mb-0 fs-6 mt-2" style="white-space: pre-line;">
                                        {{ $reply->content }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-light">
                                <i class="fa-solid fa-user-pen fa-2x text-muted mb-2"></i>
                                <h6 class="fw-bold text-dark mb-1">No answers yet</h6>
                                <p class="text-muted small mb-0">Be the first to share your guidance or experience!</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Post an Answer Box -->
                    <div class="card border-0 shadow-sm rounded-4 p-4" id="reply-form" style="background: #EBF3FC;">
                        <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-reply text-primary me-2"></i> Post Your Answer</h5>
                        <form action="{{ route('ask.enrollzy.reply.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                            <div class="mb-3">
                                <textarea name="content" class="form-control rounded-3 border-0 p-3" rows="4" placeholder="Write your answer, guidance, or details clearly..." required style="background: #fff;"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold" style="background-color: #3771C8; border: none;">
                                <i class="fa-solid fa-paper-plane me-1"></i> Submit Answer
                            </button>
                        </form>
                    </div>

                </div>

                <!-- Right Column: Sidebar -->
                <div class="col-lg-4 col-12">
                    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4" style="background: #fff;">
                        <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">Related Questions</h5>
                        <ul class="list-unstyled mb-0">
                            @forelse($relatedQuestions as $relQ)
                                <li class="mb-3 pb-2 border-bottom">
                                    <a href="{{ route('ask.enrollzy.detail', $relQ->id) }}" class="text-decoration-none text-dark fw-semibold small d-block mb-1">
                                        {{ $relQ->question_text }}
                                    </a>
                                    <span class="text-muted small" style="font-size: 11px;">
                                        <i class="fa-regular fa-eye me-1"></i> {{ $relQ->views }} views
                                    </span>
                                </li>
                            @empty
                                <p class="text-muted small mb-0">No related questions in this category.</p>
                            @endforelse
                        </ul>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 p-3" style="background: #EBF3FC;">
                        <h6 class="fw-bold text-dark mb-2">Back to Discussions</h6>
                        <p class="text-muted small mb-3">Explore more student questions and community guidelines.</p>
                        <a href="{{ route('ask.enrollzy') }}" class="btn btn-outline-primary rounded-pill btn-sm w-100 fw-bold">
                            <i class="fa-solid fa-arrow-left me-1"></i> View All Questions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function copyQuestionUrl(e) {
    e.preventDefault();
    navigator.clipboard.writeText(window.location.href).then(() => {
        alert("Question link copied to clipboard!");
    });
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-vote-toggle').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const qId = this.getAttribute('data-question-id');
            const countSpan = this.querySelector('.vote-count-span');

            fetch("{{ route('ask.enrollzy.like') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ question_id: qId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && countSpan) {
                    countSpan.textContent = data.likes_count;
                }
            })
            .catch(err => console.error(err));
        });
    });
});
</script>
@endsection
