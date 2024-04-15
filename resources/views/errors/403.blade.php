@extends('layouts.booking')

@push('styles')
<style>
    .error-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50vh;
    }

    .error-card {
        max-width: 400px;
        text-align: center;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .error-icon {
        font-size: 48px;
        color: #f44336;
    }

    .error-message {
        margin-top: 20px;
        font-size: 18px;
    }
</style>
@endpush

@section('content')
<div class="error-container">
    <div class="card error-card">
        <div class="card-body">
            <i class="fas fa-exclamation-triangle error-icon"></i>
            <h5 class="card-title mt-3">Access Denied</h5>
            <p class="card-text error-message">{{ $exception->getMessage() }}</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
