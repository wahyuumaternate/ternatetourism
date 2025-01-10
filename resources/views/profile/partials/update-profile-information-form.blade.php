<form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('patch')

    <div class="form-group">
        <label for="name">Name</label>
        @if ($user->name === 'Admin')
            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
            <input type="hidden" name="name" value="{{ $user->name }}">
        @else
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $user->name) }}" required>
        @endif
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
            value="{{ old('email', $user->email) }}" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-outline-primary">Save Changes</button>
    </div>
</form>
