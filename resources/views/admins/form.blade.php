<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" 
                   class="form-control @error('first_name') is-invalid @enderror" 
                   value="{{ old('first_name', $admin->user->first_name ?? '') }}" required>
            @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" 
                   class="form-control @error('last_name') is-invalid @enderror" 
                   value="{{ old('last_name', $admin->user->last_name ?? '') }}" required>
            @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" 
           class="form-control @error('email') is-invalid @enderror" 
           value="{{ old('email', $admin->user->email ?? '') }}" required>
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" 
           class="form-control @error('username') is-invalid @enderror" 
           value="{{ old('username', $admin->user->username ?? '') }}" required>
    @error('username')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="phone_number">Phone Number</label>
    <input type="text" name="phone_number" id="phone_number" 
           class="form-control @error('phone_number') is-invalid @enderror" 
           value="{{ old('phone_number', $admin->user->phone_number ?? '') }}">
    @error('phone_number')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="password">{{ isset($admin) ? 'New ' : '' }}Password</label>
    <input type="password" name="password" id="password" 
           class="form-control @error('password') is-invalid @enderror" 
           {{ !isset($admin) ? 'required' : '' }}>
    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if(isset($admin))
<div class="form-group">
    <label for="password_confirmation">Confirm {{ isset($admin) ? 'New ' : '' }}Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" 
           class="form-control" {{ !isset($admin) ? 'required' : '' }}>
</div>
@endif

<div class="form-group">
    <label for="role">Admin Role</label>
    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
        <option value="Admin" {{ old('role', $admin->role ?? '') == 'Admin' ? 'selected' : '' }}>Admin</option>
        <option value="SuperAdmin" {{ old('role', $admin->role ?? '') == 'SuperAdmin' ? 'selected' : '' }}>SuperAdmin</option>
    </select>
    @error('role')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mt-4">
    <button type="submit" class="btn btn-primary">
        <i class="fa fa-save"></i> {{ isset($admin) ? 'Update' : 'Create' }} Admin
    </button>
</div>