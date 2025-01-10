@extends('admin.layouts.main', ['title' => 'Profil User'])
@section('main')
    <div class="container-fluid">
        <div class="col-lg-12">
            <!-- Card untuk Update Profile Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Update Profile Information</h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Card untuk Update Password -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Update Password</h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div> <!-- /.col -->
    </div> <!-- /.container-fluid -->
@endsection
