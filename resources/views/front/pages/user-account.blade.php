<!-- @include('front.common.profile-header') -->
@include('front.common.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: #f4f6f9; min-height: 100vh; padding: 20px;">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="margin-bottom: 20px;">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="font-size: 2.5rem; color: #333; font-weight: 600;">User Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right" style="background: none; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{url('/')}}" style="color: #007bff; text-decoration: none;">Home</a></li>
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
                    if(isset(Auth::user()->photo))
                    {
                        $photo = asset('profile/'.Auth::user()->photo);
                    }else{
                        $photo = asset('user.png');
                    }
                    @endphp
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline" style="border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.1); overflow: hidden; transition: all 0.3s ease;">
                        <div class="card-body box-profile" style="padding: 30px;">
                            <div class="text-center" style="margin-bottom: 20px;">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{$photo}}"
                                     alt="User profile picture"
                                     style="width: 150px; height: 150px; object-fit: cover; border: 5px solid #fff; box-shadow: 0 0 20px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                            </div>

                            <h3 class="profile-username text-center" style="font-size: 1.5rem; color: #333; margin-bottom: 10px;">{{Auth::user()->name}}</h3>
                            <div class="text-center text-sm text-primary" style="font-size: 0.9rem;">Member Since {{date('d M Y',strtotime(Auth::user()->created_at))}}</div>
                        </div>
                    </div>

                    <!-- About Me Box -->
                    <div class="card card-primary" style="border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.1); overflow: hidden; margin-top: 20px; transition: all 0.3s ease;">
                        <div class="card-header" style="background-color: #007bff; color: #fff; border-bottom: none;">
                            <h3 class="card-title" style="font-size: 1.2rem;">About Me</h3>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <strong style="font-size: 1rem; color: #333;"><i class="fas fa-map-marker-alt mr-1" style="color: #007bff;"></i> Location</strong>
                            <p class="text-muted" style="margin-top: 5px; font-size: 0.9rem;">{{Auth::user()->address}}</p>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card" style="border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.1); overflow: hidden; transition: all 0.3s ease;">
                        <div class="card-body p-0">
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success" style="margin: 20px; border-radius: 10px; background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: 15px; animation: fadeIn 0.5s ease-out;">
                                <p style="margin: 0;">{{ $message }}</p>
                            </div>
                            @endif
                            <table class="table" style="margin-bottom: 0;">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="border-top: none;">
                                            <a href="{{url('profile-edit')}}" class="badge bg-danger" style="float: right; padding: 10px 15px; font-size: 0.9rem; text-decoration: none; background-color: #dc3545; color: #fff; border-radius: 5px; transition: all 0.3s ease;">Edit Profile</a>
                                        </td>
                                    </tr>
                                    <tr style="transition: all 0.3s ease;">
                                        <th style="width: 30%; padding: 20px; font-size: 1rem; color: #333;">Personal ID</th>
                                        <td style="padding: 20px; font-size: 1rem; color: #666;">User{{Auth::user()->unique_id}}</td>
                                    </tr>
                                    <tr style="transition: all 0.3s ease;">
                                        <th style="width: 30%; padding: 20px; font-size: 1rem; color: #333;">Name</th>
                                        <td style="padding: 20px; font-size: 1rem; color: #666;">{{Auth::user()->name}}</td>
                                    </tr>
                                    <tr style="transition: all 0.3s ease;">
                                        <th style="width: 30%; padding: 20px; font-size: 1rem; color: #333;">Email Address</th>
                                        <td style="padding: 20px; font-size: 1rem; color: #666;">{{Auth::user()->email}}</td>
                                    </tr>
                                    <tr style="transition: all 0.3s ease;">
                                        <th style="width: 30%; padding: 20px; font-size: 1rem; color: #333;">Contact Number</th>
                                        <td style="padding: 20px; font-size: 1rem; color: #666;">{{Auth::user()->phone_number}}</td>
                                    </tr>
                                    <tr style="transition: all 0.3s ease;">
                                        <th style="width: 30%; padding: 20px; font-size: 1rem; color: #333;">Password</th>
                                        <td style="padding: 20px; font-size: 1rem; color: #666;">**************</td>
                                    </tr>
                                    <tr style="transition: all 0.3s ease;">
                                        <th style="width: 30%; padding: 20px; font-size: 1rem; color: #333;">Address</th>
                                        <td style="padding: 20px; font-size: 1rem; color: #666;">{{Auth::user()->address}}</td>
                                    </tr>
                                    <tr style="transition: all 0.3s ease;">
                                        <th style="width: 30%; padding: 20px; font-size: 1rem; color: #333;">Pincode</th>
                                        <td style="padding: 20px; font-size: 1rem; color: #666;">{{Auth::user()->pincode}}</td>
                                    </tr>
                                    <tr style="transition: all 0.3s ease;">
                                        <th style="width: 30%; padding: 20px; font-size: 1rem; color: #333;">Date of Birth</th>
                                        <td style="padding: 20px; font-size: 1rem; color: #666;">{{date('d-M-Y',strtotime(Auth::user()->dob))}}</td>
                                    </tr>
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
document.addEventListener('DOMContentLoaded', (event) => {
    setTimeout(function() {
        document.querySelector(".alert-success").style.animation = "fadeOut 0.5s ease-out forwards";
    }, 2000);
});

@keyframes fadeOut {
    from { opacity: 1; }
    to { opacity: 0; }
}
</script>

