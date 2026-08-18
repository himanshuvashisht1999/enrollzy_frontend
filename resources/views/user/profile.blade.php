@extends('user.layout')

@section('dashboard_content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <h4 class="fw-bold mb-4">Edit Profile</h4>
        
        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold small text-muted">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold small text-muted">Email Address <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold small text-muted">Mobile Number</label>
                    <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $user->mobile) }}">
                    @error('mobile')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold small text-muted">Date of Birth</label>
                    <input type="date" name="dob" class="form-control" value="{{ old('dob', $user->dob) }}">
                    @error('dob')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold small text-muted">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold small text-muted">Country</label>
                    <input type="text" name="country" class="form-control" value="{{ old('country', $user->country) }}">
                    @error('country')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold small text-muted">State</label>
                    <input type="text" name="state" class="form-control" value="{{ old('state', $user->state) }}">
                    @error('state')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold small text-muted">City</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', $user->city) }}">
                    @error('city')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold rounded-pill shadow-sm" style="background: #1e3a8a; border: none;">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
