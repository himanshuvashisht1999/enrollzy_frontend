@extends('layouts.app')
@section('content')
<main class="about-hero-section ptb-70">
      <div class="bg-square">
        <img src="assets/images/banner-square-img.svg" alt="" />
      </div>
      <div class="container">
        <div class="about-hero-container">
          <img src="assets/images/school-banner-img.png" alt="" />

          <!-- Centered Badge (Placed outside card to prevent clipping) -->
          <div class="about-us-badge-wrapper">
            <button class="about-us-badge">All Schools</button>
            <p>Explore our complete list of schools.</p>
          </div>

          <!-- Green Down Arrow Button -->
          <button class="about-scroll-btn" aria-label="Scroll Down">
            <img
              style="width: 49px; height: 62px"
              src="assets/images/inner-banner-down-arror.png"
              alt=""
            />
          </button>
        </div>
      </div>
    </main>

    <!-- Breadcrumb path & Explore Button -->
    <div class="py-3" style="background-color: #f9ad0b14">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="font-size: 13.5px; font-weight: 500;">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted"><i class="fa-solid fa-house me-1"></i> Home</a></li>
                    <li class="breadcrumb-item active text-primary" aria-current="page">Schools</li>
                </ol>
            </nav>
        </div>
    </div>
    <div style="background-color: #3771C812;padding: 20px 0px;text-align: center;">
    <a href="#" class="btn btn-primary rounded-pill px-4" style="background-color: #3771C8; border: none; font-size: 14px; font-weight: bold; height: 34px; display: inline-flex; align-items: center; justify-content: center;">Explore Schools</a>

    </div>
    <!-- Main Content Section -->
    <section class="py-5" style="background-color: #FAFBFD;">
        <div class="container">
            <!-- School Hero Intro Card -->
            <div class="school-hero-card">
                <h2 class="school-hero-title">Top Boarding Schools in India 2026-27: Fees, Admissions, Rankings & Reviews</h2>
                <p class="school-hero-text">We've curated a list of best Boarding Schools in India for 2026-27, sorted by our default Rankings, a trusted system on a holistic evaluation of a school's academic excellence, infrastructure, extracurriculars, teacher quality, and real parent reviews (<a href="#" class="text-primary text-decoration-none">learn more</a>).</p>
                <p class="school-hero-text text-muted mb-0" style="font-size: 13px;">The top 10 Boarding Schools in India include The Doon School, The Scindia School, Woodstock School, JAIN International Residential School, Aspyreom International Finishing School, Mussoorie International School, Welham Boys' School, The Academic City School - Bangalore, GD Goenka International School, Welham Girls' School. Scroll down to compare fees and admissions, read reviews, and apply to find the perfect school for your child.</p>
            </div>

            <div class="row g-4">
                <!-- Left Sidebar Filters -->
                <div class="col-lg-3 col-md-4">
                    <div class="filter-sidebar-wrapper">
                       
                        <!-- Regions Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterRegions" aria-expanded="true">
                                <span>Regions</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterRegions">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="reg1"><label class="form-check-label ms-1" for="reg1">North India</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="reg2"><label class="form-check-label ms-1" for="reg2">South India</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="reg3"><label class="form-check-label ms-1" for="reg3">East India</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="reg4"><label class="form-check-label ms-1" for="reg4">West India</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="reg5"><label class="form-check-label ms-1" for="reg5">Central India</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- State Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterState" aria-expanded="true">
                                <span>State</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterState">
                                <div class="filter-group-body">
                                    <div class="filter-search-wrapper mb-3">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="text" placeholder="Search by state name" class="form-control">
                                    </div>
                                    <div class="filter-checklist" style=" overflow-y: auto;">
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="st1"><label class="form-check-label ms-1" for="st1">Tamil Nadu</label></div><span class="text-muted" style="font-size: 11.5px;">(14)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="st2"><label class="form-check-label ms-1" for="st2">Karnataka</label></div><span class="text-muted" style="font-size: 11.5px;">(14)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="st3"><label class="form-check-label ms-1" for="st3">Andhra Pradesh</label></div><span class="text-muted" style="font-size: 11.5px;">(14)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="st4"><label class="form-check-label ms-1" for="st4">Rajasthan</label></div><span class="text-muted" style="font-size: 11.5px;">(14)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="st5"><label class="form-check-label ms-1" for="st5">Punjab</label></div><span class="text-muted" style="font-size: 11.5px;">(14)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="st6"><label class="form-check-label ms-1" for="st6">Himachal Pradesh</label></div><span class="text-muted" style="font-size: 11.5px;">(14)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="st7"><label class="form-check-label ms-1" for="st7">Haryana</label></div><span class="text-muted" style="font-size: 11.5px;">(14)</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- City Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterCity" aria-expanded="false">
                                <span>City</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse" id="filterCity">
                                <div class="filter-group-body">
                                    <div class="filter-search-wrapper mb-3">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="text" placeholder="Search by city name" class="form-control">
                                    </div>
                                    <div class="filter-checklist">
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cy1"><label class="form-check-label ms-1" for="cy1">Bangalore</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cy2"><label class="form-check-label ms-1" for="cy2">Dehradun</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cy3"><label class="form-check-label ms-1" for="cy3">Hyderabad</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cy3"><label class="form-check-label ms-1" for="cy3">Panchgani</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cy3"><label class="form-check-label ms-1" for="cy3">Varanasi</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cy3"><label class="form-check-label ms-1" for="cy3">Nainital</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cy3"><label class="form-check-label ms-1" for="cy3">Patna</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Area Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterArea" aria-expanded="false">
                                <span>Area</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse" id="filterArea">
                                <div class="filter-group-body">
                                    <div class="filter-search-wrapper mb-3">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                        <input type="text" placeholder="Search by area name" class="form-control">
                                    </div>
                                    <div class="filter-checklist">
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="ar1"><label class="form-check-label ms-1" for="ar1">Mansarovar, Jaipur</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="ar2"><label class="form-check-label ms-1" for="ar2">Rohini, Delhi</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="ar2"><label class="form-check-label ms-1" for="ar2">Vaishali Nagar, Jaipur</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="ar2"><label class="form-check-label ms-1" for="ar2">Medchal, Jaipur</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="ar2"><label class="form-check-label ms-1" for="ar2">Chandigarh, Punjab</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="ar2"><label class="form-check-label ms-1" for="ar2">Mansarovar, Jaipur</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="ar2"><label class="form-check-label ms-1" for="ar2">Mansarovar, Jaipur</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Annual Fees Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterFees" aria-expanded="true">
                                <span>Annual Fees</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterFees">
                                <div class="filter-group-body">
                                    <span class="text-muted fw-bold d-block mb-2" style="font-size: 11px; text-transform: uppercase;">Suggestion</span>
                                    <div class="filter-checklist mb-3">
                                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="fee_sugg" id="fs1"><label class="form-check-label ms-1" for="fs1">Below 1 lakh</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="fee_sugg" id="fs2"><label class="form-check-label ms-1" for="fs2">1 lakh to 2 lakhs</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="fee_sugg" id="fs3"><label class="form-check-label ms-1" for="fs3">2 lakh to 3 lakhs</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="fee_sugg" id="fs4"><label class="form-check-label ms-1" for="fs4">3 lakh to 5 lakhs</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="fee_sugg" id="fs4"><label class="form-check-label ms-1" for="fs4">3 lakh to 5 lakhs</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="fee_sugg" id="fs4"><label class="form-check-label ms-1" for="fs4">3 lakh to 5 lakhs</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="radio" name="fee_sugg" id="fs4"><label class="form-check-label ms-1" for="fs4">3 lakh to 5 lakhs</label></div>
                                    </div>
                                    <span class="text-muted fw-bold d-block mb-2" style="font-size: 11px; text-transform: uppercase;">Enter Manually</span>
                                    <div class="d-flex gap-2">
                                        <input type="text" placeholder="From" class="form-control text-center py-1" style="font-size: 12.5px; border-radius: 6px;">
                                        <input type="text" placeholder="To" class="form-control text-center py-1" style="font-size: 12.5px; border-radius: 6px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Class Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterClass" aria-expanded="false">
                                <span>Class</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse" id="filterClass">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cl1"><label class="form-check-label ms-1" for="cl1">Toddlers</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cl2"><label class="form-check-label ms-1" for="cl2">Pre Nursery</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cl3"><label class="form-check-label ms-1" for="cl3">Nursery</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cl3"><label class="form-check-label ms-1" for="cl3">LKG</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cl3"><label class="form-check-label ms-1" for="cl3">UKG</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cl3"><label class="form-check-label ms-1" for="cl3">Class 1</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="cl3"><label class="form-check-label ms-1" for="cl3">Class 2</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Board Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterBoard" aria-expanded="false">
                                <span>Board</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse" id="filterBoard">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd1"><label class="form-check-label ms-1" for="bd1">CBSE</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd2"><label class="form-check-label ms-1" for="bd2">ICSE/CISE</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd3"><label class="form-check-label ms-1" for="bd3">State Board</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd3"><label class="form-check-label ms-1" for="bd3">NIOS</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd3"><label class="form-check-label ms-1" for="bd3">Finland</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd3"><label class="form-check-label ms-1" for="bd3">Finland</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd3"><label class="form-check-label ms-1" for="bd3">Finland</label></div>
                                        <div class="form-check mb-2"><input class="form-check-input" type="checkbox" id="bd3"><label class="form-check-label ms-1" for="bd3">Finland</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ownership Accordion -->
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterOwnership" aria-expanded="false">
                                <span>Ownership</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterOwnership">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct1"><label class="form-check-label ms-1" for="sct1">Goverment</label></div><span class="text-muted" style="font-size: 11px;">(28)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct2" checked><label class="form-check-label ms-1" for="sct2">Private</label></div><span class="text-muted" style="font-size: 11px;">(1427)</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterSchoolType" aria-expanded="true">
                                <span>School Type</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterSchoolType">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct1"><label class="form-check-label ms-1" for="sct1">Weekly Boarding</label></div><span class="text-muted" style="font-size: 11px;">(28)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct2" checked><label class="form-check-label ms-1" for="sct2">Day Boarding</label></div><span class="text-muted" style="font-size: 11px;">(1427)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct3"><label class="form-check-label ms-1" for="sct3">Full Boarding</label></div><span class="text-muted" style="font-size: 11px;">(714)</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterSchoolType" aria-expanded="true">
                                <span>Food Options</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterSchoolType">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct1"><label class="form-check-label ms-1" for="sct1">Vegetarian</label></div><span class="text-muted" style="font-size: 11px;">(28)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct2" checked><label class="form-check-label ms-1" for="sct2">Non Vegetarian</label></div><span class="text-muted" style="font-size: 11px;">(1427)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct3"><label class="form-check-label ms-1" for="sct3">Eggetarian</label></div><span class="text-muted" style="font-size: 11px;">(714)</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-group-card mb-3">
                            <div class="filter-group-header d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#filterSchoolType" aria-expanded="true">
                                <span>Gender</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="collapse show" id="filterSchoolType">
                                <div class="filter-group-body">
                                    <div class="filter-checklist">
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct1"><label class="form-check-label ms-1" for="sct1">Coed</label></div><span class="text-muted" style="font-size: 11px;">(28)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct2" checked><label class="form-check-label ms-1" for="sct2">Boys</label></div><span class="text-muted" style="font-size: 11px;">(1427)</span></div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2"><div><input class="form-check-input" type="checkbox" id="sct3"><label class="form-check-label ms-1" for="sct3">Girls</label></div><span class="text-muted" style="font-size: 11px;">(714)</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right catalog list grid -->
                <div class="col-lg-9 col-md-8">
                    <!-- Title header info -->
                    <div class="catalog-header-bar d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-bold" style="font-size: 16px; color: #3771C8;">Boarding Schools in India</span>
                            <span class="text-muted" style="font-size: 16px;">- 1467 Schools | Updated at : 07 Jul 2026, 11:52 am</span>
                        </div>
                    </div>

                    <!-- Schools Grid row -->
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        
                        <!-- Card 1: The Doon School -->
                        <div class="col">
                            <div class="school-card">
                                <div class="swiper school-image-swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="assets/images/about_tablet_use.png" alt="The Doon School View 1">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/about_team_meeting.png" alt="The Doon School View 2">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/blog_1.png" alt="The Doon School View 3">
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <span class="school-rating-badge"><i class="fa-solid fa-star"></i> 4.5</span>
                                    <span class="school-gender-badge">Boys</span>
                                    <button class="btn-school-compare">Compare</button>
                                </div>
                                <div class="school-info-body">
                                    <div class="school-identity-row">
                                        <div class="school-logo-box">
                                            <img src="assets/images/school-card-logo.png" alt="The Doon School Logo">
                                        </div>
                                        <div class="school-identity-text">
                                            <h3 class="school-name">The Doon School</h3>
                                            <span class="school-location"><i class="fa-solid fa-location-dot me-1 text-muted"></i> Dehradun, Uttarakhand</span>
                                        </div>
                                    </div>
                                    <div class="school-stats-grid">
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Annual Fees</span>
                                            <span class="school-stat-val">₹ 26.12 L</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Board</span>
                                            <a href="#" class="school-stat-val underlined">ICSE, IB Board +1</a>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Classes</span>
                                            <span class="school-stat-val">7 - 12 Class</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Established in</span>
                                            <span class="school-stat-val">1935</span>
                                        </div>
                                    </div>
                                    <p class="school-card-desc">The Doon School, Dehradun, is India's premier all-boys' boarding school known for academic excellence and holistic development. Set on a lush 70-acre campus, it offers IB, IGCSE, and ISC curricula, top-notch facilities, and 40+ extracurriculars. With a legacy of producing leaders like Rajiv Gandhi and Abhinav</p>
                                    <div class="school-card-actions">
                                        <button class="btn-school-call"><i class="fa-solid fa-phone"></i> Call School</button>
                                        <button class="btn-school-callback">Request a Callback <i class="fa-solid fa-chevron-right ms-1" style="font-size: 9px;"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Mayo College -->
                        <div class="col">
                            <div class="school-card">
                                <div class="swiper school-image-swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-1.png" alt="Mayo College View 1">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-2.png" alt="Mayo College View 2">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-3.png" alt="Mayo College View 3">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-4.png" alt="Mayo College View 3">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-5.png" alt="Mayo College View 3">
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <span class="school-rating-badge"><i class="fa-solid fa-star"></i> 4.6</span>
                                    <span class="school-gender-badge">Boys</span>
                                    <button class="btn-school-compare">Compare</button>
                                </div>
                                <div class="school-info-body">
                                    <div class="school-identity-row">
                                        <div class="school-logo-box">
                                            <img src="assets/images/school-card-logo.png" alt="Mayo College Logo">
                                        </div>
                                        <div class="school-identity-text">
                                            <h3 class="school-name">Mayo College</h3>
                                            <span class="school-location"><i class="fa-solid fa-location-dot me-1 text-muted"></i> Ajmer, Rajasthan</span>
                                        </div>
                                    </div>
                                    <div class="school-stats-grid">
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Annual Fees</span>
                                            <span class="school-stat-val">₹ 14.50 L</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Board</span>
                                            <a href="#" class="school-stat-val underlined">CBSE Board</a>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Classes</span>
                                            <span class="school-stat-val">4 - 12 Class</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Established in</span>
                                            <span class="school-stat-val">1875</span>
                                        </div>
                                    </div>
                                    <p class="school-card-desc">Mayo College in Ajmer is one of the oldest and most prestigious boarding schools in India. Combining classic traditions with modern learning, it features a vast, stunning campus, rich heritage, state-of-the-art sports facilities, and strong character-building programs.</p>
                                    <div class="school-card-actions">
                                        <button class="btn-school-call"><i class="fa-solid fa-phone"></i> Call School</button>
                                        <button class="btn-school-callback">Request a Callback <i class="fa-solid fa-chevron-right ms-1" style="font-size: 9px;"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Welham Girls' School -->
                        <div class="col">
                            <div class="school-card">
                                <div class="swiper school-image-swiper">
                                     <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-1.png" alt="Mayo College View 1">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-2.png" alt="Mayo College View 2">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-3.png" alt="Mayo College View 3">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-4.png" alt="Mayo College View 3">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-5.png" alt="Mayo College View 3">
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <span class="school-rating-badge"><i class="fa-solid fa-star"></i> 4.7</span>
                                    <span class="school-gender-badge" style="background-color: #E02424;">Girls</span>
                                    <button class="btn-school-compare">Compare</button>
                                </div>
                                <div class="school-info-body">
                                    <div class="school-identity-row">
                                        <div class="school-logo-box">
                                            <img src="assets/images/school-card-logo.png" alt="Welham Girls Logo">
                                        </div>
                                        <div class="school-identity-text">
                                            <h3 class="school-name">Welham Girls' School</h3>
                                            <span class="school-location"><i class="fa-solid fa-location-dot me-1 text-muted"></i> Dehradun, Uttarakhand</span>
                                        </div>
                                    </div>
                                    <div class="school-stats-grid">
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Annual Fees</span>
                                            <span class="school-stat-val">₹ 16.80 L</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Board</span>
                                            <a href="#" class="school-stat-val underlined">ICSE, ISC Board</a>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Classes</span>
                                            <span class="school-stat-val">6 - 12 Class</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Established in</span>
                                            <span class="school-stat-val">1957</span>
                                        </div>
                                    </div>
                                    <p class="school-card-desc">Welham Girls' School is a top-tier residential school for girls in Dehradun. It aims to provide a progressive education system that empowers girls to think independently, foster leadership skills, excel in academics, and lead meaningful social changes.</p>
                                    <div class="school-card-actions">
                                        <button class="btn-school-call"><i class="fa-solid fa-phone"></i> Call School</button>
                                        <button class="btn-school-callback">Request a Callback <i class="fa-solid fa-chevron-right ms-1" style="font-size: 9px;"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4: Bishop Cotton School -->
                        <div class="col">
                            <div class="school-card">
                                <div class="swiper school-image-swiper">
                                     <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-1.png" alt="Mayo College View 1">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-2.png" alt="Mayo College View 2">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-3.png" alt="Mayo College View 3">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-4.png" alt="Mayo College View 3">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-5.png" alt="Mayo College View 3">
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <span class="school-rating-badge"><i class="fa-solid fa-star"></i> 4.4</span>
                                    <span class="school-gender-badge">Boys</span>
                                    <button class="btn-school-compare">Compare</button>
                                </div>
                                <div class="school-info-body">
                                    <div class="school-identity-row">
                                        <div class="school-logo-box">
                                            <img src="assets/images/school-card-logo.png" alt="Bishop Cotton Logo">
                                        </div>
                                        <div class="school-identity-text">
                                            <h3 class="school-name">Bishop Cotton School</h3>
                                            <span class="school-location"><i class="fa-solid fa-location-dot me-1 text-muted"></i> Shimla, Himachal Pradesh</span>
                                        </div>
                                    </div>
                                    <div class="school-stats-grid">
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Annual Fees</span>
                                            <span class="school-stat-val">₹ 9.20 L</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Board</span>
                                            <a href="#" class="school-stat-val underlined">ICSE, ISC Board</a>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Classes</span>
                                            <span class="school-stat-val">3 - 12 Class</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Established in</span>
                                            <span class="school-stat-val">1859</span>
                                        </div>
                                    </div>
                                    <p class="school-card-desc">Bishop Cotton School is one of the oldest boarding schools in Asia, perched in the hills of Shimla. The school offers a structured, holistic environment focused on academic distinction, sportsmanship, and developing well-rounded global citizens.</p>
                                    <div class="school-card-actions">
                                        <button class="btn-school-call"><i class="fa-solid fa-phone"></i> Call School</button>
                                        <button class="btn-school-callback">Request a Callback <i class="fa-solid fa-chevron-right ms-1" style="font-size: 9px;"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 5: Scindia School -->
                        <div class="col">
                            <div class="school-card">
                                <div class="swiper school-image-swiper">
                                     <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-1.png" alt="Mayo College View 1">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-2.png" alt="Mayo College View 2">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-3.png" alt="Mayo College View 3">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-4.png" alt="Mayo College View 3">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-5.png" alt="Mayo College View 3">
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <span class="school-rating-badge"><i class="fa-solid fa-star"></i> 4.3</span>
                                    <span class="school-gender-badge">Boys</span>
                                    <button class="btn-school-compare">Compare</button>
                                </div>
                                <div class="school-info-body">
                                    <div class="school-identity-row">
                                        <div class="school-logo-box">
                                            <img src="assets/images/school-card-logo.png" alt="Scindia Logo">
                                        </div>
                                        <div class="school-identity-text">
                                            <h3 class="school-name">Scindia School</h3>
                                            <span class="school-location"><i class="fa-solid fa-location-dot me-1 text-muted"></i> Gwalior, Madhya Pradesh</span>
                                        </div>
                                    </div>
                                    <div class="school-stats-grid">
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Annual Fees</span>
                                            <span class="school-stat-val">₹ 13.25 L</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Board</span>
                                            <a href="#" class="school-stat-val underlined">CBSE Board</a>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Classes</span>
                                            <span class="school-stat-val">6 - 12 Class</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Established in</span>
                                            <span class="school-stat-val">1897</span>
                                        </div>
                                    </div>
                                    <p class="school-card-desc">The Scindia School is an outstanding all-boys boarding school located inside the historic Gwalior Fort. It focuses on nurturing self-discipline, academic vigor, creative exploration, and leadership qualities for students from diverse backgrounds.</p>
                                    <div class="school-card-actions">
                                        <button class="btn-school-call"><i class="fa-solid fa-phone"></i> Call School</button>
                                        <button class="btn-school-callback">Request a Callback <i class="fa-solid fa-chevron-right ms-1" style="font-size: 9px;"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 6: Lawrence School -->
                        <div class="col">
                            <div class="school-card">
                                <div class="swiper school-image-swiper">
                                     <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-1.png" alt="Mayo College View 1">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-2.png" alt="Mayo College View 2">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-3.png" alt="Mayo College View 3">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-4.png" alt="Mayo College View 3">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/school-img-5.png" alt="Mayo College View 3">
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <span class="school-rating-badge"><i class="fa-solid fa-star"></i> 4.5</span>
                                    <span class="school-gender-badge" style="background-color: #10B981;">Co-Ed</span>
                                    <button class="btn-school-compare">Compare</button>
                                </div>
                                <div class="school-info-body">
                                    <div class="school-identity-row">
                                        <div class="school-logo-box">
                                            <img src="assets/images/school-card-logo.png" alt="Lawrence Logo">
                                        </div>
                                        <div class="school-identity-text">
                                            <h3 class="school-name">Lawrence School</h3>
                                            <span class="school-location"><i class="fa-solid fa-location-dot me-1 text-muted"></i> Lovedale, Tamil Nadu</span>
                                        </div>
                                    </div>
                                    <div class="school-stats-grid">
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Annual Fees</span>
                                            <span class="school-stat-val">₹ 8.50 L</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Board</span>
                                            <a href="#" class="school-stat-val underlined">CBSE Board</a>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Classes</span>
                                            <span class="school-stat-val">5 - 12 Class</span>
                                        </div>
                                        <div class="school-stat-col">
                                            <span class="school-stat-lbl">Established in</span>
                                            <span class="school-stat-val">1858</span>
                                        </div>
                                    </div>
                                    <p class="school-card-desc">The Lawrence School at Lovedale is a premium co-educational boarding school set in the scenic Nilgiri Hills. It offers a well-balanced learning ecosystem that drives academic, physical, and moral excellence across all grade levels.</p>
                                    <div class="school-card-actions">
                                        <button class="btn-school-call"><i class="fa-solid fa-phone"></i> Call School</button>
                                        <button class="btn-school-callback">Request a Callback <i class="fa-solid fa-chevron-right ms-1" style="font-size: 9px;"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    

                </div>
            </div>
        </div>
    </section>

  

    <!-- Curved Footer Section -->

   

  
   
   
    <!-- Bootstrap Bundle JS -->
@endsection
