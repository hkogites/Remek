@extends('layouts.base')

@section('title', 'Iroda – Foglalás szerkesztése')

@section('body')
<div class="site-section py-5">
    <div class="container">
        @if(session('status'))
            <div class="alert alert-info">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Foglalás szerkesztése</h1>
            <a class="btn btn-light" href="{{ route('iroda.reservations.index') }}">Vissza</a>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Foglalás adatai</h5>
                        
                        <form method="POST" action="{{ route('iroda.reservations.update-details', $reservation) }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Név</label>
                                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $reservation->full_name) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $reservation->email) }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Telefon</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $reservation->phone) }}" placeholder="+36 20 123 4567">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Létszám</label>
                                    <input type="number" name="people_count" class="form-control" value="{{ old('people_count', $reservation->people_count) }}" min="1" max="20" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Cím</label>
                                    <input type="text" name="address" class="form-control" value="{{ old('address', $reservation->address) }}" placeholder="1234 Budapest, Utca utca 1.">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Úti cél</label>
                                    <p class="form-control-plaintext">
                                        @if($reservation->destination)
                                            {{ $reservation->destination->title }}
                                        @else
                                            -
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jelenlegi állapot</label>
                                    <p class="form-control-plaintext">
                                        <span class="badge badge-{{ $reservation->status }}">
                                            {{ $reservation->status === 'pending' ? 'Függőben' : ($reservation->status === 'confirmed' ? 'Megerősítve' : 'Törölve') }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            @if($reservation->note)
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label class="form-label">Megjegyzés (ügyfél)</label>
                                        <p class="form-control-plaintext">{{ $reservation->note }}</p>
                                    </div>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Email elküldve</label>
                                    <p class="form-control-plaintext">
                                        @if($reservation->email_sent)
                                            <span class="text-success">✓ Igen ({{ $reservation->updated_at->format('Y.m.d H:i') }})</span>
                                        @else
                                            <span class="text-muted">Nem</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Részletek mentése</button>
                            </div>
                        </form>

                        <hr>

                        <form method="POST" action="{{ route('iroda.reservations.update-status', $reservation) }}">
                            @csrf
                            <h5 class="card-title mb-3">Státusz módosítása</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Új állapot</label>
                                    <div class="custom-dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button" id="statusDropdown">
                                            <span class="status-indicator status-{{ $reservation->status }}"></span>
                                            {{ $reservation->status === 'pending' ? 'Függőben' : ($reservation->status === 'confirmed' ? 'Megerősítve' : 'Törölve') }}
                                        </button>
                                        <input type="hidden" name="status" id="selectedStatus" value="{{ $reservation->status }}">
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item status-option" href="#" data-status="pending" data-label="Függőben">
                                                <span class="status-indicator status-pending"></span>
                                                Függőben
                                            </a>
                                            <a class="dropdown-item status-option" href="#" data-status="confirmed" data-label="Megerősítve">
                                                <span class="status-indicator status-confirmed"></span>
                                                Megerősítve
                                            </a>
                                            <a class="dropdown-item status-option" href="#" data-status="cancelled" data-label="Törölve">
                                                <span class="status-indicator status-cancelled"></span>
                                                Törölve
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Admin megjegyzés</label>
                                    <textarea name="admin_notes" class="form-control" rows="3" placeholder="Admin megjegyzések...">{{ old('admin_notes', $reservation->admin_notes) }}</textarea>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Státusz frissítése</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Email küldése</h5>
                        
                        <form method="POST" action="{{ route('iroda.reservations.send-email', $reservation) }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Üzenet</label>
                                <textarea name="message" class="form-control" rows="6" placeholder="Írjon üzenetet az ügyfélnek..." required>{{ old('message') }}</textarea>
                            </div>
                            
                            <div class="text-end">
                                <button type="submit" class="btn btn-info">Email küldése</button>
                            </div>
                        </form>

                        @if($reservation->email_sent)
                            <div class="alert alert-success mt-3">
                                <small>✓ Utoljára email elküldve: {{ $reservation->updated_at->format('Y.m.d H:i') }}</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.badge-pending { background-color: #ffc107; color: #856404; }
.badge-confirmed { background-color: #28a745; color: white; }
.badge-cancelled { background-color: #dc3545; color: white; }
.form-control-plaintext {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    padding: 0.375rem 0.75rem;
    min-height: calc(1.5em + 0.75rem + 2px);
}

/* Status dropdown styles */
.status-indicator {
    display: inline-block;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin-right: 8px;
}

.status-pending {
    background-color: #ffc107;
    border: 2px solid #e0a800;
}

.status-confirmed {
    background-color: #28a745;
    border: 2px solid #1e7e34;
}

.status-cancelled {
    background-color: #dc3545;
    border: 2px solid #c82333;
}

.dropdown-toggle {
    display: flex;
    align-items: center;
}

.status-option {
    display: flex;
    align-items: center;
}

.status-option:hover {
    background-color: #f8f9fa;
}

.status-option.active {
    background-color: #007bff;
    color: white;
}

/* Custom dropdown styles */
.custom-dropdown {
    position: relative;
    display: inline-block;
    width: 100%;
}

.custom-dropdown .dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    z-index: 1000;
    padding: 8px 0;
    margin-top: 4px;
    display: none;
}

.custom-dropdown .dropdown-menu.show {
    display: block;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle status dropdown selection
    const statusOptions = document.querySelectorAll('.status-option');
    const selectedStatusInput = document.getElementById('selectedStatus');
    const statusDropdownButton = document.querySelector('#statusDropdown');
    const dropdownMenu = statusDropdownButton.nextElementSibling.nextElementSibling; // Skip the hidden input

    statusOptions.forEach(option => {
        option.addEventListener('click', function(e) {
            e.preventDefault();
            
            const status = this.dataset.status;
            const label = this.dataset.label;
            
            // Update hidden input
            selectedStatusInput.value = status;
            
            // Update button display
            statusDropdownButton.innerHTML = `
                <span class="status-indicator status-${status}"></span>
                ${label}
            `;
            
            // Update active state
            statusOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            
            // Close dropdown
            dropdownMenu.classList.remove('show');
        });
    });
    
    // Set initial active state
    const currentStatus = selectedStatusInput.value;
    statusOptions.forEach(option => {
        if (option.dataset.status === currentStatus) {
            option.classList.add('active');
        }
    });

    // Handle dropdown toggle
    statusDropdownButton.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropdownMenu.classList.toggle('show');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!statusDropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove('show');
        }
    });

    // Prevent dropdown from closing when clicking inside
    dropdownMenu.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});
</script>
@endsection

@section('footer')
@endsection
