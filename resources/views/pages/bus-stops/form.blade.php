<div class="form-group mb-4">
    <label for="name" class="form-label fw-bold text-primary">{{ 'Bus Stop Name' }} <span
            class="text-danger">*</span></label>
    <input class="form-control form-control-lg border-2 border-primary @error('name') is-invalid @enderror" name="name"
        type="text" id="name" placeholder="Enter bus stop name" value="{{ old('name', $busStop->name ?? '') }}">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group mb-4">
    <label for="location" class="form-label fw-bold text-primary">{{ 'Location Address' }} <span
            class="text-danger">*</span></label>
    <div class="input-group">
        <span class="input-group-text bg-primary text-white"><i class="fas fa-map-marker-alt"></i></span>
        <input class="form-control form-control-lg border-primary @error('location') is-invalid @enderror"
            name="location" type="text" id="location" placeholder="Enter full address"
            value="{{ old('location', $busStop->location ?? '') }}">
        @error('location')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="form-group">
            <label for="latitude" class="form-label fw-bold text-primary">{{ 'Latitude' }}</label>
            <div class="input-group">
                <span class="input-group-text bg-primary text-white"><i class="fas fa-globe-americas"></i></span>
                <input class="form-control form-control-lg border-primary @error('latitude') is-invalid @enderror"
                    name="latitude" type="number" step="0.000001" id="latitude" placeholder="40.712776"
                    value="{{ old('latitude', $busStop->latitude ?? '') }}" min="-90" max="90">
                <span class="input-group-text">°N</span>
                @error('latitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <small class="form-text text-muted ms-2">Decimal format between -90.000000 and 90.000000</small>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="longitude" class="form-label fw-bold text-primary">{{ 'Longitude' }}</label>
            <div class="input-group">
                <span class="input-group-text bg-primary text-white"><i class="fas fa-globe"></i></span>
                <input class="form-control form-control-lg border-primary @error('longitude') is-invalid @enderror"
                    name="longitude" type="number" step="0.000001" id="longitude" placeholder="-74.005974"
                    value="{{ old('longitude', $busStop->longitude ?? '') }}" min="-180" max="180">
                <span class="input-group-text">°E</span>
                @error('longitude')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <small class="form-text text-muted ms-2">Decimal format between -180.000000 and 180.000000</small>
        </div>
    </div>
</div>

<div class="form-group mt-5 text-center">
    <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill">
        <i class="fas fa-save me-2"></i>{{ $formMode === 'edit' ? 'Update Bus Stop' : 'Create Bus Stop' }}
    </button>
</div>
