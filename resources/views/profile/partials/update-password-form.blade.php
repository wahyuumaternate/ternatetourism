<form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="current_password">Current Password</label>
        <div class="input-group">
            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                id="current_password" name="current_password" required>
            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_password')">
                <i class="bi bi-eye" id="current_password_icon"></i>
            </button>
            @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="password">New Password</label>
        <div class="input-group">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" required minlength="8">
            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                <i class="bi bi-eye" id="password_icon"></i>
            </button>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="progress mt-2" style="height: 5px;">
            <div id="password-strength" class="progress-bar" role="progressbar" style="width: 0%"></div>
        </div>
        <small id="passwordHelpBlock" class="form-text text-muted">
            Password strength: <span id="strength-text">None</span>
            <br>Password must be at least 8 characters
        </small>
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <div class="input-group">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required
                minlength="8">
            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')">
                <i class="bi bi-eye" id="password_confirmation_icon"></i>
            </button>
        </div>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-outline-primary submit-btn" id="submitBtn" disabled>Update
            Password</button>
    </div>
</form>

<style>
    .submit-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #6c757d;
    }
</style>

@section('scripts')
    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + '_icon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }

        // Function to validate password and update button state
        function validatePassword() {
            const password = document.getElementById('password').value;
            const confirmation = document.getElementById('password_confirmation').value;
            const submitBtn = document.getElementById('submitBtn');
            const currentPassword = document.getElementById('current_password').value;

            // Enable button only if all conditions are met
            const isValid = password.length >= 8 &&
                password === confirmation &&
                currentPassword.length > 0;

            submitBtn.disabled = !isValid;
        }

        // Add input event listeners to all password fields
        document.getElementById('password').addEventListener('input', function() {
            validatePassword();
            updatePasswordStrength(this.value);
        });
        document.getElementById('password_confirmation').addEventListener('input', validatePassword);
        document.getElementById('current_password').addEventListener('input', validatePassword);

        function updatePasswordStrength(password) {
            const strengthBar = document.getElementById('password-strength');
            const strengthText = document.getElementById('strength-text');

            let strength = 0;

            // Length check
            if (password.length >= 8) strength += 20;

            // Uppercase check
            if (password.match(/[A-Z]/)) strength += 20;

            // Lowercase check
            if (password.match(/[a-z]/)) strength += 20;

            // Number check
            if (password.match(/[0-9]/)) strength += 20;

            // Special character check
            if (password.match(/[^A-Za-z0-9]/)) strength += 20;

            // Update progress bar
            strengthBar.style.width = strength + '%';

            // Update color and text based on strength
            if (strength <= 20) {
                strengthBar.className = 'progress-bar bg-danger';
                strengthText.textContent = 'Very Weak';
            } else if (strength <= 40) {
                strengthBar.className = 'progress-bar bg-warning';
                strengthText.textContent = 'Weak';
            } else if (strength <= 60) {
                strengthBar.className = 'progress-bar bg-info';
                strengthText.textContent = 'Medium';
            } else if (strength <= 80) {
                strengthBar.className = 'progress-bar bg-primary';
                strengthText.textContent = 'Strong';
            } else {
                strengthBar.className = 'progress-bar bg-success';
                strengthText.textContent = 'Very Strong';
            }
        }
    </script>
@endsection
