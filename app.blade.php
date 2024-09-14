<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    @yield('styles')<!-- Custom CSS -->
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        /* Top Header Styling */
        .top-header {
            background-color: white;
            height: 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid #e5e5e5;
            position: fixed;
            width: 100%;
            z-index: 100;
            top: 0;
        }

        .top-header .brand {
            font-weight: bold;
            color: #002965;
        }

        .top-header .header-right {
            display: flex;
            align-items: center;
        }

        .top-header .header-right .lang-switch {
            margin-right: 15px;
            background-color: #f8f9fa;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .top-header .header-right .lang-switch:hover {
            background-color: #e2e6ea;
            border-color: #adb5bd;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ccc;
        }

        .nav-item {
            list-style-type: none; /* Removes the default bullet point */
            margin: 0;
            padding: 0;
        }

        .header-right {
            padding: 8vh;
        }

        .hamburger {
            font-size: 24px;
            cursor: pointer;
            z-index: 101;
            transition: color 0.3s, transform 0.3s;
        }

        .hamburger:hover {
            color: #007bff;
            transform: rotate(40deg);
        }

        .hamburger.active {
            color: #007bff;
            transform: rotate(90deg);
        }

        @media (max-width: 768px) {
            .hamburger {
                position: fixed;
                right: 3vh;
            }
        }

        @media (min-width: 769px) {
            .hamburger {
                position: absolute;
                left: 50vh;
            }
        }

        /* Side Navigation Styling */
        .side-nav {
            width: 250px;
            height: calc(100vh - 60px); /* Full height minus header */
            background-color: #002965;
            position: fixed;
            top: 60px;
            left: 0;
            padding-top: 20px;
            overflow-y: auto; /* Enable scrolling */
            transition: 0.3s;
        }

        .side-nav a {
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            color: white;
            display: block;
            transition: background-color 0.2s;
        }

        .side-nav a:hover {
            background-color: #4b6cb7;
        }

        .side-nav .active {
            margin: 5px;
            background-color: #4b6cb7;
            border-left: 5px solid white;
        }

        .side-nav hr {
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Main Content Area */
        .main-content {
            margin-left: 250px;
            margin-top: 60px; /* Adjust for header */
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .main-content .card {
            margin-bottom: 20px;
            padding: 20px;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        /* Responsive behavior */
        @media (max-width: 768px) {
            .side-nav {
                width: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }

        
.parent-link.fir:hover {
    background-color: #003d80; /* Darker shade of blue for FIR */
    color: #ffffff;
}

/* Hover effect for FIR sublist items */
.sublist.fir a:hover {
    color: #ffffff; /* Ensure sublist items change color on hover */
}


    </style>
</head>
<body>

    <!-- Top Header -->
    <div class="top-header">
        <span id="menu-toggle" class="hamburger">&#9776;</span> <!-- Hamburger Icon -->
        <div class="brand">Thane Special Branch</div>
        <div class="header-right">
            <select class="lang-switch">
                <option>English</option>
                <option>Hindi</option>
            </select>
            <li class="nav-item dropdown">
                <a id="profileDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="profile-icon"></div>
                    <span class="ms-2">{{ Auth::user()->first_name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-end profile-dropdown" aria-labelledby="profileDropdown">
                    <div class="dropdown-item d-flex align-items-center">
                        <div class="profile-icon-small me-2"></div>
                        <div>
                            <div>{{ Auth::user()->first_name }}</div>
                            <small>{{ Auth::user()->email }}</small>
                        </div>
                    </div>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item" href="">
                        <i class="fa fa-user me-2"></i> Account
                    </a>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt me-2"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </div>
    </div>

    <!-- Side Navigation Bar -->
    <div class="side-nav" id="side-nav">
    <!-- Navigation Heading -->
    <h6 style="padding-left: 20px; font-size: 12px; color: #f8f9fa; text-transform: uppercase; font-weight: bold;">Navigation</h6>
    <!-- Dashboard Link with Icon -->
    <a href="{{ route('home') }}" class="@yield('dashboard-active')" style="color: #f8f9fa; padding: 10px 20px; text-decoration: none; display: block;">
        <i class="fas fa-tachometer-alt" style="margin-right: 10px;"></i> Dashboard
    </a>

    <br>

    <!-- Forms Heading -->
    <h6 style="padding-left: 20px; font-size: 12px; color: #f8f9fa; text-transform: uppercase; font-weight: bold;">Forms</h6>

    <!-- FIR Navigation with Dropdown Icon and Sublists -->
    <!-- FIR Navigation with Dropdown Icon and Sublists -->
<!-- FIR Navigation with Dropdown Icon and Sublists -->
<a href="#" class="parent-link fir" id="fir-dropdown-toggle" style="color: #f8f9fa; padding: 10px 20px; text-decoration: none; display: block;">
    <i class="fas fa-file-alt" style="margin-right: 10px;"></i> FIR
    <i class="fas fa-caret-down" style="float: right;"></i>
</a>
<ul class="sublist fir" id="fir-dropdown" style="list-style: none; padding-left: 40px; display: none;">
    <li><a href="{{ route('fir_form') }}" class="@yield('fir_form-active')" style="color: #adb5bd; padding: 5px 20px; display: block;">FIR Form</a></li>
    <li><a href="{{ route('fir_reports') }}" class="@yield('fir_reports-active')" style="color: #adb5bd; padding: 5px 20px; display: block;">FIR Reports</a></li>
</ul>

<!-- Event Navigation with Dropdown Icon and Sublists -->
<a href="#" class="parent-link event" id="event-dropdown-toggle" style="color: #f8f9fa; padding: 10px 20px; text-decoration: none; display: block;">
    <i class="fas fa-calendar-alt" style="margin-right: 10px;"></i> Event
    <i class="fas fa-caret-down" style="float: right;"></i>
</a>
<ul class="sublist event" id="event-dropdown" style="list-style: none; padding-left: 40px; display: none;">
    <li><a href="{{ route('event_form') }}" class="@yield('event_form-active')" style="color: #adb5bd; padding: 5px 20px; display: block;">Event Form</a></li>
    <li><a href="{{ route('event_reports') }}" class="@yield('event_reports-active')" style="color: #adb5bd; padding: 5px 20px; display: block;">Event Reports</a></li>
</ul>


    <a href="{{ route('organization') }}" class="@yield('organization-active')" style="color: #f8f9fa; padding: 10px 20px; text-decoration: none; display: block;">
        <i class="fas fa-building" style="margin-right: 10px;"></i> Organization
    </a>

    <a href="{{ route('person') }}" class="@yield('person-active')" style="color: #f8f9fa; padding: 10px 20px; text-decoration: none; display: block;">
        <i class="fas fa-user" style="margin-right: 10px;"></i> Person
    </a>

    <a href="{{ route('vip') }}" class="@yield('vip-active')" style="color: #f8f9fa; padding: 10px 20px; text-decoration: none; display: block;">
        <i class="fas fa-star" style="margin-right: 10px;"></i> VIP
    </a>

    <a href="{{ route('social_media_event') }}" class="@yield('social_media_event-active')" style="color: #f8f9fa; padding: 10px 20px; text-decoration: none; display: block;">
        <i class="fas fa-share-alt" style="margin-right: 10px;"></i> Social Media Event
    </a>

    <br>

    <!-- Analytics Heading -->
    <h6 style="padding-left: 20px; font-size: 12px; color: #f8f9fa; text-transform: uppercase; font-weight: bold;">Analytics</h6>
    <a href="{{ route('event_map') }}" class="@yield('event_map-active')" style="color: #f8f9fa; padding: 10px 20px; text-decoration: none; display: block;">
    <i class="fas fa-chart-pie" style="margin-right: 10px;"></i> Event Map
</a>


    <br>

    <!-- Schedules Heading -->
    <h6 style="padding-left: 20px; font-size: 12px; color: #f8f9fa; text-transform: uppercase; font-weight: bold;">Schedules</h6>
    <a href="{{ route('event_calendar') }}" class="@yield('event_calendar-active')" style="color: #f8f9fa; padding: 10px 20px; text-decoration: none; display: block;">
    <i class="fas fa-calendar" style="margin-right: 10px;"></i> Event Calendar
</a>


    <br>

    <!-- Help Heading -->
    <h6 style="padding-left: 20px; font-size: 12px; color: #f8f9fa; text-transform: uppercase; font-weight: bold;">Help</h6>
    <a href="{{ route('faq') }}" class="@yield('faq-active')" style="color: #f8f9fa; padding: 10px 20px; text-decoration: none; display: block;">
        <i class="fas fa-question-circle" style="margin-right: 10px;"></i> FAQ
    </a>
    <a href="{{ route('support') }}" class="@yield('support-active')" style="color: #f8f9fa; padding: 10px 20px; text-decoration: none; display: block;">
        <i class="fas fa-headset" style="margin-right: 10px;"></i> Support
    </a>

    <!-- Profile Section -->
    <div style="padding-left: 20px; padding-top: 20px; background-color: #121d38;">
        <h6 style="font-size: 14px; color: #f8f9fa; text-transform: uppercase; font-weight: bold; margin-bottom: 10px;">Login As</h6>
        
        <!-- User Info -->
        <div style="display: flex; align-items: center; margin-bottom: 10px;">
            <div class="profile-icon-small" style="width: 40px; height: 40px; border-radius: 50%; background-color: #ccc; margin-right: 10px;"></div>
            <div>
                <h6 style="font-size: 16px; color: #ffffff; font-weight: bold; margin-bottom: 5px;">{{ Auth::user()->first_name }}</h6>
                <small style="color: #e0e0e0;">{{ Auth::user()->email }}</small>
            </div>
        </div>
        
        <!-- Logout Link -->
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
           style="display: flex; align-items: center; padding: 10px 20px; color: #ffffff; text-decoration: none; margin-left: 0; border-radius: 5px; transition: background-color 0.3s, color 0.3s; font-size: 16px;">
           <i class="fa fa-sign-out-alt me-2" style="font-size: 16px;"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>


    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS for Sidebar Toggle -->
    <script>
        
        document.getElementById("menu-toggle").addEventListener("click", function() {
            const sideNav = document.getElementById("side-nav");
            const mainContent = document.querySelector(".main-content");

            if (sideNav.style.width === "250px" || sideNav.style.width === "") {
                sideNav.style.width = "0";
                mainContent.style.marginLeft = "0";
                document.querySelector(".lang-switch").classList.remove("hovered");
            } else {
                sideNav.style.width = "250px";
                mainContent.style.marginLeft = "250px";
                document.querySelector(".lang-switch").classList.add("hovered");
            }
        });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the current URL path
        const currentPath = window.location.pathname;

        // Function to open dropdown
        function openDropdown(id) {
            const dropdown = document.getElementById(id);
            const toggle = document.getElementById(id + '-toggle');
            if (dropdown) {
                dropdown.style.display = 'block';
                toggle.querySelector('.fa-caret-down').style.transform = 'rotate(180deg)'; // Rotate caret icon
            }
        }

        // Check current path and open corresponding dropdown
        if (currentPath.includes('fir-form') || currentPath.includes('fir-reports')) {
            openDropdown('fir-dropdown');
        } else if (currentPath.includes('event-form') || currentPath.includes('event-reports')) {
            openDropdown('event-dropdown');
        }

        // Toggle dropdown on click
        document.querySelectorAll('.parent-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const sublist = this.nextElementSibling;
                const caretIcon = this.querySelector('.fa-caret-down');

                if (sublist.style.display === 'none' || sublist.style.display === '') {
                    sublist.style.display = 'block';
                    caretIcon.style.transform = 'rotate(180deg)'; // Rotate caret icon
                } else {
                    sublist.style.display = 'none';
                    caretIcon.style.transform = 'rotate(0deg)'; // Reset caret icon
                }
            });
        });
    });
</script>

    

</body>
</html>

