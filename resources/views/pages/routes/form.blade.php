<div class="card border-2 border-primary rounded-3">
    <div class="card-body">
        <div class="form-group mb-4">
            <label for="name" class="form-label fw-bold text-primary">{{ 'Route Name' }} <span
                    class="text-danger">*</span></label>
            <div class="input-group border-2 border-primary rounded-3">
                <span class="input-group-text bg-primary text-white border-primary"><i class="fas fa-route"></i></span>
                <input class="form-control form-control-lg @error('name') is-invalid @enderror" name="name"
                    type="text" id="name" placeholder="Enter route name"
                    value="{{ old('name', $route->name ?? '') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="starting_station_id"
                        class="form-label fw-bold text-primary">{{ 'Starting Station' }}</label>
                    <div class="input-group border-2 border-primary rounded-3">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-map-marker"></i></span>
                        <select class="form-select form-control-lg @error('starting_station_id') is-invalid @enderror"
                            name="starting_station_id" id="starting_station_id">
                            <option value="">Select Starting Station</option>
                            @foreach ($busStops as $busStop)
                                <option value="{{ $busStop->id }}"
                                    {{ old('starting_station_id', $route->starting_station_id ?? '') == $busStop->id ? 'selected' : '' }}>
                                    {{ $busStop->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('starting_station_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="ending_station_id"
                        class="form-label fw-bold text-primary">{{ 'Ending Station' }}</label>
                    <div class="input-group border-2 border-primary rounded-3">
                        <span class="input-group-text bg-primary text-white"><i
                                class="fas fa-map-marker-alt"></i></span>
                        <select class="form-select form-control-lg @error('ending_station_id') is-invalid @enderror"
                            name="ending_station_id" id="ending_station_id">
                            <option value="">Select Ending Station</option>
                            @foreach ($busStops as $busStop)
                                <option value="{{ $busStop->id }}"
                                    {{ old('ending_station_id', $route->ending_station_id ?? '') == $busStop->id ? 'selected' : '' }}>
                                    {{ $busStop->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('ending_station_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mb-4">
            <label for="timetable" class="form-label fw-bold text-primary">{{ 'Timetable' }}</label>
            <div class="input-group border-2 border-primary rounded-3">
                <span class="input-group-text bg-primary text-white"><i class="fas fa-clock"></i></span>
                <select class="form-control form-control-lg @error('timetable') is-invalid @enderror" name="timetable[]" id="timetable" multiple>
                    <!-- Example time slots for morning, afternoon, and evening -->
                    <option value="08:00" {{ in_array('08:00', old('timetable', [])) ? 'selected' : '' }}>08:00</option>
                    <option value="09:00" {{ in_array('09:00', old('timetable', [])) ? 'selected' : '' }}>09:00</option>
                    <option value="10:00" {{ in_array('10:00', old('timetable', [])) ? 'selected' : '' }}>10:00</option>
                    <option value="12:00" {{ in_array('12:00', old('timetable', [])) ? 'selected' : '' }}>12:00</option>
                    <option value="13:00" {{ in_array('13:00', old('timetable', [])) ? 'selected' : '' }}>13:00</option>
                    <option value="14:00" {{ in_array('14:00', old('timetable', [])) ? 'selected' : '' }}>14:00</option>
                    <option value="16:00" {{ in_array('16:00', old('timetable', [])) ? 'selected' : '' }}>16:00</option>
                    <option value="18:00" {{ in_array('18:00', old('timetable', [])) ? 'selected' : '' }}>18:00</option>
                </select>
                @error('timetable')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <small class="form-text text-muted ms-2">
                Select available times for the timetable. Hold down the `Ctrl` (Windows) or `Command` (Mac) key to select multiple options.
            </small>
        </div>
        
    </div>
</div>

<div class="form-group mt-5 text-center">
    <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill border-2 border-white">
        <i class="fas fa-save me-2"></i>{{ $formMode === 'edit' ? 'Update Route' : 'Create Route' }}
    </button>
</div>
