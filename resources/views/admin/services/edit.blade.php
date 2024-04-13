@extends('layouts.app')

@push('styles')
@endpush

@section('content')
<div class="container">
    <div class="row mb-3">
        <!-- ADD RETURN BUTTON -->
        <a href="{{ route('services.index') }}" class="">Back to Services</a>
    </div>
    <div class="card">
        <div class="card-header">
            Update Service
        </div>

        <div class="card-body p-2">
            <form method="POST" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $service->name }}"
                                required>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="duration">Duration (in minutes)</label>
                            <input type="number" class="form-control" id="duration" name="duration"
                                value="{{ $service->duration }}" required>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                required>{{ $service->description }}</textarea>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="buffer_time">Buffer Time (in minutes)</label>
                            <input type="number" class="form-control" id="buffer_time" value="{{ $service->buffer_time }}" name="buffer_time" required>
                            @error('buffer_time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="cost">Cost</label>
                            <input type="number" class="form-control" id="cost" name="cost" value="{{ $service->cost }}"
                                required>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="location">Location</label>
                            <select class="form-select" id="location" name="location" required>
                                <option value="remote" {{ $service->location == 'remote' ? 'selected' : '' }}>Remote
                                </option>
                                <option value="in-person" {{ $service->location == 'in-person' ? 'selected' : '' }}>
                                    In-person</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="is_active">Status</label>
                            <select name="is_active" id="is_active" class="form-select">
                                <option value="1" {{ $service->is_active ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$service->is_active ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary mt-1">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush