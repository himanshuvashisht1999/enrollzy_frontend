@extends('user.layout')

@section('dashboard_content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <h4 class="fw-bold mb-4">My Bookings</h4>
        
        @if($bookings->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="fa-regular fa-calendar-xmark fa-4x mb-3 opacity-50"></i>
                <h5>No Bookings Found</h5>
                <p>You haven't booked any sessions yet.</p>
                <a href="{{ route('experts') }}" class="btn btn-outline-primary rounded-pill mt-2 fw-bold">Find an Expert</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-muted small fw-bold text-uppercase">Booking ID</th>
                            <th scope="col" class="text-muted small fw-bold text-uppercase">Expert</th>
                            <th scope="col" class="text-muted small fw-bold text-uppercase">Date & Time</th>
                            <th scope="col" class="text-muted small fw-bold text-uppercase">Mode</th>
                            <th scope="col" class="text-muted small fw-bold text-uppercase">Status</th>
                            <th scope="col" class="text-muted small fw-bold text-uppercase">Meeting Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td class="fw-bold font-monospace">{{ $booking->booking_id }}</td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $booking->expert_name }}</div>
                                </td>
                                <td>
                                    @if($booking->slot_date)
                                        <div class="text-dark fw-bold">{{ date('d M Y', strtotime($booking->slot_date)) }}</div>
                                        <div class="small text-muted">{{ date('h:i A', strtotime($booking->start_time)) }} - {{ date('h:i A', strtotime($booking->end_time)) }}</div>
                                    @else
                                        <span class="text-muted small">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-secondary rounded-pill text-capitalize">{{ $booking->mode ?? 'Video' }}</span>
                                </td>
                                <td>
                                    @if($booking->status == 'confirmed')
                                        <span class="badge bg-success rounded-pill px-3 py-2"><i class="fa-solid fa-check me-1"></i> Confirmed</span>
                                    @elseif($booking->status == 'pending')
                                        <span class="badge bg-warning text-dark rounded-pill px-3 py-2"><i class="fa-solid fa-clock me-1"></i> Pending</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill px-3 py-2">{{ ucfirst($booking->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($booking->meeting_link)
                                        <a href="{{ $booking->meeting_link }}" target="_blank" class="btn btn-sm btn-primary rounded-pill">Join Meeting</a>
                                    @else
                                        <span class="text-muted small">Not available</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
