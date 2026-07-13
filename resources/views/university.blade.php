@extends('layouts.app')
@section('content')
<!-- Main Content Section -->
    <main class="about-hero-section ptb-70">
      <div class="bg-square">
        <img src="assets/images/banner-square-img.svg" alt="" />
      </div>
      <div class="container">
        <div class="about-hero-container">
          <img src="assets/images/university-banner-img.png" alt="" />

          <!-- Centered Badge (Placed outside card to prevent clipping) -->
          <div class="about-us-badge-wrapper">
            <button class="about-us-badge">All University</button>
            <p>Explore our complete list of universities.</p>
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
    <!-- Partner Logos Band -->
    <div class="univ-partner-band">
      <div class="container">
        <div class="univ-partner-logos-row">
          <!-- Logo 1 -->
          <div class="univ-logo-circle">
            <img src="assets/images/uni-icon.png" alt="" />
          </div>
          <!-- Logo 2 -->
          <div class="univ-logo-circle">
            <img src="assets/images/uni-icon.png" alt="" />
          </div>
          <!-- Logo 3 -->
          <div class="univ-logo-circle">
            <img src="assets/images/uni-icon.png" alt="" />
          </div>
          <!-- Logo 4 -->
          <div class="univ-logo-circle">
            <img src="assets/images/uni-icon.png" alt="" />
          </div>
          <!-- Logo 5 (Repeated for density) -->
          <div class="univ-logo-circle">
            <img src="assets/images/uni-icon.png" alt="" />
          </div>
          <!-- Logo 6 -->
          <div class="univ-logo-circle">
            <img src="assets/images/uni-icon.png" alt="" />
          </div>
          <!-- Logo 7 -->
          <div class="univ-logo-circle">
            <img src="assets/images/uni-icon.png" alt="" />
          </div>
          <!-- Logo 8 -->
          <div class="univ-logo-circle">
            <img src="assets/images/uni-icon.png" alt="" />
          </div>
          <!-- Logo 9 -->
          <div class="univ-logo-circle">
            <img src="assets/images/uni-icon.png" alt="" />
          </div>
        </div>
      </div>
    </div>

    <!-- Breadcrumb path -->
    <div class="py-3" style="background-color: #f9ad0b14">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol
            class="breadcrumb mb-0"
            style="font-size: 13.5px; font-weight: 500; color: #000"
          >
            <li class="breadcrumb-item">
              <a href="#" class="text-decoration-none" style="color: #000"
                ><i class="fa-solid fa-house me-1"></i> Home</a
              >
            </li>
            <li class="breadcrumb-item active text-primary" aria-current="page">
              Universities
            </li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- Main Catalog Section -->
    <section class="univ-catalog-section">
      <div class="container">
        <div class="row g-4">
          <!-- Left Sidebar Filters -->
          <div class="col-lg-3 col-md-4">
            <!-- Showing Count Card -->
            <div class="showing-count-card mb-3">
              Showing
              <span class="text-primary fw-bold">2000</span> Universities
            </div>

            <!-- Sidebar Filter wrapper -->
            <div class="filter-sidebar-wrapper">
              <div
                class="d-flex justify-content-between align-items-center mb-3"
              >
                <h4
                  class="fw-bold mb-0"
                  style="font-size: 15px; color: #0d1b2a"
                >
                  Filters By
                </h4>
                <a
                  href="#"
                  class="text-decoration-none text-primary fw-bold"
                  style="font-size: 13px"
                  >Reset All</a
                >
              </div>

              <!-- Streams Accordion Block -->
              <div class="filter-group-card mb-3">
                <div
                  class="filter-group-header d-flex justify-content-between align-items-center"
                  data-bs-toggle="collapse"
                  data-bs-target="#filterStreams"
                  aria-expanded="true"
                >
                  <span>Streams</span>
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="collapse show" id="filterStreams">
                  <div class="filter-group-body">
                    <div class="filter-search-wrapper mb-3">
                      <i class="fa-solid fa-magnifying-glass"></i>
                      <input
                        type="text"
                        placeholder="Search by streams"
                        class="form-control"
                      />
                    </div>
                    <div class="filter-checklist">
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream1"
                            checked
                          />
                          <label class="form-check-label ms-1" for="stream1"
                            >Management</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream2"
                          />
                          <label class="form-check-label ms-1" for="stream2"
                            >Engineering</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream3"
                          />
                          <label class="form-check-label ms-1" for="stream3"
                            >Medical</label
                          >
                        </div>
                        <span class="filter-count">(2783)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream4"
                          />
                          <label class="form-check-label ms-1" for="stream4"
                            >Commerce</label
                          >
                        </div>
                        <span class="filter-count">(3783)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream5"
                          />
                          <label class="form-check-label ms-1" for="stream5"
                            >Civil Engg.</label
                          >
                        </div>
                        <span class="filter-count">(2783)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream1"
                          />
                          <label class="form-check-label ms-1" for="stream1"
                            >Management</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream1"
                          />
                          <label class="form-check-label ms-1" for="stream1"
                            >Management</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Course Groups Accordion Block -->
              <div class="filter-group-card mb-3">
                <div
                  class="filter-group-header d-flex justify-content-between align-items-center"
                  data-bs-toggle="collapse"
                  data-bs-target="#filterCourseGroups"
                  aria-expanded="false"
                >
                  <span>Course Groups</span>
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="collapse" id="filterCourseGroups">
                  <div class="filter-group-body">
                    <div class="filter-search-wrapper mb-3">
                      <i class="fa-solid fa-magnifying-glass"></i>
                      <input
                        type="text"
                        placeholder="Search by streams"
                        class="form-control"
                      />
                    </div>
                    <div class="filter-checklist">
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream1"
                            checked
                          />
                          <label class="form-check-label ms-1" for="stream1"
                            >Management</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream2"
                          />
                          <label class="form-check-label ms-1" for="stream2"
                            >Engineering</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream3"
                          />
                          <label class="form-check-label ms-1" for="stream3"
                            >Medical</label
                          >
                        </div>
                        <span class="filter-count">(2783)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream4"
                          />
                          <label class="form-check-label ms-1" for="stream4"
                            >Commerce</label
                          >
                        </div>
                        <span class="filter-count">(3783)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream5"
                          />
                          <label class="form-check-label ms-1" for="stream5"
                            >Civil Engg.</label
                          >
                        </div>
                        <span class="filter-count">(2783)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream1"
                          />
                          <label class="form-check-label ms-1" for="stream1"
                            >Management</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream1"
                          />
                          <label class="form-check-label ms-1" for="stream1"
                            >Management</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- States Accordion Block -->
              <div class="filter-group-card mb-3">
                <div
                  class="filter-group-header d-flex justify-content-between align-items-center"
                  data-bs-toggle="collapse"
                  data-bs-target="#filterStates"
                  aria-expanded="false"
                >
                  <span>States</span>
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="collapse" id="filterStates">
                  <div class="filter-group-body">
                    <div class="filter-search-wrapper mb-3">
                      <i class="fa-solid fa-magnifying-glass"></i>
                      <input
                        type="text"
                        placeholder="Search by streams"
                        class="form-control"
                      />
                    </div>
                    <div class="filter-checklist">
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream1"
                            checked
                          />
                          <label class="form-check-label ms-1" for="stream1"
                            >Management</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream2"
                          />
                          <label class="form-check-label ms-1" for="stream2"
                            >Engineering</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream3"
                          />
                          <label class="form-check-label ms-1" for="stream3"
                            >Medical</label
                          >
                        </div>
                        <span class="filter-count">(2783)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream4"
                          />
                          <label class="form-check-label ms-1" for="stream4"
                            >Commerce</label
                          >
                        </div>
                        <span class="filter-count">(3783)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream5"
                          />
                          <label class="form-check-label ms-1" for="stream5"
                            >Civil Engg.</label
                          >
                        </div>
                        <span class="filter-count">(2783)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream1"
                          />
                          <label class="form-check-label ms-1" for="stream1"
                            >Management</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream1"
                          />
                          <label class="form-check-label ms-1" for="stream1"
                            >Management</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Cities Accordion Block -->
              <div class="filter-group-card mb-3">
                <div
                  class="filter-group-header d-flex justify-content-between align-items-center"
                  data-bs-toggle="collapse"
                  data-bs-target="#filterCities"
                  aria-expanded="false"
                >
                  <span>Cities</span>
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="collapse" id="filterCities">
                  <div class="filter-group-body">
                    <div class="filter-search-wrapper mb-3">
                      <i class="fa-solid fa-magnifying-glass"></i>
                      <input
                        type="text"
                        placeholder="Search by streams"
                        class="form-control"
                      />
                    </div>
                    <div class="filter-checklist">
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream1"
                            checked
                          />
                          <label class="form-check-label ms-1" for="stream1"
                            >Management</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream2"
                          />
                          <label class="form-check-label ms-1" for="stream2"
                            >Engineering</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream3"
                          />
                          <label class="form-check-label ms-1" for="stream3"
                            >Medical</label
                          >
                        </div>
                        <span class="filter-count">(2783)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream4"
                          />
                          <label class="form-check-label ms-1" for="stream4"
                            >Commerce</label
                          >
                        </div>
                        <span class="filter-count">(3783)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream5"
                          />
                          <label class="form-check-label ms-1" for="stream5"
                            >Civil Engg.</label
                          >
                        </div>
                        <span class="filter-count">(2783)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream1"
                          />
                          <label class="form-check-label ms-1" for="stream1"
                            >Management</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream1"
                          />
                          <label class="form-check-label ms-1" for="stream1"
                            >Management</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Exams Accordion Block -->
              <div class="filter-group-card mb-3">
                <div
                  class="filter-group-header d-flex justify-content-between align-items-center"
                  data-bs-toggle="collapse"
                  data-bs-target="#filterExams"
                  aria-expanded="false"
                >
                  <span>Exams</span>
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="collapse" id="filterExams">
                  <div class="filter-group-body">
                    <div class="filter-search-wrapper mb-3">
                      <i class="fa-solid fa-magnifying-glass"></i>
                      <input
                        type="text"
                        placeholder="Search by streams"
                        class="form-control"
                      />
                    </div>
                    <div class="filter-checklist">
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream1"
                            checked
                          />
                          <label class="form-check-label ms-1" for="stream1"
                            >Management</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream2"
                          />
                          <label class="form-check-label ms-1" for="stream2"
                            >Engineering</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream3"
                          />
                          <label class="form-check-label ms-1" for="stream3"
                            >Medical</label
                          >
                        </div>
                        <span class="filter-count">(2783)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream4"
                          />
                          <label class="form-check-label ms-1" for="stream4"
                            >Commerce</label
                          >
                        </div>
                        <span class="filter-count">(3783)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream5"
                          />
                          <label class="form-check-label ms-1" for="stream5"
                            >Civil Engg.</label
                          >
                        </div>
                        <span class="filter-count">(2783)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream1"
                          />
                          <label class="form-check-label ms-1" for="stream1"
                            >Management</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="stream1"
                          />
                          <label class="form-check-label ms-1" for="stream1"
                            >Management</label
                          >
                        </div>
                        <span class="filter-count">(22703)</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Institutes Accordion Block -->
              <div class="filter-group-card">
                <div
                  class="filter-group-header d-flex justify-content-between align-items-center"
                  data-bs-toggle="collapse"
                  data-bs-target="#filterInstitutes"
                  aria-expanded="false"
                >
                  <span>Institutes</span>
                  <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="collapse" id="filterInstitutes">
                  <div class="filter-group-body">
                    <div class="filter-checklist">
                      <div
                        class="form-check d-flex align-items-center gap-2 mb-2"
                      >
                        <div>
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="inst1"
                          />
                          <label class="form-check-label ms-1" for="inst1"
                            >Private</label
                          >
                        </div>
                        <span class="filter-count">(1530)</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Right catalog listing grid -->
          <div class="col-lg-9 col-md-8">
            <!-- Sorting & active filter row -->
            <div
              class="catalog-header-bar d-flex justify-content-between align-items-center flex-wrap gap-3"
            >
              <div class="d-flex align-items-center gap-2 flex-wrap">
                <span
                  class="text-muted fw-bold"
                  style="font-size: 13.5px; color: #000000 !important"
                  >Active Filters:</span
                >
                <button class="filter-pill">
                  All University
                  <i class="fa-solid fa-xmark"></i>
                </button>
              </div>
              <select class="form-select catalog-sort-select">
                <option selected>Recommended</option>
                <option>Popularity</option>
                <option>Fee: Low to High</option>
                <option>Fee: High to Low</option>
              </select>
            </div>
            <div
              class="catalog-header-bar d-flex justify-content-between align-items-center flex-wrap gap-3"
            >
              <div class="d-flex align-items-center gap-2 flex-wrap">
                <span
                  class="text-muted fw-bold"
                  style="font-size: 13.5px; color: #000000 !important"
                  >Filters By</span
                >
              </div>
              <a
                href="#"
                class="text-decoration-none text-primary fw-bold"
                style="font-size: 13px"
                >Reset All</a
              >
            </div>

            <!-- Cards Row Grid -->
            <div class="row row-cols-1 row-cols-md-2 g-4 mt-5 uni-detail-col">
              <!-- Card 1 -->
              <div class="col">
                <div class="univ-card">
                  <div class="univ-card-logo">
                    <img src="assets/images/uni-icon.png" alt="" />
                  </div>
                  <h3 class="univ-card-name">
                    IIM Ahmedabad Indian Institute of Management
                  </h3>
                  <p class="univ-card-meta">
                    <i class="fa-solid fa-location-dot me-1 text-muted"></i>
                    Ahmedabad &bull; Public/Government
                  </p>
                  <div class="univ-card-exams">Exam Accepted:</div>
                  <div class="univ-card-stats">
                    <div class="univ-stat-row">
                      <span class="exam-accepted"
                        >CAT <span class="univ-stat-value">+1 More</span></span
                      >

                      <span class="univ-stat-label"
                        >Fees:
                        <span class="univ-stat-value"
                          >₹ 51.50 k - 10.78 L</span
                        ></span
                      >
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Median Salary:</span>
                      <span class="univ-stat-value">₹ 15.0 L - 20.0 L</span>
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Total Courses:</span>
                      <span class="univ-stat-value">19 Courses</span>
                    </div>
                  </div>
                  <div class="univ-card-actions">
                    <button
                      class="btn-action-compare"
                      style="
                        background-color: #f3f3f3;
                        border: 1px solid #dcdcdc;
                      "
                    >
                      <img src="assets/images/compare-icon.png" alt="" />
                      Compare
                    </button>
                    <button class="btn-action-brochure">
                      Brochure
                      <img src="assets/images/download-icon.png" alt="" />
                    </button>
                    <button class="btn-action-apply">
                      Apply Now
                      <img src="assets/images/right-icon.png" alt="" />
                    </button>
                  </div>
                  <div class="univ-card-footer-links">
                    <a href="#">Placement</a>
                    <span class="separator">|</span>
                    <a href="#">Admission</a>
                    <span class="separator">|</span>
                    <a href="#">Facilities</a>
                    <span class="separator">|</span>
                    <a href="#">Ranking</a>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="univ-card">
                  <div class="univ-card-logo">
                    <img src="assets/images/uni-icon.png" alt="" />
                  </div>
                  <h3 class="univ-card-name">
                    IIM Ahmedabad Indian Institute of Management
                  </h3>
                  <p class="univ-card-meta">
                    <i class="fa-solid fa-location-dot me-1 text-muted"></i>
                    Ahmedabad &bull; Public/Government
                  </p>
                  <div class="univ-card-exams">Exam Accepted:</div>
                  <div class="univ-card-stats">
                    <div class="univ-stat-row">
                      <span class="exam-accepted"
                        >CAT <span class="univ-stat-value">+1 More</span></span
                      >

                      <span class="univ-stat-label"
                        >Fees:
                        <span class="univ-stat-value"
                          >₹ 51.50 k - 10.78 L</span
                        ></span
                      >
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Median Salary:</span>
                      <span class="univ-stat-value">₹ 15.0 L - 20.0 L</span>
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Total Courses:</span>
                      <span class="univ-stat-value">19 Courses</span>
                    </div>
                  </div>
                  <div class="univ-card-actions">
                    <button
                      class="btn-action-compare"
                      style="
                        background-color: #f3f3f3;
                        border: 1px solid #dcdcdc;
                      "
                    >
                      <img src="assets/images/compare-icon.png" alt="" />
                      Compare
                    </button>
                    <button class="btn-action-brochure">
                      Brochure
                      <img src="assets/images/download-icon.png" alt="" />
                    </button>
                    <button class="btn-action-apply">
                      Apply Now
                      <img src="assets/images/right-icon.png" alt="" />
                    </button>
                  </div>
                  <div class="univ-card-footer-links">
                    <a href="#">Placement</a>
                    <span class="separator">|</span>
                    <a href="#">Admission</a>
                    <span class="separator">|</span>
                    <a href="#">Facilities</a>
                    <span class="separator">|</span>
                    <a href="#">Ranking</a>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="univ-card">
                  <span class="univ-ranking-badge"
                    ><img src="assets/images/star-icon.png" alt="" />Ranking
                    #25</span
                  >
                  <div class="univ-card-logo">
                    <img src="assets/images/uni-icon.png" alt="" />
                  </div>
                  <h3 class="univ-card-name">
                    IIM Ahmedabad Indian Institute of Management
                  </h3>
                  <p class="univ-card-meta">
                    <i class="fa-solid fa-location-dot me-1 text-muted"></i>
                    Ahmedabad &bull; Public/Government
                  </p>
                  <div class="univ-card-exams">Exam Accepted:</div>
                  <div class="univ-card-stats">
                    <div class="univ-stat-row">
                      <span class="exam-accepted"
                        >CAT <span class="univ-stat-value">+1 More</span></span
                      >

                      <span class="univ-stat-label"
                        >Fees:
                        <span class="univ-stat-value"
                          >₹ 51.50 k - 10.78 L</span
                        ></span
                      >
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Median Salary:</span>
                      <span class="univ-stat-value">₹ 15.0 L - 20.0 L</span>
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Total Courses:</span>
                      <span class="univ-stat-value">19 Courses</span>
                    </div>
                  </div>
                  <div class="univ-card-actions">
                    <button
                      class="btn-action-compare"
                      style="
                        background-color: #f3f3f3;
                        border: 1px solid #dcdcdc;
                      "
                    >
                      <img src="assets/images/compare-icon.png" alt="" />
                      Compare
                    </button>
                    <button class="btn-action-brochure">
                      Brochure
                      <img src="assets/images/download-icon.png" alt="" />
                    </button>
                    <button class="btn-action-apply">
                      Apply Now
                      <img src="assets/images/right-icon.png" alt="" />
                    </button>
                  </div>
                  <div class="univ-card-footer-links">
                    <a href="#">Placement</a>
                    <span class="separator">|</span>
                    <a href="#">Admission</a>
                    <span class="separator">|</span>
                    <a href="#">Facilities</a>
                    <span class="separator">|</span>
                    <a href="#">Ranking</a>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="univ-card">
                  <div class="univ-card-logo">
                    <img src="assets/images/uni-icon.png" alt="" />
                  </div>
                  <h3 class="univ-card-name">
                    IIM Ahmedabad Indian Institute of Management
                  </h3>
                  <p class="univ-card-meta">
                    <i class="fa-solid fa-location-dot me-1 text-muted"></i>
                    Ahmedabad &bull; Public/Government
                  </p>
                  <div class="univ-card-exams">Exam Accepted:</div>
                  <div class="univ-card-stats">
                    <div class="univ-stat-row">
                      <span class="exam-accepted"
                        >CAT <span class="univ-stat-value">+1 More</span></span
                      >

                      <span class="univ-stat-label"
                        >Fees:
                        <span class="univ-stat-value"
                          >₹ 51.50 k - 10.78 L</span
                        ></span
                      >
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Median Salary:</span>
                      <span class="univ-stat-value">₹ 15.0 L - 20.0 L</span>
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Total Courses:</span>
                      <span class="univ-stat-value">19 Courses</span>
                    </div>
                  </div>
                  <div class="univ-card-actions">
                    <button
                      class="btn-action-compare"
                      style="
                        background-color: #f3f3f3;
                        border: 1px solid #dcdcdc;
                      "
                    >
                      <img src="assets/images/compare-icon.png" alt="" />
                      Compare
                    </button>
                    <button class="btn-action-brochure">
                      Brochure
                      <img src="assets/images/download-icon.png" alt="" />
                    </button>
                    <button class="btn-action-apply">
                      Apply Now
                      <img src="assets/images/right-icon.png" alt="" />
                    </button>
                  </div>
                  <div class="univ-card-footer-links">
                    <a href="#">Placement</a>
                    <span class="separator">|</span>
                    <a href="#">Admission</a>
                    <span class="separator">|</span>
                    <a href="#">Facilities</a>
                    <span class="separator">|</span>
                    <a href="#">Ranking</a>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="univ-card">
                  <span class="univ-ranking-badge"
                    ><img src="assets/images/star-icon.png" alt="" />Ranking
                    #25</span
                  >
                  <div class="univ-card-logo">
                    <img src="assets/images/uni-icon.png" alt="" />
                  </div>
                  <h3 class="univ-card-name">
                    IIM Ahmedabad Indian Institute of Management
                  </h3>
                  <p class="univ-card-meta">
                    <i class="fa-solid fa-location-dot me-1 text-muted"></i>
                    Ahmedabad &bull; Public/Government
                  </p>
                  <div class="univ-card-exams">Exam Accepted:</div>
                  <div class="univ-card-stats">
                    <div class="univ-stat-row">
                      <span class="exam-accepted"
                        >CAT <span class="univ-stat-value">+1 More</span></span
                      >

                      <span class="univ-stat-label"
                        >Fees:
                        <span class="univ-stat-value"
                          >₹ 51.50 k - 10.78 L</span
                        ></span
                      >
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Median Salary:</span>
                      <span class="univ-stat-value">₹ 15.0 L - 20.0 L</span>
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Total Courses:</span>
                      <span class="univ-stat-value">19 Courses</span>
                    </div>
                  </div>
                  <div class="univ-card-actions">
                    <button
                      class="btn-action-compare"
                      style="
                        background-color: #f3f3f3;
                        border: 1px solid #dcdcdc;
                      "
                    >
                      <img src="assets/images/compare-icon.png" alt="" />
                      Compare
                    </button>
                    <button class="btn-action-brochure">
                      Brochure
                      <img src="assets/images/download-icon.png" alt="" />
                    </button>
                    <button class="btn-action-apply">
                      Apply Now
                      <img src="assets/images/right-icon.png" alt="" />
                    </button>
                  </div>
                  <div class="univ-card-footer-links">
                    <a href="#">Placement</a>
                    <span class="separator">|</span>
                    <a href="#">Admission</a>
                    <span class="separator">|</span>
                    <a href="#">Facilities</a>
                    <span class="separator">|</span>
                    <a href="#">Ranking</a>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="univ-card">
                  <div class="univ-card-logo">
                    <img src="assets/images/uni-icon.png" alt="" />
                  </div>
                  <h3 class="univ-card-name">
                    IIM Ahmedabad Indian Institute of Management
                  </h3>
                  <p class="univ-card-meta">
                    <i class="fa-solid fa-location-dot me-1 text-muted"></i>
                    Ahmedabad &bull; Public/Government
                  </p>
                  <div class="univ-card-exams">Exam Accepted:</div>
                  <div class="univ-card-stats">
                    <div class="univ-stat-row">
                      <span class="exam-accepted"
                        >CAT <span class="univ-stat-value">+1 More</span></span
                      >

                      <span class="univ-stat-label"
                        >Fees:
                        <span class="univ-stat-value"
                          >₹ 51.50 k - 10.78 L</span
                        ></span
                      >
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Median Salary:</span>
                      <span class="univ-stat-value">₹ 15.0 L - 20.0 L</span>
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Total Courses:</span>
                      <span class="univ-stat-value">19 Courses</span>
                    </div>
                  </div>
                  <div class="univ-card-actions">
                    <button
                      class="btn-action-compare"
                      style="
                        background-color: #f3f3f3;
                        border: 1px solid #dcdcdc;
                      "
                    >
                      <img src="assets/images/compare-icon.png" alt="" />
                      Compare
                    </button>
                    <button class="btn-action-brochure">
                      Brochure
                      <img src="assets/images/download-icon.png" alt="" />
                    </button>
                    <button class="btn-action-apply">
                      Apply Now
                      <img src="assets/images/right-icon.png" alt="" />
                    </button>
                  </div>
                  <div class="univ-card-footer-links">
                    <a href="#">Placement</a>
                    <span class="separator">|</span>
                    <a href="#">Admission</a>
                    <span class="separator">|</span>
                    <a href="#">Facilities</a>
                    <span class="separator">|</span>
                    <a href="#">Ranking</a>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="univ-card">
                  <span class="univ-ranking-badge"
                    ><img src="assets/images/star-icon.png" alt="" />Ranking
                    #25</span
                  >
                  <div class="univ-card-logo">
                    <img src="assets/images/uni-icon.png" alt="" />
                  </div>
                  <h3 class="univ-card-name">
                    IIM Ahmedabad Indian Institute of Management
                  </h3>
                  <p class="univ-card-meta">
                    <i class="fa-solid fa-location-dot me-1 text-muted"></i>
                    Ahmedabad &bull; Public/Government
                  </p>
                  <div class="univ-card-exams">Exam Accepted:</div>
                  <div class="univ-card-stats">
                    <div class="univ-stat-row">
                      <span class="exam-accepted"
                        >CAT <span class="univ-stat-value">+1 More</span></span
                      >

                      <span class="univ-stat-label"
                        >Fees:
                        <span class="univ-stat-value"
                          >₹ 51.50 k - 10.78 L</span
                        ></span
                      >
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Median Salary:</span>
                      <span class="univ-stat-value">₹ 15.0 L - 20.0 L</span>
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Total Courses:</span>
                      <span class="univ-stat-value">19 Courses</span>
                    </div>
                  </div>
                  <div class="univ-card-actions">
                    <button
                      class="btn-action-compare"
                      style="
                        background-color: #f3f3f3;
                        border: 1px solid #dcdcdc;
                      "
                    >
                      <img src="assets/images/compare-icon.png" alt="" />
                      Compare
                    </button>
                    <button class="btn-action-brochure">
                      Brochure
                      <img src="assets/images/download-icon.png" alt="" />
                    </button>
                    <button class="btn-action-apply">
                      Apply Now
                      <img src="assets/images/right-icon.png" alt="" />
                    </button>
                  </div>
                  <div class="univ-card-footer-links">
                    <a href="#">Placement</a>
                    <span class="separator">|</span>
                    <a href="#">Admission</a>
                    <span class="separator">|</span>
                    <a href="#">Facilities</a>
                    <span class="separator">|</span>
                    <a href="#">Ranking</a>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="univ-card">
                  <div class="univ-card-logo">
                    <img src="assets/images/uni-icon.png" alt="" />
                  </div>
                  <h3 class="univ-card-name">
                    IIM Ahmedabad Indian Institute of Management
                  </h3>
                  <p class="univ-card-meta">
                    <i class="fa-solid fa-location-dot me-1 text-muted"></i>
                    Ahmedabad &bull; Public/Government
                  </p>
                  <div class="univ-card-exams">Exam Accepted:</div>
                  <div class="univ-card-stats">
                    <div class="univ-stat-row">
                      <span class="exam-accepted"
                        >CAT <span class="univ-stat-value">+1 More</span></span
                      >

                      <span class="univ-stat-label"
                        >Fees:
                        <span class="univ-stat-value"
                          >₹ 51.50 k - 10.78 L</span
                        ></span
                      >
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Median Salary:</span>
                      <span class="univ-stat-value">₹ 15.0 L - 20.0 L</span>
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Total Courses:</span>
                      <span class="univ-stat-value">19 Courses</span>
                    </div>
                  </div>
                  <div class="univ-card-actions">
                    <button
                      class="btn-action-compare"
                      style="
                        background-color: #f3f3f3;
                        border: 1px solid #dcdcdc;
                      "
                    >
                      <img src="assets/images/compare-icon.png" alt="" />
                      Compare
                    </button>
                    <button class="btn-action-brochure">
                      Brochure
                      <img src="assets/images/download-icon.png" alt="" />
                    </button>
                    <button class="btn-action-apply">
                      Apply Now
                      <img src="assets/images/right-icon.png" alt="" />
                    </button>
                  </div>
                  <div class="univ-card-footer-links">
                    <a href="#">Placement</a>
                    <span class="separator">|</span>
                    <a href="#">Admission</a>
                    <span class="separator">|</span>
                    <a href="#">Facilities</a>
                    <span class="separator">|</span>
                    <a href="#">Ranking</a>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="univ-card">
                  <span class="univ-ranking-badge"
                    ><img src="assets/images/star-icon.png" alt="" />Ranking
                    #25</span
                  >
                  <div class="univ-card-logo">
                    <img src="assets/images/uni-icon.png" alt="" />
                  </div>
                  <h3 class="univ-card-name">
                    IIM Ahmedabad Indian Institute of Management
                  </h3>
                  <p class="univ-card-meta">
                    <i class="fa-solid fa-location-dot me-1 text-muted"></i>
                    Ahmedabad &bull; Public/Government
                  </p>
                  <div class="univ-card-exams">Exam Accepted:</div>
                  <div class="univ-card-stats">
                    <div class="univ-stat-row">
                      <span class="exam-accepted"
                        >CAT <span class="univ-stat-value">+1 More</span></span
                      >

                      <span class="univ-stat-label"
                        >Fees:
                        <span class="univ-stat-value"
                          >₹ 51.50 k - 10.78 L</span
                        ></span
                      >
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Median Salary:</span>
                      <span class="univ-stat-value">₹ 15.0 L - 20.0 L</span>
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Total Courses:</span>
                      <span class="univ-stat-value">19 Courses</span>
                    </div>
                  </div>
                  <div class="univ-card-actions">
                    <button
                      class="btn-action-compare"
                      style="
                        background-color: #f3f3f3;
                        border: 1px solid #dcdcdc;
                      "
                    >
                      <img src="assets/images/compare-icon.png" alt="" />
                      Compare
                    </button>
                    <button class="btn-action-brochure">
                      Brochure
                      <img src="assets/images/download-icon.png" alt="" />
                    </button>
                    <button class="btn-action-apply">
                      Apply Now
                      <img src="assets/images/right-icon.png" alt="" />
                    </button>
                  </div>
                  <div class="univ-card-footer-links">
                    <a href="#">Placement</a>
                    <span class="separator">|</span>
                    <a href="#">Admission</a>
                    <span class="separator">|</span>
                    <a href="#">Facilities</a>
                    <span class="separator">|</span>
                    <a href="#">Ranking</a>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="univ-card">
                  <div class="univ-card-logo">
                    <img src="assets/images/uni-icon.png" alt="" />
                  </div>
                  <h3 class="univ-card-name">
                    IIM Ahmedabad Indian Institute of Management
                  </h3>
                  <p class="univ-card-meta">
                    <i class="fa-solid fa-location-dot me-1 text-muted"></i>
                    Ahmedabad &bull; Public/Government
                  </p>
                  <div class="univ-card-exams">Exam Accepted:</div>
                  <div class="univ-card-stats">
                    <div class="univ-stat-row">
                      <span class="exam-accepted"
                        >CAT <span class="univ-stat-value">+1 More</span></span
                      >

                      <span class="univ-stat-label"
                        >Fees:
                        <span class="univ-stat-value"
                          >₹ 51.50 k - 10.78 L</span
                        ></span
                      >
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Median Salary:</span>
                      <span class="univ-stat-value">₹ 15.0 L - 20.0 L</span>
                    </div>
                    <div class="univ-stat-row">
                      <span class="univ-stat-label">Total Courses:</span>
                      <span class="univ-stat-value">19 Courses</span>
                    </div>
                  </div>
                  <div class="univ-card-actions">
                    <button
                      class="btn-action-compare"
                      style="
                        background-color: #f3f3f3;
                        border: 1px solid #dcdcdc;
                      "
                    >
                      <img src="assets/images/compare-icon.png" alt="" />
                      Compare
                    </button>
                    <button class="btn-action-brochure">
                      Brochure
                      <img src="assets/images/download-icon.png" alt="" />
                    </button>
                    <button class="btn-action-apply">
                      Apply Now
                      <img src="assets/images/right-icon.png" alt="" />
                    </button>
                  </div>
                  <div class="univ-card-footer-links">
                    <a href="#">Placement</a>
                    <span class="separator">|</span>
                    <a href="#">Admission</a>
                    <span class="separator">|</span>
                    <a href="#">Facilities</a>
                    <span class="separator">|</span>
                    <a href="#">Ranking</a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pagination -->
            <div class="inner-pagination-wrapper">
              <nav aria-label="Catalog Page Navigation">
                <ul class="pagination">
                  <li class="page-item me-4">
                    <a class="page-link" href="#">Prev</a>
                  </li>
                  <li class="page-item active">
                    <a class="page-num active" href="#">1</a>
                  </li>
                  <li class="page-item"><a class="page-num" href="#">2</a></li>
                  <li class="page-item"><a class="page-num" href="#">3</a></li>
                  <li class="page-item"><a class="page-num" href="#">4</a></li>
                  <li class="page-item"><a class="page-num" href="#">5</a></li>
                  <li class="page-item">
                    <a class="page-num" href="#">6...</a>
                  </li>
                  <li class="page-item ms-4">
                    <a class="page-link " style="background-color: #3771C8;color: #fff;" href="#">Next</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Curved Footer Section -->
@endsection
