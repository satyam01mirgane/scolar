@include('front.common.sidebar')
<div class="content-wrapper" style="background-color: #f4f6f9; min-height: 100vh; padding: 20px;">
    <!-- Content Header -->
    <section class="content-header" style="margin-bottom: 20px;">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="font-size: 2.5rem; color: #333; font-weight: 600;"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right" style="background: none; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #007bff; text-decoration: none;">Home</a></li>
                        <li class="breadcrumb-item active" style="color: #6c757d;">User Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @php
                    $photo = isset(Auth::user()->photo) ? asset('profile/' . Auth::user()->photo) : asset('user.png');
                    @endphp
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline" style="border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.1); overflow: hidden;">
                        <div class="card-body box-profile text-center" style="padding: 30px;">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="{{ $photo }}"
                                 alt="User profile picture"
                                 style="width: 150px; height: 150px; object-fit: cover; border: 5px solid #fff; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
                            <h3 class="profile-username text-center" style="font-size: 1.5rem; color: #333; margin: 10px 0;">{{ Auth::user()->name }}</h3>
                            <p class="text-sm text-primary" style="font-size: 0.9rem;">Member Since {{ date('d M Y', strtotime(Auth::user()->created_at)) }}</p>
                        </div>
                    </div>

                    <!-- About Me -->
                    <div class="card card-primary" style="border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.1); overflow: hidden; margin-top: 20px;">
                        <div class="card-header" style="background-color: #007bff; color: #fff;">
                            <h3 class="card-title" style="font-size: 1.2rem;">About Me</h3>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <strong><i class="fas fa-map-marker-alt mr-1" style="color: #007bff;"></i> Location</strong>
                            <p class="text-muted" style="font-size: 0.9rem; margin-top: 5px;">{{ Auth::user()->address }}</p>
                        </div>
                    </div>
                </div>

                <!-- Profile Details -->
                <div class="col-md-9">
                    <div class="card" style="border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.1); overflow: hidden;">
                        <div class="card-body p-0">
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success" style="margin: 20px; border-radius: 10px; padding: 15px; animation: fadeIn 0.5s ease-out;">
                                <p style="margin: 0;">{{ $message }}</p>
                            </div>
                            @endif
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="border-top: none;">
                                            <a href="{{ url('profile-edit') }}" class="badge bg-danger float-right" style="padding: 10px 15px; font-size: 0.9rem; text-decoration: none; border-radius: 5px;">Edit Profile</a>
                                        </td>
                                    </tr>
                                    @php
                                    $fields = [
                                        'Personal ID' => 'User' . Auth::user()->unique_id,
                                        'Name' => Auth::user()->name,
                                        'Email Address' => Auth::user()->email,
                                        'Contact Number' => Auth::user()->phone_number,
                                        'Password' => '**************',
                                        'Address' => Auth::user()->address,
                                        'Pincode' => Auth::user()->pincode,
                                        'Date of Birth' => date('d-M-Y', strtotime(Auth::user()->dob)),
                                    ];
                                    @endphp
                                    @foreach ($fields as $key => $value)
                                    <tr>
                                        <th style="width: 30%; padding: 20px; font-size: 1rem; color: #333;">{{ $key }}</th>
                                        <td style="padding: 20px; font-size: 1rem; color: #666;">{{ $value }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('front.common.profile-footer')

<style>
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    }

    .profile-user-img:hover {
        transform: scale(1.05);
    }

    .badge:hover {
        opacity: 0.8;
    }

    tr:hover {
        background-color: #f8f9fa;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const successAlert = document.querySelector(".alert-success");
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.animation = "fadeOut 0.5s ease-out forwards";
            }, 2000);
        }
    });
</script>
