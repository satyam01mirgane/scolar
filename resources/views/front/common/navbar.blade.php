<!-- Header -->
<header id="header" data-transparent="true" style="background-color: white;" class="dark submenu-light">
    <div class="header-inner">
        <div class="container">
            <!-- Logo -->
            <div id="logo">
                <a href="{{url('/')}}">
                    <span class="logo-default">
                        <img src="{{asset('assets/images/logo.svg')}}" alt="logo">
                    </span>
                    <span class="logo-dark">
                        <img src="{{asset('assets/images/logo.svg')}}" alt="logo">
                    </span>
                </a>
            </div>
            <!-- End: Logo -->
            <!-- Search -->
            <div id="search">
                <a id="btn-search-close" class="btn-search-close" aria-label="Close search form"><i class="icon-x"></i></a>
                <form class="search-form" method="get" action="{{url('workshops')}}" id="srchfrm">
                    <input class="form-control" name="search" type="text" placeholder="Type & Search..." />
                    <span class="text-muted">Start typing & press "Enter" or "ESC" to close</span>
                </form>
            </div>
            <!-- End: Search -->
            <!-- Header Extras -->
            <div class="header-extras">
                <ul>
                    <li>
                        <a id="btn-search" href="#"> <i class="icon-search"></i></a>
                    </li>
                    <li id="shopping-cart">
                        <a href="{{url('cart')}}" style="display: inline-flex;">
                            <i class="fa fa-shopping-cart" style="color: black" aria-hidden="true"></i>
                            <span class="shopping-cart-items">{{ Cart::getTotalQuantity() }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End: Header Extras -->
            <!-- Navigation Responsive Trigger -->
            <div id="mainMenu-trigger">
                <a class="lines-button x"><span class="lines"></span></a>
            </div>
            <!-- End: Navigation Responsive Trigger -->
            <!-- Navigation -->
            <div id="mainMenu">
                <div class="container">
                    <nav>
                        <ul>
                            <li class="active"><a href="{{url('/')}}" style="color: black">Home</a></li>
                            <li><a href="{{url('/about-us')}}" style="color: black">About</a></li>
                            <li><a href="{{url('/courses')}}" style="color: black">workshop</a></li>
                            <li><a href="{{url('/blogs')}}" style="color: black">Study Material</a></li>
                            <li><a href="{{url('/workshops')}}" style="color: black">Career</a></li>
                           
                           
                            

                            <li><a href="{{url('/contact-us')}}" style="color: black">Contact</a></li>

                            @if(isset(Auth::user()->name))
                            <!-- User Icon with Dropdown -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: black; display: inline-flex; align-items: center;">
                                    <i class="fa fa-user-circle" style="font-size: 24px; margin-right: 5px;"></i>
                                    Hi, {{ ucfirst(substr(Auth::user()->name, 0, 8)) }}&nbsp;<i class="fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                                    <li><a href="{{url('logout')}}">Logout</a></li>
                                </ul>
                            </li>
                            @else
                            <!-- Login Button -->
                            <a href="{{url('login')}}" style="margin-left: 70px;" class="btn btn-rounded">Login</a>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- End: Navigation -->
        </div>
    </div>
</header>
