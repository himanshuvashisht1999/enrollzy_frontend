@extends('layouts.app')
@section('content')
<main class="about-hero-section ptb-70">
      <div class="bg-square">
        <img src="{{ asset('assets/images/banner-square-img.svg') }}" alt="" />
      </div>
      <div class="container">
        <div class="about-hero-container">
          <img src="{{ asset('assets/images/blog-banner-img.png') }}" alt="" />

          <!-- Centered Badge (Placed outside card to prevent clipping) -->
          <div class="about-us-badge-wrapper">
            <button class="about-us-badge">All Blogs</button>
            <p>
              Check out the top student benefits and programs designed for your
              success.
            </p>
          </div>

          <!-- Green Down Arrow Button -->
          <button class="about-scroll-btn" aria-label="Scroll Down">
            <img
              style="width: 49px; height: 62px"
              src="{{ asset('assets/images/inner-banner-down-arror.png') }}"
              alt=""
            />
          </button>
        </div>
      </div>
    </main>
    <!-- Breadcrumb path -->
    <div class="py-3" style="background-color: #f9ad0b14">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol
            class="breadcrumb mb-0"
            style="font-size: 13.5px; font-weight: 500"
          >
            <li class="breadcrumb-item">
              <a href="#" class="text-decoration-none text-muted"
                ><i class="fa-solid fa-house me-1"></i> Home</a
              >
            </li>
            <li class="breadcrumb-item active text-primary" aria-current="page">
              Blogs
            </li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- Main Content wrapper -->
    <div class="ptb-70">
      <div class="container">
        <!-- Section Header -->
        <div class="text-center heading-card">
          <div
            class="heading-with-lines d-flex align-items-center justify-content-center gap-3 mb-3"
          >
            <span class="heading-line d-none d-md-block"></span>
            <h2 class="section-title mb-0">Explore Our Insights</h2>
            <span class="heading-line d-none d-md-block"></span>
          </div>
          <p
            class="section-subtitle mx-auto text-muted"
            style="max-width: 900px"
          >
            Stay updated with the latest news, guides, and stories from our
            college.
          </p>
        </div>

        <!-- Blogs Grid (4 Columns) -->
        <div
          class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4"
        >
          <!-- Card 1 -->
          <div class="col">
            <div class="blog-card">
              <div class="blog-card-banner">
                <img src="{{ asset('assets/images/school-img-1.png') }}" alt="BBA vs BCom vs BA" />
              </div>
              <div class="blog-card-body">
                <span class="blog-badge">BBA vs B.Com</span>
                <h3 class="blog-title">
                  BBA vs BCom vs BA: Which Course is Better for Your Care...
                </h3>
                <div class="blog-meta">
                  <span
                    ><i class="fa-regular fa-user me-1"></i> Admin User</span
                  >
                  <span
                    ><i class="fa-regular fa-calendar me-1"></i> 25 Jul,
                    2026</span
                  >
                </div>
                <button class="btn-blog-read">
                  Read more
                  <i
                    class="fa-solid fa-arrow-right"
                    style="font-size: 10px"
                  ></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Card 2 -->
          <div class="col">
            <div class="blog-card">
              <div class="blog-card-banner">
                <img src="{{ asset('assets/images/school-img-2.png') }}" alt="BBA vs BCom vs BA" />
              </div>
              <div class="blog-card-body">
                <span class="blog-badge">Updates</span>
                <h3 class="blog-title">
                  BBA vs BCom vs BA: Which Course is Better for Your Care...
                </h3>
                <div class="blog-meta">
                  <span
                    ><i class="fa-regular fa-user me-1"></i> Admin User</span
                  >
                  <span
                    ><i class="fa-regular fa-calendar me-1"></i> 25 Jul,
                    2026</span
                  >
                </div>
                <button class="btn-blog-read">
                  Read more
                  <i
                    class="fa-solid fa-arrow-right"
                    style="font-size: 10px"
                  ></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Card 3 -->
          <div class="col">
            <div class="blog-card">
              <div class="blog-card-banner">
                <img src="{{ asset('assets/images/school-img-3.png') }}" alt="BBA vs BCom vs BA" />
              </div>
              <div class="blog-card-body">
                <span class="blog-badge">Important</span>
                <h3 class="blog-title">
                  BBA vs BCom vs BA: Which Course is Better for Your Care...
                </h3>
                <div class="blog-meta">
                  <span
                    ><i class="fa-regular fa-user me-1"></i> Admin User</span
                  >
                  <span
                    ><i class="fa-regular fa-calendar me-1"></i> 25 Jul,
                    2026</span
                  >
                </div>
                <button class="btn-blog-read">
                  Read more
                  <i
                    class="fa-solid fa-arrow-right"
                    style="font-size: 10px"
                  ></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Card 4 -->
          <div class="col">
            <div class="blog-card">
              <div class="blog-card-banner">
                <img src="{{ asset('assets/images/school-img-4.png') }}" alt="BBA vs BCom vs BA" />
              </div>
              <div class="blog-card-body">
                <span class="blog-badge">Online MBA</span>
                <h3 class="blog-title">
                  BBA vs BCom vs BA: Which Course is Better for Your Care...
                </h3>
                <div class="blog-meta">
                  <span
                    ><i class="fa-regular fa-user me-1"></i> Admin User</span
                  >
                  <span
                    ><i class="fa-regular fa-calendar me-1"></i> 25 Jul,
                    2026</span
                  >
                </div>
                <button class="btn-blog-read">
                  Read more
                  <i
                    class="fa-solid fa-arrow-right"
                    style="font-size: 10px"
                  ></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Card 5 -->
          <div class="col">
            <div class="blog-card">
              <div class="blog-card-banner">
                <img src="{{ asset('assets/images/school-img-5.png') }}" alt="BBA vs BCom vs BA" />
              </div>
              <div class="blog-card-body">
                <span class="blog-badge">BBA vs B.Com</span>
                <h3 class="blog-title">
                  BBA vs BCom vs BA: Which Course is Better for Your Care...
                </h3>
                <div class="blog-meta">
                  <span
                    ><i class="fa-regular fa-user me-1"></i> Admin User</span
                  >
                  <span
                    ><i class="fa-regular fa-calendar me-1"></i> 25 Jul,
                    2026</span
                  >
                </div>
                <button class="btn-blog-read">
                  Read more
                  <i
                    class="fa-solid fa-arrow-right"
                    style="font-size: 10px"
                  ></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Card 6 -->
          <div class="col">
            <div class="blog-card">
              <div class="blog-card-banner">
                <img src="{{ asset('assets/images/school-img-1.png') }}" alt="BBA vs BCom vs BA" />
              </div>
              <div class="blog-card-body">
                <span class="blog-badge">Updates</span>
                <h3 class="blog-title">
                  BBA vs BCom vs BA: Which Course is Better for Your Care...
                </h3>
                <div class="blog-meta">
                  <span
                    ><i class="fa-regular fa-user me-1"></i> Admin User</span
                  >
                  <span
                    ><i class="fa-regular fa-calendar me-1"></i> 25 Jul,
                    2026</span
                  >
                </div>
                <button class="btn-blog-read">
                  Read more
                  <i
                    class="fa-solid fa-arrow-right"
                    style="font-size: 10px"
                  ></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Card 7 -->
          <div class="col">
            <div class="blog-card">
              <div class="blog-card-banner">
                <img src="{{ asset('assets/images/school-img-2.png') }}" alt="BBA vs BCom vs BA" />
              </div>
              <div class="blog-card-body">
                <span class="blog-badge">Important</span>
                <h3 class="blog-title">
                  BBA vs BCom vs BA: Which Course is Better for Your Care...
                </h3>
                <div class="blog-meta">
                  <span
                    ><i class="fa-regular fa-user me-1"></i> Admin User</span
                  >
                  <span
                    ><i class="fa-regular fa-calendar me-1"></i> 25 Jul,
                    2026</span
                  >
                </div>
                <button class="btn-blog-read">
                  Read more
                  <i
                    class="fa-solid fa-arrow-right"
                    style="font-size: 10px"
                  ></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Card 8 -->
          <div class="col">
            <div class="blog-card">
              <div class="blog-card-banner">
                <img src="{{ asset('assets/images/school-img-3.png') }}" alt="BBA vs BCom vs BA" />
              </div>
              <div class="blog-card-body">
                <span class="blog-badge">Online MBA</span>
                <h3 class="blog-title">
                  BBA vs BCom vs BA: Which Course is Better for Your Care...
                </h3>
                <div class="blog-meta">
                  <span
                    ><i class="fa-regular fa-user me-1"></i> Admin User</span
                  >
                  <span
                    ><i class="fa-regular fa-calendar me-1"></i> 25 Jul,
                    2026</span
                  >
                </div>
                <button class="btn-blog-read">
                  Read more
                  <i
                    class="fa-solid fa-arrow-right"
                    style="font-size: 10px"
                  ></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Card 9 -->
          <div class="col">
            <div class="blog-card">
              <div class="blog-card-banner">
                <img src="{{ asset('assets/images/school-img-4.png') }}" alt="BBA vs BCom vs BA" />
              </div>
              <div class="blog-card-body">
                <span class="blog-badge">BBA vs B.Com</span>
                <h3 class="blog-title">
                  BBA vs BCom vs BA: Which Course is Better for Your Care...
                </h3>
                <div class="blog-meta">
                  <span
                    ><i class="fa-regular fa-user me-1"></i> Admin User</span
                  >
                  <span
                    ><i class="fa-regular fa-calendar me-1"></i> 25 Jul,
                    2026</span
                  >
                </div>
                <button class="btn-blog-read">
                  Read more
                  <i
                    class="fa-solid fa-arrow-right"
                    style="font-size: 10px"
                  ></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Card 10 -->
          <div class="col">
            <div class="blog-card">
              <div class="blog-card-banner">
                <img src="{{ asset('assets/images/school-img-5.png') }}" alt="BBA vs BCom vs BA" />
              </div>
              <div class="blog-card-body">
                <span class="blog-badge">Updates</span>
                <h3 class="blog-title">
                  BBA vs BCom vs BA: Which Course is Better for Your Care...
                </h3>
                <div class="blog-meta">
                  <span
                    ><i class="fa-regular fa-user me-1"></i> Admin User</span
                  >
                  <span
                    ><i class="fa-regular fa-calendar me-1"></i> 25 Jul,
                    2026</span
                  >
                </div>
                <button class="btn-blog-read">
                  Read more
                  <i
                    class="fa-solid fa-arrow-right"
                    style="font-size: 10px"
                  ></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Card 11 -->
          <div class="col">
            <div class="blog-card">
              <div class="blog-card-banner">
                <img src="{{ asset('assets/images/school-img-1.png') }}" alt="BBA vs BCom vs BA" />
              </div>
              <div class="blog-card-body">
                <span class="blog-badge">Important</span>
                <h3 class="blog-title">
                  BBA vs BCom vs BA: Which Course is Better for Your Care...
                </h3>
                <div class="blog-meta">
                  <span
                    ><i class="fa-regular fa-user me-1"></i> Admin User</span
                  >
                  <span
                    ><i class="fa-regular fa-calendar me-1"></i> 25 Jul,
                    2026</span
                  >
                </div>
                <button class="btn-blog-read">
                  Read more
                  <i
                    class="fa-solid fa-arrow-right"
                    style="font-size: 10px"
                  ></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Card 12 -->
          <div class="col">
            <div class="blog-card">
              <div class="blog-card-banner">
                <img src="{{ asset('assets/images/school-img-3.png') }}" alt="BBA vs BCom vs BA" />
              </div>
              <div class="blog-card-body">
                <span class="blog-badge">Online MBA</span>
                <h3 class="blog-title">
                  BBA vs BCom vs BA: Which Course is Better for Your Care...
                </h3>
                <div class="blog-meta">
                  <span
                    ><i class="fa-regular fa-user me-1"></i> Admin User</span
                  >
                  <span
                    ><i class="fa-regular fa-calendar me-1"></i> 25 Jul,
                    2026</span
                  >
                </div>
                <button class="btn-blog-read">
                  Read more
                  <i
                    class="fa-solid fa-arrow-right"
                    style="font-size: 10px"
                  ></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
@endsection
