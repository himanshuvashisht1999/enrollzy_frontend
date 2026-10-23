@extends('layouts.app')

@section('meta_title', $page->meta_title ?? 'Cookie Policy | Enrollzy')
@section('meta_keywords', $page->meta_keywords ?? '')
@section('meta_description', $page->meta_description ?? 'Cookie Policy of Uniband8 Education Technology Pvt. Ltd. (Enrollzy): how cookies and tracking technologies are used, categorization, and your controls.')

@push('css')
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    corePlugins: {
      preflight: false,
    },
    theme: {
      extend: {
        colors: {
          brand: {
            blue: '#0171E0',
            hover: '#0058B3',
            ghost: '#F7FAFD',
            dark: '#0B132B',
            slate: '#1E293B',
            lightBlue: '#E6F0FA'
          }
        },
        animation: {
          'float-slow': 'float 6s ease-in-out infinite',
          'pulse-subtle': 'pulseSubtle 3s ease-in-out infinite',
        },
        keyframes: {
          float: {
            '0%, 100%': { transform: 'translateY(0px)' },
            '50%': { transform: 'translateY(-8px)' },
          },
          pulseSubtle: {
            '0%, 100%': { opacity: '1' },
            '50%': { opacity: '0.85' },
          }
        }
      }
    }
  }
</script>

<style>
  .cookie-page-wrapper {
    background-color: #F7FAFD;
    color: #0F172A;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    padding-bottom: 60px;
  }
  .cookie-page-wrapper a {
    text-decoration: none;
  }
  .cookie-page-wrapper .hero-gradient {
    background: linear-gradient(135deg, #0171E0 0%, #004696 100%);
  }
  .cookie-page-wrapper .glass-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(226, 232, 240, 0.8);
  }
  .cookie-page-wrapper .card-shadow {
    box-shadow: 0 12px 32px -6px rgba(1, 113, 224, 0.08), 0 4px 12px -2px rgba(15, 23, 42, 0.03);
  }
  .cookie-page-wrapper .card-shadow-lg {
    box-shadow: 0 20px 40px -10px rgba(1, 113, 224, 0.12), 0 8px 16px -4px rgba(15, 23, 42, 0.04);
  }
  .cookie-page-wrapper .active-nav-link {
    background-color: #E6F0FA !important;
    color: #0171E0 !important;
    font-weight: 700 !important;
    border-left: 4px solid #0171E0 !important;
  }
</style>
@endpush

@section('content')
<div class="cookie-page-wrapper selection:bg-brand-blue selection:text-white">

  <!-- Top Announcement Bar -->
  <div class="bg-slate-900 text-slate-200 text-xs font-medium py-2.5 px-4 text-center border-b border-slate-800 flex items-center justify-center gap-3">
    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-blue-500/20 text-blue-300 font-semibold text-[10px]">
      <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-ping"></span> Live Policy
    </span>
    <span>Enrollzy Platform Privacy &amp; Cookie Governance — Updated September 2026</span>
  </div>

  <!-- Hero Section -->
  <section class="hero-gradient text-white relative overflow-hidden py-16 lg:py-20">
    <!-- SVG Background Graphic Overlay -->
    <div class="absolute inset-0 opacity-10 pointer-events-none">
      <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <pattern id="cookie-grid" width="40" height="40" patternUnits="userSpaceOnUse">
            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
          </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#cookie-grid)" />
      </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        
        <!-- Hero Text -->
        <div class="lg:col-span-7">
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold bg-white/10 backdrop-blur-md text-blue-100 mb-6 border border-white/20">
            <i class="fa-solid fa-shield-halved text-amber-300"></i> Privacy Governance &amp; Cookie Standards
          </div>
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-tight mb-6 text-white">
            {{ $page->title ?? 'Enrollzy Cookie Policy' }}
          </h1>
          <p class="text-base sm:text-lg text-blue-100 font-normal leading-relaxed mb-8 max-w-2xl">
            Detailed disclosure on how Enrollzy uses cookies, tracking pixels, local SDKs, and data privacy controls to deliver a secure, personalized admission journey for students and institutions.
          </p>

          <div class="flex flex-wrap items-center gap-6 text-xs text-blue-100/90 font-medium border-t border-white/15 pt-6">
            <div class="flex items-center gap-2">
              <i class="fa-solid fa-calendar-check text-blue-300"></i>
              <span><strong>Last Updated:</strong> September 2026</span>
            </div>
            <div class="h-3 w-px bg-white/20"></div>
            <div class="flex items-center gap-2">
              <i class="fa-solid fa-globe text-blue-300"></i>
              <span><strong>Platform:</strong> https://enrollzy.com</span>
            </div>
          </div>
        </div>

        <!-- Hero Dynamic Graphic / Interactive Status Card -->
        <div class="lg:col-span-5">
          <div class="glass-card rounded-3xl p-6 text-slate-900 card-shadow-lg relative animate-float-slow">
            <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-brand-blue flex items-center justify-center font-bold text-lg">
                  <i class="fa-solid fa-cookie-bite"></i>
                </div>
                <div>
                  <h3 class="font-bold text-sm text-slate-900 mb-0">Cookie Status Panel</h3>
                  <p class="text-[11px] text-slate-500 mb-0">Your Current Preference Profile</p>
                </div>
              </div>
              <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase bg-emerald-100 text-emerald-700 flex items-center gap-1">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Active
              </span>
            </div>

            <!-- Quick Info Badges -->
            <div class="space-y-3 text-xs mb-6">
              <div class="flex items-center justify-between p-2.5 rounded-xl bg-brand-ghost border border-slate-100">
                <span class="font-semibold text-slate-700"><i class="fa-solid fa-lock text-slate-400 mr-2"></i>Strictly Necessary</span>
                <span class="text-slate-500 font-bold">Always On</span>
              </div>
              <div class="flex items-center justify-between p-2.5 rounded-xl bg-brand-ghost border border-slate-100">
                <span class="font-semibold text-slate-700"><i class="fa-solid fa-user-shield text-brand-blue mr-2"></i>Minor Protection</span>
                <span class="text-emerald-600 font-bold">Enforced</span>
              </div>
              <div class="flex items-center justify-between p-2.5 rounded-xl bg-brand-ghost border border-slate-100">
                <span class="font-semibold text-slate-700"><i class="fa-solid fa-user-check text-brand-blue mr-2"></i>Institutional Decisions</span>
                <span class="text-slate-600 font-bold">Human-Only</span>
              </div>
            </div>

            <a href="#interactive-preference-widget" class="block text-center w-full py-3 rounded-xl bg-brand-blue hover:bg-brand-hover text-white font-bold text-xs transition-colors shadow-md shadow-brand-blue/20">
              Manage Preference Toggles
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Interactive Cookie Preference Control Panel Section -->
  <section id="interactive-preference-widget" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 card-shadow-lg">
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6 pb-6 border-b border-slate-100">
        <div>
          <span class="text-xs font-bold uppercase tracking-wider text-brand-blue">Interactive Preference Controller</span>
          <h2 class="text-2xl font-black text-slate-900 mt-1 mb-0">Customize Your Cookie Profile</h2>
          <p class="text-xs text-slate-500 mt-1 mb-0">Changes take effect immediately for your current browser session.</p>
        </div>
        <div class="flex items-center gap-3">
          <button type="button" id="btn-reject-all" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors border-0 cursor-pointer">
            Reject Non-Essential
          </button>
          <button type="button" id="btn-accept-all" class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-brand-blue hover:bg-brand-hover transition-colors shadow-md shadow-brand-blue/20 border-0 cursor-pointer">
            Accept All Cookies
          </button>
        </div>
      </div>

      <!-- Toggle Switches Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Toggle 1: Essential -->
        <div class="p-4 rounded-2xl bg-brand-ghost border border-slate-200/80 flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-2">
              <span class="font-bold text-sm text-slate-900">Strictly Necessary</span>
              <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-slate-200 text-slate-700 uppercase">Locked</span>
            </div>
            <p class="text-xs text-slate-500 leading-relaxed mb-0">Session authentication, security protection, and application submission integrity.</p>
          </div>
          <div class="mt-4 pt-3 border-t border-slate-200/60 flex items-center justify-between">
            <span class="text-[11px] font-bold text-slate-700">Status</span>
            <span class="text-[11px] font-extrabold text-brand-blue">Always Enabled</span>
          </div>
        </div>

        <!-- Toggle 2: Functional -->
        <div class="p-4 rounded-2xl bg-brand-ghost border border-slate-200/80 flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-2">
              <span class="font-bold text-sm text-slate-900">Functional</span>
              <label class="relative inline-flex items-center cursor-pointer m-0">
                <input type="checkbox" id="toggle-functional" class="sr-only peer" checked>
                <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-blue"></div>
              </label>
            </div>
            <p class="text-xs text-slate-500 leading-relaxed mb-0">Remembers language, region, saved program search filters, and user preferences.</p>
          </div>
          <div class="mt-4 pt-3 border-t border-slate-200/60 flex items-center justify-between">
            <span class="text-[11px] font-bold text-slate-700">Status</span>
            <span id="status-functional" class="text-[11px] font-extrabold text-emerald-600">Active</span>
          </div>
        </div>

        <!-- Toggle 3: Analytics -->
        <div class="p-4 rounded-2xl bg-brand-ghost border border-slate-200/80 flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-2">
              <span class="font-bold text-sm text-slate-900">Analytics</span>
              <label class="relative inline-flex items-center cursor-pointer m-0">
                <input type="checkbox" id="toggle-analytics" class="sr-only peer" checked>
                <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-blue"></div>
              </label>
            </div>
            <p class="text-xs text-slate-500 leading-relaxed mb-0">Aggregated usage statistics to fix broken flows and speed up page load times.</p>
          </div>
          <div class="mt-4 pt-3 border-t border-slate-200/60 flex items-center justify-between">
            <span class="text-[11px] font-bold text-slate-700">Status</span>
            <span id="status-analytics" class="text-[11px] font-extrabold text-emerald-600">Active</span>
          </div>
        </div>

        <!-- Toggle 4: Advertising -->
        <div class="p-4 rounded-2xl bg-brand-ghost border border-slate-200/80 flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between mb-2">
              <span class="font-bold text-sm text-slate-900">Advertising</span>
              <label class="relative inline-flex items-center cursor-pointer m-0">
                <input type="checkbox" id="toggle-advertising" class="sr-only peer">
                <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-blue"></div>
              </label>
            </div>
            <p class="text-xs text-slate-500 leading-relaxed mb-0">Ad delivery, retargeting pixels, and conversion measurement (Adult users only).</p>
          </div>
          <div class="mt-4 pt-3 border-t border-slate-200/60 flex items-center justify-between">
            <span class="text-[11px] font-bold text-slate-700">Status</span>
            <span id="status-advertising" class="text-[11px] font-extrabold text-slate-400">Disabled</span>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Main Content Container with TOC Navigation Bar -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

      <!-- Sticky Quick Navigation Sidebar (Table of Contents) -->
      <aside class="lg:col-span-4 hidden lg:block">
        <div class="sticky top-24 bg-white rounded-3xl p-6 border border-slate-200 card-shadow">
          <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-100">
            <i class="fa-solid fa-list-ul text-brand-blue text-sm"></i>
            <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-0">Policy Navigation</h3>
          </div>
          
          <nav id="toc-nav" class="space-y-1 text-xs font-semibold text-slate-600">
            <a href="#overview" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-brand-ghost hover:text-brand-blue transition-all">
              <i class="fa-solid fa-circle-info text-slate-400 w-4"></i> 1. Policy Overview
            </a>
            <a href="#what-are-cookies" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-brand-ghost hover:text-brand-blue transition-all">
              <i class="fa-solid fa-cookie text-slate-400 w-4"></i> 2. What Are Cookies, Exactly?
            </a>
            <a href="#why-we-use" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-brand-ghost hover:text-brand-blue transition-all">
              <i class="fa-solid fa-bullseye text-slate-400 w-4"></i> 3. Why We Use Cookies
            </a>
            <a href="#categories" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-brand-ghost hover:text-brand-blue transition-all">
              <i class="fa-solid fa-layer-group text-slate-400 w-4"></i> 4. Categories of Cookies
            </a>
            <a href="#vendors-table" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-brand-ghost hover:text-brand-blue transition-all">
              <i class="fa-solid fa-table-list text-slate-400 w-4"></i> 5. Vendors &amp; Third-Parties
            </a>
            <a href="#lifespan" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-brand-ghost hover:text-brand-blue transition-all">
              <i class="fa-solid fa-clock text-slate-400 w-4"></i> 6. How Long Cookies Last
            </a>
            <a href="#minors-protection" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-brand-ghost hover:text-brand-blue transition-all">
              <i class="fa-solid fa-shield-cat text-slate-400 w-4"></i> 7. Protection for Minors
            </a>
            <a href="#your-choices" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-brand-ghost hover:text-brand-blue transition-all">
              <i class="fa-solid fa-sliders text-slate-400 w-4"></i> 8. Choices &amp; Control
            </a>
            <a href="#disable-effects" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-brand-ghost hover:text-brand-blue transition-all">
              <i class="fa-solid fa-triangle-exclamation text-slate-400 w-4"></i> 9. Impact of Disabling
            </a>
            <a href="#contact" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-brand-ghost hover:text-brand-blue transition-all">
              <i class="fa-solid fa-envelope text-slate-400 w-4"></i> 10. Contact Information
            </a>
            <a href="#policy-changes" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-brand-ghost hover:text-brand-blue transition-all">
              <i class="fa-solid fa-pen-to-square text-slate-400 w-4"></i> 11. Policy Changes
            </a>
          </nav>

          <div class="mt-6 p-4 rounded-2xl bg-blue-50/70 border border-blue-100 text-xs text-slate-600">
            <div class="flex items-center gap-2 text-brand-blue font-bold mb-1">
              <i class="fa-solid fa-circle-question"></i> Questions?
            </div>
            <p class="leading-relaxed mb-0">Contact our Data Governance Officer at <a href="mailto:info@enrollzy.com" class="text-brand-blue font-bold underline">info@enrollzy.com</a>.</p>
          </div>
        </div>
      </aside>

      <!-- Full Detailed Document Content -->
      <div class="lg:col-span-8 space-y-10">

        <!-- 1. Overview Section -->
        <article id="overview" class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 card-shadow">
          <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-brand-blue flex items-center justify-center font-black text-lg shadow-sm">
              01
            </div>
            <div>
              <span class="text-xs font-bold uppercase tracking-wider text-brand-blue">Introduction</span>
              <h2 class="text-2xl font-black text-slate-900 mb-0">Cookie Policy Overview</h2>
            </div>
          </div>

          <p class="text-slate-600 leading-relaxed mb-6 text-sm sm:text-base">
            This Cookie Policy explains, in detail, how Enrollzy ("Enrollzy," "we," "us," or "our") uses cookies and similar tracking technologies when you visit or use <a href="https://enrollzy.com" class="text-brand-blue font-bold underline" target="_blank" rel="noopener">https://enrollzy.com</a> and related services (the "Platform"). It should be read together with our Privacy Policy, which explains more broadly how we collect, use, and protect personal data.
          </p>

          <div class="p-5 rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50/40 border border-blue-100 text-slate-700 text-xs sm:text-sm leading-relaxed flex items-start gap-3">
            <div class="w-8 h-8 rounded-xl bg-brand-blue text-white flex-shrink-0 flex items-center justify-center text-sm font-bold mt-0.5">
              <i class="fa-solid fa-check"></i>
            </div>
            <div>
              <strong class="text-slate-900 block mb-1">Your Consent &amp; Agreement:</strong>
              By continuing to browse or use the Platform after being shown our cookie banner and making a choice, you agree to the use of cookies as described in this policy (except where you have chosen to reject non-essential cookies).
            </div>
          </div>
        </article>

        <!-- 2. What Are Cookies, Exactly? -->
        <article id="what-are-cookies" class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 card-shadow">
          <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-brand-blue flex items-center justify-center font-black text-lg shadow-sm">
              02
            </div>
            <div>
              <span class="text-xs font-bold uppercase tracking-wider text-brand-blue">Technical Definitions</span>
              <h2 class="text-2xl font-black text-slate-900 mb-0">What Are Cookies, Exactly?</h2>
            </div>
          </div>

          <p class="text-slate-600 leading-relaxed mb-6 text-sm sm:text-base">
            A cookie is a small text file — usually just a few kilobytes — that a website places on your computer, phone, or tablet when you visit it. The website (or a third-party service embedded in it) can later read that file to "remember" something about you: that you're logged in, what language you prefer, or that you visited a particular page.
          </p>

          <h3 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-microchip text-brand-blue"></i> Related Technologies Covered in This Policy
          </h3>
          <p class="text-xs sm:text-sm text-slate-600 mb-6">
            Cookies are not the only tracking technology in use today. This policy also covers related technologies that work similarly, including:
          </p>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Technology 1 -->
            <div class="p-5 rounded-2xl bg-brand-ghost border border-slate-200/80 hover:border-brand-blue/40 transition-all">
              <div class="w-10 h-10 rounded-xl bg-blue-100 text-brand-blue flex items-center justify-center mb-3 text-base font-bold">
                <i class="fa-solid fa-eye"></i>
              </div>
              <h4 class="font-bold text-slate-900 text-sm mb-1.5">Pixels / Web Beacons</h4>
              <p class="text-xs text-slate-600 leading-relaxed mb-0">
                Tiny, often invisible images embedded in a page or email that tell a server your device loaded that content (commonly used by advertising platforms like Meta to confirm an ad was seen or a purchase was made).
              </p>
            </div>

            <!-- Technology 2 -->
            <div class="p-5 rounded-2xl bg-brand-ghost border border-slate-200/80 hover:border-brand-blue/40 transition-all">
              <div class="w-10 h-10 rounded-xl bg-blue-100 text-brand-blue flex items-center justify-center mb-3 text-base font-bold">
                <i class="fa-solid fa-code"></i>
              </div>
              <h4 class="font-bold text-slate-900 text-sm mb-1.5">Tags</h4>
              <p class="text-xs text-slate-600 leading-relaxed mb-0">
                Small snippets of code (e.g., Google Tag Manager) that trigger other tracking scripts to run.
              </p>
            </div>

            <!-- Technology 3 -->
            <div class="p-5 rounded-2xl bg-brand-ghost border border-slate-200/80 hover:border-brand-blue/40 transition-all">
              <div class="w-10 h-10 rounded-xl bg-blue-100 text-brand-blue flex items-center justify-center mb-3 text-base font-bold">
                <i class="fa-solid fa-hard-drive"></i>
              </div>
              <h4 class="font-bold text-slate-900 text-sm mb-1.5">Local Storage / SDK Data</h4>
              <p class="text-xs text-slate-600 leading-relaxed mb-0">
                Data stored by your browser or a mobile app that persists similarly to a cookie but isn't a cookie in the strict technical sense.
              </p>
            </div>
          </div>

          <p class="text-xs text-slate-500 italic bg-slate-50 p-3 rounded-xl border border-slate-200 mb-0">
            When we say "cookies" throughout this policy, we mean all of the above unless we specifically say otherwise.
          </p>
        </article>

        <!-- 3. Why We Use Cookies -->
        <article id="why-we-use" class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 card-shadow">
          <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-brand-blue flex items-center justify-center font-black text-lg shadow-sm">
              03
            </div>
            <div>
              <span class="text-xs font-bold uppercase tracking-wider text-brand-blue">Purpose &amp; Utility</span>
              <h2 class="text-2xl font-black text-slate-900 mb-0">Why We Use Cookies</h2>
            </div>
          </div>

          <p class="text-slate-600 leading-relaxed mb-6 text-sm sm:text-base">
            Broadly, cookies serve four purposes on Enrollzy:
          </p>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div class="p-5 rounded-2xl bg-brand-ghost border border-slate-200/80 flex gap-4 items-start">
              <div class="w-8 h-8 rounded-full bg-brand-blue text-white flex-shrink-0 flex items-center justify-center text-xs font-bold mt-1">1</div>
              <div>
                <h4 class="font-bold text-slate-900 text-sm mb-1">Making Platform Work</h4>
                <p class="text-xs text-slate-600 leading-relaxed mb-0">For example, keeping you logged in as you move from browsing programs to submitting an application.</p>
              </div>
            </div>

            <div class="p-5 rounded-2xl bg-brand-ghost border border-slate-200/80 flex gap-4 items-start">
              <div class="w-8 h-8 rounded-full bg-brand-blue text-white flex-shrink-0 flex items-center justify-center text-xs font-bold mt-1">2</div>
              <div>
                <h4 class="font-bold text-slate-900 text-sm mb-1">Remembering Choices</h4>
                <p class="text-xs text-slate-600 leading-relaxed mb-0">So you don't have to re-select your preferred language or re-enter your saved filters every time you visit.</p>
              </div>
            </div>

            <div class="p-5 rounded-2xl bg-brand-ghost border border-slate-200/80 flex gap-4 items-start">
              <div class="w-8 h-8 rounded-full bg-brand-blue text-white flex-shrink-0 flex items-center justify-center text-xs font-bold mt-1">3</div>
              <div>
                <h4 class="font-bold text-slate-900 text-sm mb-1">Understanding &amp; Improving</h4>
                <p class="text-xs text-slate-600 leading-relaxed mb-0">By showing us, in aggregate, which pages are useful, where users get stuck, and what's confusing.</p>
              </div>
            </div>

            <div class="p-5 rounded-2xl bg-brand-ghost border border-slate-200/80 flex gap-4 items-start">
              <div class="w-8 h-8 rounded-full bg-brand-blue text-white flex-shrink-0 flex items-center justify-center text-xs font-bold mt-1">4</div>
              <div>
                <h4 class="font-bold text-slate-900 text-sm mb-1">Delivering &amp; Measuring Ads</h4>
                <p class="text-xs text-slate-600 leading-relaxed mb-0">So that when we run campaigns to reach prospective students, we can tell whether those campaigns are actually working, and show relevant follow-up ads to people who've already shown interest.</p>
              </div>
            </div>
          </div>

          <!-- Highlight Box -->
          <div class="p-5 rounded-2xl bg-amber-50/80 border border-amber-200 text-amber-950 text-xs sm:text-sm flex items-start gap-3">
            <i class="fa-solid fa-user-check text-amber-600 text-lg mt-0.5"></i>
            <div>
              <strong>Human Decisions Safeguard:</strong> We do not use cookies to make final decisions about a student's application or eligibility — those remain human decisions made by Partner Institutions.
            </div>
          </div>
        </article>

        <!-- 4. Categories of Cookies We Use -->
        <article id="categories" class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 card-shadow">
          <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-brand-blue flex items-center justify-center font-black text-lg shadow-sm">
              04
            </div>
            <div>
              <span class="text-xs font-bold uppercase tracking-wider text-brand-blue">Classification</span>
              <h2 class="text-2xl font-black text-slate-900 mb-0">Categories of Cookies We Use</h2>
            </div>
          </div>

          <div class="space-y-6">
            
            <!-- Category 1 -->
            <div class="p-6 rounded-2xl border border-slate-200 bg-white hover:shadow-md transition-shadow">
              <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2 mb-0">
                  <i class="fa-solid fa-lock text-brand-blue"></i> Strictly Necessary Cookies
                </h3>
                <span class="px-3 py-1 rounded-full text-xs font-extrabold bg-slate-100 text-slate-700 uppercase">Required</span>
              </div>
              <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-3">
                <strong>What they do:</strong> Keep you logged into your account, remember items in an in-progress application, protect against cross-site request forgery and other security threats, and distribute traffic across our servers (load balancing) so the site stays fast and available.
              </p>
              <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-3">
                <strong>Can you turn these off?</strong> No — not through our cookie settings tool. You can block them via your browser, but doing so will likely break core functionality (for example, you may be logged out every time you navigate to a new page, or be unable to submit an application).
              </p>
              <div class="p-3 rounded-xl bg-brand-ghost border border-slate-100 text-xs text-slate-600">
                <strong>Example:</strong> A session cookie that stores an encrypted token proving you're logged in.
              </div>
            </div>

            <!-- Category 2 -->
            <div class="p-6 rounded-2xl border border-slate-200 bg-white hover:shadow-md transition-shadow">
              <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2 mb-0">
                  <i class="fa-solid fa-sliders text-brand-blue"></i> Functional / Preference Cookies
                </h3>
                <span class="px-3 py-1 rounded-full text-xs font-extrabold bg-blue-50 text-brand-blue uppercase">Optional</span>
              </div>
              <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-3">
                <strong>What they do:</strong> Remember non-essential but convenience-related choices — your preferred language, your region/currency (if applicable), and filters you've applied when searching for programs or institutions, so you don't have to re-enter them each visit.
              </p>
              <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-0">
                <strong>Can you turn these off?</strong> Yes. If disabled, the Platform will still work, but it will "forget" your preferences between visits.
              </p>
            </div>

            <!-- Category 3 -->
            <div class="p-6 rounded-2xl border border-slate-200 bg-white hover:shadow-md transition-shadow">
              <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2 mb-0">
                  <i class="fa-solid fa-chart-line text-brand-blue"></i> Analytics Cookies
                </h3>
                <span class="px-3 py-1 rounded-full text-xs font-extrabold bg-blue-50 text-brand-blue uppercase">Optional</span>
              </div>
              <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-3">
                <strong>What they do:</strong> Tell us, in aggregate and generally in a way that doesn't identify you personally, how visitors move through the Platform — which pages are visited most, how long people spend comparing programs, where users commonly drop off before completing an application, and which devices/browsers are most common among our users. We use this to fix broken flows, prioritize new features, and improve page load times.
              </p>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-3 rounded-xl bg-brand-ghost border border-slate-100 text-xs text-slate-600">
                <div><strong>Who provides this:</strong> Google Analytics (or an equivalent analytics provider).</div>
                <div><strong>Applies to:</strong> Adult users only. We do not run analytics cookies that build individual behavioral profiles of users identified as minors.</div>
              </div>
            </div>

            <!-- Category 4 -->
            <div class="p-6 rounded-2xl border border-slate-200 bg-white hover:shadow-md transition-shadow">
              <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2 mb-0">
                  <i class="fa-solid fa-rectangle-ad text-brand-blue"></i> Advertising / Marketing Cookies
                </h3>
                <span class="px-3 py-1 rounded-full text-xs font-extrabold bg-blue-50 text-brand-blue uppercase">Optional</span>
              </div>
              <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-2">
                <strong>What they do:</strong>
              </p>
              <ul class="list-disc pl-5 text-xs sm:text-sm text-slate-600 space-y-1.5 mb-3">
                <li><strong>Ad delivery:</strong> Help us and our advertising partners show Enrollzy ads to people likely to be interested (for example, people who've searched for topics like "study abroad" or "coaching institutes").</li>
                <li><strong>Retargeting / remarketing:</strong> If you visit Enrollzy and leave without signing up, you may later see an Enrollzy ad on Instagram, Facebook, or a Google-partner website. This works because an advertising cookie or pixel recorded that your browser visited a specific page on our site.</li>
                <li><strong>Conversion measurement:</strong> Tell us whether someone who clicked on an Enrollzy ad went on to create an account or submit an inquiry, so we know which campaigns are worth continuing.</li>
              </ul>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-3 rounded-xl bg-brand-ghost border border-slate-100 text-xs text-slate-600">
                <div><strong>Who provides this:</strong> Meta Pixel (Facebook/Instagram Ads), Google Ads.</div>
                <div><strong>Applies to:</strong> Adult users only.</div>
              </div>
            </div>

          </div>
        </article>

        <!-- 5. First-Party vs. Third-Party Cookies, and Vendors -->
        <article id="vendors-table" class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 card-shadow">
          <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-brand-blue flex items-center justify-center font-black text-lg shadow-sm">
              05
            </div>
            <div>
              <span class="text-xs font-bold uppercase tracking-wider text-brand-blue">Third-Party Governance</span>
              <h2 class="text-2xl font-black text-slate-900 mb-0">First-Party vs. Third-Party Cookies &amp; Vendors</h2>
            </div>
          </div>

          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-4">
            <strong>First-party cookies</strong> are set directly by enrollzy.com and can only be read by us.
          </p>
          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-6">
            <strong>Third-party cookies</strong> are set by other companies' code that we've embedded in our Platform (for example, an "Analytics" script or an "ad pixel"). These companies can read the cookies they set, generally regardless of which website you're on, which is how they can recognize your browser again on a different site.
          </p>

          <!-- Vendor Data Table -->
          <div class="overflow-x-auto rounded-2xl border border-slate-200 mb-6">
            <table class="w-full text-left text-xs sm:text-sm text-slate-600 border-collapse">
              <thead class="bg-slate-900 text-white text-[11px] uppercase tracking-wider">
                <tr>
                  <th class="py-3.5 px-4 font-bold border-0">Provider</th>
                  <th class="py-3.5 px-4 font-bold border-0">What it does on Enrollzy</th>
                  <th class="py-3.5 px-4 font-bold border-0">Category</th>
                  <th class="py-3.5 px-4 font-bold border-0">Whose cookie is it</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100 bg-white">
                <tr class="hover:bg-slate-50 transition-colors">
                  <td class="py-3.5 px-4 font-bold text-slate-900">Google Analytics</td>
                  <td class="py-3.5 px-4">Measures site usage and behavior in aggregate</td>
                  <td class="py-3.5 px-4"><span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-50 text-brand-blue">Analytics</span></td>
                  <td class="py-3.5 px-4">Third-party</td>
                </tr>
                <tr class="hover:bg-slate-50 transition-colors">
                  <td class="py-3.5 px-4 font-bold text-slate-900">Meta Pixel (Facebook/Instagram Ads)</td>
                  <td class="py-3.5 px-4">Ad delivery, retargeting, conversion measurement</td>
                  <td class="py-3.5 px-4"><span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-purple-50 text-purple-600">Advertising</span></td>
                  <td class="py-3.5 px-4">Third-party</td>
                </tr>
                <tr class="hover:bg-slate-50 transition-colors">
                  <td class="py-3.5 px-4 font-bold text-slate-900">Google Ads</td>
                  <td class="py-3.5 px-4">Ad delivery, retargeting, conversion measurement</td>
                  <td class="py-3.5 px-4"><span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-purple-50 text-purple-600">Advertising</span></td>
                  <td class="py-3.5 px-4">Third-party</td>
                </tr>
                <tr class="hover:bg-slate-50 transition-colors">
                  <td class="py-3.5 px-4 font-bold text-slate-900">[Payment gateway — e.g., Razorpay/Stripe]</td>
                  <td class="py-3.5 px-4">Enables secure checkout and fraud prevention during payment</td>
                  <td class="py-3.5 px-4"><span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700">Strictly Necessary</span></td>
                  <td class="py-3.5 px-4">Third-party</td>
                </tr>
                <tr class="hover:bg-slate-50 transition-colors">
                  <td class="py-3.5 px-4 font-bold text-slate-900">Enrollzy session/login cookie</td>
                  <td class="py-3.5 px-4">Keeps you logged in, secures your session</td>
                  <td class="py-3.5 px-4"><span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700">Strictly Necessary</span></td>
                  <td class="py-3.5 px-4 font-bold text-brand-blue">First-party</td>
                </tr>
                <tr class="hover:bg-slate-50 transition-colors">
                  <td class="py-3.5 px-4 font-bold text-slate-900">Enrollzy preference cookie</td>
                  <td class="py-3.5 px-4">Remembers language, region, saved filters</td>
                  <td class="py-3.5 px-4"><span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-600">Functional</span></td>
                  <td class="py-3.5 px-4 font-bold text-brand-blue">First-party</td>
                </tr>
              </tbody>
            </table>
          </div>

          <p class="text-xs text-slate-500 leading-relaxed mb-0">
            Each of these third parties has its own privacy and cookie policy governing what they do with the data their cookies collect, separate from this policy. We encourage you to review theirs if you want more detail on how they individually process data.
          </p>
        </article>

        <!-- 6. How Long Cookies Last -->
        <article id="lifespan" class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 card-shadow">
          <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-brand-blue flex items-center justify-center font-black text-lg shadow-sm">
              06
            </div>
            <div>
              <span class="text-xs font-bold uppercase tracking-wider text-brand-blue">Retention Period</span>
              <h2 class="text-2xl font-black text-slate-900 mb-0">How Long Cookies Last</h2>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="p-6 rounded-2xl bg-brand-ghost border border-slate-200/80">
              <div class="w-10 h-10 rounded-xl bg-blue-100 text-brand-blue flex items-center justify-center font-bold text-lg mb-3">
                <i class="fa-solid fa-hourglass-half"></i>
              </div>
              <h3 class="font-bold text-slate-900 text-base mb-2">Session Cookies</h3>
              <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-0">
                Exist only for the duration of your visit and are automatically deleted when you close your browser. Our login/session cookies are typically session cookies.
              </p>
            </div>

            <div class="p-6 rounded-2xl bg-brand-ghost border border-slate-200/80">
              <div class="w-10 h-10 rounded-xl bg-blue-100 text-brand-blue flex items-center justify-center font-bold text-lg mb-3">
                <i class="fa-solid fa-calendar-alt"></i>
              </div>
              <h3 class="font-bold text-slate-900 text-base mb-2">Persistent Cookies</h3>
              <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-0">
                Remain on your device after you close your browser, for a fixed period set by the cookie itself — commonly anywhere from 30 days up to 2 years — or until you manually clear your browser's cookies.
              </p>
            </div>
          </div>

          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-0">
            We aim to use the shortest duration reasonably necessary for each cookie's purpose, and we periodically review third-party cookie lifespans as part of maintaining this policy.
          </p>
        </article>

        <!-- 7. Cookies and Minors — Extra Protection -->
        <article id="minors-protection" class="bg-slate-900 text-white rounded-3xl p-6 sm:p-8 card-shadow-lg relative overflow-hidden">
          <div class="absolute -right-10 -bottom-10 opacity-10 pointer-events-none">
            <i class="fa-solid fa-shield-cat text-9xl"></i>
          </div>

          <div class="relative z-10">
            <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-800">
              <div class="w-12 h-12 rounded-2xl bg-brand-blue text-white flex items-center justify-center font-black text-lg shadow-md">
                07
              </div>
              <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-400">Student Protection</span>
                <h2 class="text-2xl font-black text-white mb-0">Cookies and Minors — Extra Protection</h2>
              </div>
            </div>

            <p class="text-slate-300 leading-relaxed mb-6 text-sm sm:text-base">
              Because many Enrollzy users are minors exploring schools, boarding programs, or early academic options, we apply stricter rules once a user is identified as a minor:
            </p>

            <div class="space-y-4 text-xs sm:text-sm mb-6">
              <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-800/80 border border-slate-700/60">
                <div class="w-7 h-7 rounded-lg bg-red-500/20 text-red-400 flex items-center justify-center flex-shrink-0 font-bold mt-0.5">
                  <i class="fa-solid fa-xmark"></i>
                </div>
                <div>
                  <strong class="text-white block mb-1">No Advertising or Retargeting Cookies:</strong>
                  Activated for accounts identified as belonging to a minor. This means we do not build advertising profiles of children, and we do not show them targeted ads based on their activity on the Platform.
                </div>
              </div>

              <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-800/80 border border-slate-700/60">
                <div class="w-7 h-7 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center flex-shrink-0 font-bold mt-0.5">
                  <i class="fa-solid fa-chart-simple"></i>
                </div>
                <div>
                  <strong class="text-white block mb-1">No Individual-Level Behavioral Analytics:</strong>
                  Where any analytics is applied to a minor's activity, it is limited to aggregated, de-identified statistics used for general product improvement — never used to build a profile of that individual child.
                </div>
              </div>

              <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-slate-800/80 border border-slate-700/60">
                <div class="w-7 h-7 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0 font-bold mt-0.5">
                  <i class="fa-solid fa-laptop text-sm"></i>
                </div>
                <div>
                  <strong class="text-white block mb-1">Universal Device Enforcement:</strong>
                  This restriction applies regardless of which device or browser is used, as long as the account is recognized as belonging to a minor.
                </div>
              </div>
            </div>

            <div class="p-4 rounded-2xl bg-brand-blue/20 border border-brand-blue/40 text-xs text-blue-200">
              If you believe a minor's account is receiving targeted advertising cookies in error, please contact us immediately at <a href="mailto:info@enrollzy.com" class="text-white font-bold underline">info@enrollzy.com</a>.
            </div>
          </div>
        </article>

        <!-- 8. Your Choices and How to Control Cookies -->
        <article id="your-choices" class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 card-shadow">
          <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-brand-blue flex items-center justify-center font-black text-lg shadow-sm">
              08
            </div>
            <div>
              <span class="text-xs font-bold uppercase tracking-wider text-brand-blue">User Controls</span>
              <h2 class="text-2xl font-black text-slate-900 mb-0">Your Choices and How to Control Cookies</h2>
            </div>
          </div>

          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-6">
            You have several layers of control:
          </p>

          <div class="space-y-6">
            
            <!-- Banner Controls -->
            <div class="p-5 rounded-2xl bg-brand-ghost border border-slate-200/80">
              <h3 class="font-bold text-slate-900 text-sm mb-2 flex items-center gap-2">
                <i class="fa-solid fa-window-maximize text-brand-blue"></i> Our Cookie Consent Banner &amp; Settings Link
              </h3>
              <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-3">
                The first time you visit Enrollzy, you'll see a banner allowing you to Accept All, Reject Non-Essential, or Customize your cookie preferences by category (Analytics, Advertising). For visitors in the EU/UK and other regions where opt-in consent is legally required, analytics and advertising cookies are not activated until you affirmatively consent.
              </p>
              <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-0">
                <strong>Cookie settings link:</strong> You can revisit and change your preferences at any time via the "Cookie Settings" control above.
              </p>
            </div>

            <!-- Browser Controls -->
            <div class="p-5 rounded-2xl bg-brand-ghost border border-slate-200/80">
              <h3 class="font-bold text-slate-900 text-sm mb-2 flex items-center gap-2">
                <i class="fa-solid fa-compass text-brand-blue"></i> Browser-Level Controls
              </h3>
              <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-0">
                All major browsers (Chrome, Safari, Firefox, Edge) let you view, block, or delete cookies through their settings menus. Because the exact steps vary by browser and version, we recommend checking your browser's help documentation for current instructions.
              </p>
            </div>

            <!-- Ad Platform Opt Outs -->
            <div class="p-5 rounded-2xl bg-brand-ghost border border-slate-200/80">
              <h3 class="font-bold text-slate-900 text-sm mb-3 flex items-center gap-2">
                <i class="fa-solid fa-arrow-up-right-from-square text-brand-blue"></i> Advertising Platform Opt-Outs
              </h3>
              <p class="text-xs text-slate-600 mb-4">
                These let you control ad personalization directly with the ad networks themselves, independent of our site:
              </p>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs mb-4">
                <a href="https://adssettings.google.com" target="_blank" rel="noopener noreferrer" class="p-3.5 bg-white rounded-xl border border-slate-200 flex items-center justify-between hover:border-brand-blue hover:shadow-sm transition-all group">
                  <span class="font-bold text-slate-800 group-hover:text-brand-blue">Google Ads Settings</span>
                  <span class="text-[10px] text-slate-400 group-hover:text-brand-blue font-semibold">adssettings.google.com <i class="fa-solid fa-external-link text-[9px] ml-1"></i></span>
                </a>

                <a href="https://www.facebook.com/adpreferences" target="_blank" rel="noopener noreferrer" class="p-3.5 bg-white rounded-xl border border-slate-200 flex items-center justify-between hover:border-brand-blue hover:shadow-sm transition-all group">
                  <span class="font-bold text-slate-800 group-hover:text-brand-blue">Meta Ad Preferences</span>
                  <span class="text-[10px] text-slate-400 group-hover:text-brand-blue font-semibold">facebook.com/adpreferences <i class="fa-solid fa-external-link text-[9px] ml-1"></i></span>
                </a>
              </div>

              <p class="text-xs text-slate-600 leading-relaxed mb-0">
                You can also opt out of interest-based advertising broadly through industry tools such as the Digital Advertising Alliance (<a href="https://www.aboutads.info" target="_blank" rel="noopener" class="text-brand-blue underline font-bold">www.aboutads.info</a>) or the European Interactive Digital Advertising Alliance (<a href="https://www.youronlinechoices.eu" target="_blank" rel="noopener" class="text-brand-blue underline font-bold">www.youronlinechoices.eu</a>).
              </p>
            </div>

            <!-- Do Not Track -->
            <div class="p-5 rounded-2xl bg-brand-ghost border border-slate-200/80">
              <h3 class="font-bold text-slate-900 text-sm mb-2 flex items-center gap-2">
                <i class="fa-solid fa-ban text-brand-blue"></i> Do Not Track (DNT) Signals
              </h3>
              <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-0">
                Some browsers offer a "Do Not Track" setting. Because there is currently no single, universally adopted industry standard for how websites should respond to DNT signals, our Platform does not currently change its behavior based on them. We recommend using the cookie settings and browser controls above instead.
              </p>
            </div>

          </div>
        </article>

        <!-- 9. What Happens If You Disable Certain Cookies -->
        <article id="disable-effects" class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 card-shadow">
          <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-brand-blue flex items-center justify-center font-black text-lg shadow-sm">
              09
            </div>
            <div>
              <span class="text-xs font-bold uppercase tracking-wider text-brand-blue">Impact Analysis</span>
              <h2 class="text-2xl font-black text-slate-900 mb-0">What Happens If You Disable Certain Cookies</h2>
            </div>
          </div>

          <div class="space-y-4 text-xs sm:text-sm">
            <div class="p-5 rounded-2xl border-l-4 border-red-500 bg-red-50/40">
              <strong class="text-red-900 font-bold block mb-1.5 text-sm">Disabling Strictly Necessary Cookies</strong>
              <p class="text-slate-700 leading-relaxed mb-0">
                Usually only possible through browser settings, not our cookie banner. May prevent you from logging in, staying logged in, completing an application, or securely making a payment.
              </p>
            </div>

            <div class="p-5 rounded-2xl border-l-4 border-amber-500 bg-amber-50/40">
              <strong class="text-amber-900 font-bold block mb-1.5 text-sm">Disabling Functional Cookies</strong>
              <p class="text-slate-700 leading-relaxed mb-0">
                Means the Platform will work normally, but it won't remember your language, region, or saved search filters between visits — you'll need to reselect them each time.
              </p>
            </div>

            <div class="p-5 rounded-2xl border-l-4 border-emerald-500 bg-emerald-50/40">
              <strong class="text-emerald-900 font-bold block mb-1.5 text-sm">Disabling Analytics or Advertising Cookies</strong>
              <p class="text-slate-700 leading-relaxed mb-0">
                Has no effect on core functionality. You'll still be able to browse, apply, and use every feature of the Platform. The only difference is that we'll have less aggregate insight into how the site is used, and any ads you see will be less tailored to your interests.
              </p>
            </div>
          </div>
        </article>

        <!-- 10. Contact Us -->
        <article id="contact" class="bg-brand-blue text-white rounded-3xl p-6 sm:p-8 card-shadow-lg">
          <div class="flex items-center gap-4 mb-6 pb-4 border-b border-white/15">
            <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center font-black text-lg">
              10
            </div>
            <div>
              <span class="text-xs font-bold uppercase tracking-wider text-blue-200">Communication</span>
              <h2 class="text-2xl font-black mb-0 text-white">Contact Us</h2>
            </div>
          </div>

          <p class="text-blue-100 leading-relaxed mb-6 text-xs sm:text-sm">
            If you have questions about this Cookie Policy or how we use cookies and similar technologies, please contact us at:
          </p>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="p-5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20">
              <div class="text-[10px] font-extrabold uppercase tracking-wider text-blue-200 mb-1">Email Support</div>
              <a href="mailto:info@enrollzy.com" class="text-base font-bold text-white hover:underline flex items-center gap-2">
                <i class="fa-solid fa-envelope text-blue-300"></i> info@enrollzy.com
              </a>
            </div>

            <div class="p-5 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20">
              <div class="text-[10px] font-extrabold uppercase tracking-wider text-blue-200 mb-1">Corporate Address</div>
              <p class="text-xs text-white leading-relaxed font-semibold mb-0">
                <i class="fa-solid fa-location-dot text-blue-300 mr-1.5"></i>
                SCO 210-211, 401, 4th Floor, Sector 34A, Chandigarh, 160022.
              </p>
            </div>
          </div>
        </article>

        <!-- 11. Changes to This Policy -->
        <article id="policy-changes" class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 card-shadow">
          <div class="flex items-center gap-4 mb-6 pb-4 border-b border-slate-100">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-brand-blue flex items-center justify-center font-black text-lg shadow-sm">
              11
            </div>
            <div>
              <span class="text-xs font-bold uppercase tracking-wider text-brand-blue">Revisions</span>
              <h2 class="text-2xl font-black text-slate-900 mb-0">Changes to This Policy</h2>
            </div>
          </div>

          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-0">
            We may update this Cookie Policy from time to time — for example, if we start using a new analytics or advertising tool, or if cookie-consent laws in a region we operate in change. When we make a material change, we will update the "Last Updated" date above and, where legally required, we will ask for your renewed consent through the cookie banner before that new cookie is activated.
          </p>
        </article>

      </div>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Toggle Elements
    const toggleFunctional = document.getElementById('toggle-functional');
    const toggleAnalytics = document.getElementById('toggle-analytics');
    const toggleAdvertising = document.getElementById('toggle-advertising');

    const statusFunctional = document.getElementById('status-functional');
    const statusAnalytics = document.getElementById('status-analytics');
    const statusAdvertising = document.getElementById('status-advertising');

    const btnAcceptAll = document.getElementById('btn-accept-all');
    const btnRejectAll = document.getElementById('btn-reject-all');

    function updateStatus(checkbox, statusElem) {
      if (!checkbox || !statusElem) return;
      if (checkbox.checked) {
        statusElem.textContent = 'Active';
        statusElem.className = 'text-[11px] font-extrabold text-emerald-600';
      } else {
        statusElem.textContent = 'Disabled';
        statusElem.className = 'text-[11px] font-extrabold text-slate-400';
      }
    }

    if (toggleFunctional && statusFunctional) {
      toggleFunctional.addEventListener('change', () => updateStatus(toggleFunctional, statusFunctional));
    }
    if (toggleAnalytics && statusAnalytics) {
      toggleAnalytics.addEventListener('change', () => updateStatus(toggleAnalytics, statusAnalytics));
    }
    if (toggleAdvertising && statusAdvertising) {
      toggleAdvertising.addEventListener('change', () => updateStatus(toggleAdvertising, statusAdvertising));
    }

    if (btnAcceptAll) {
      btnAcceptAll.addEventListener('click', function() {
        if (toggleFunctional) toggleFunctional.checked = true;
        if (toggleAnalytics) toggleAnalytics.checked = true;
        if (toggleAdvertising) toggleAdvertising.checked = true;
        updateStatus(toggleFunctional, statusFunctional);
        updateStatus(toggleAnalytics, statusAnalytics);
        updateStatus(toggleAdvertising, statusAdvertising);
      });
    }

    if (btnRejectAll) {
      btnRejectAll.addEventListener('click', function() {
        if (toggleFunctional) toggleFunctional.checked = false;
        if (toggleAnalytics) toggleAnalytics.checked = false;
        if (toggleAdvertising) toggleAdvertising.checked = false;
        updateStatus(toggleFunctional, statusFunctional);
        updateStatus(toggleAnalytics, statusAnalytics);
        updateStatus(toggleAdvertising, statusAdvertising);
      });
    }

    // Scrollspy logic for Sidebar Navigation
    const sections = document.querySelectorAll('article[id]');
    const navLinks = document.querySelectorAll('#toc-nav a');

    window.addEventListener('scroll', () => {
      let current = '';
      sections.forEach(section => {
        const sectionTop = section.offsetTop - 140;
        if (pageYOffset >= sectionTop) {
          current = section.getAttribute('id');
        }
      });

      navLinks.forEach(link => {
        link.classList.remove('active-nav-link');
        if (link.getAttribute('href') === `#${current}`) {
          link.classList.add('active-nav-link');
        }
      });
    });
  });
</script>
@endpush
