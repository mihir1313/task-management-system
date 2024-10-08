<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('admin-title')</title>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    @yield('admin-header')
</head>
<body>
    <div class="container">
       @include('admin.layouts.sidebar')
        <div class="main-content">
            @include('admin.layouts.header')

            <!-- Content Section -->
            <section class="content">
    
                @yield('admin-content')
    
            </section>
           
        </div>
        
    </div>
    
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    @yield('admin-footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notificationIcon = document.getElementById('notificationIcon');
            const notificationDropdown = document.getElementById('notificationDropdown');
    
            if (notificationIcon && notificationDropdown) {
                notificationIcon.addEventListener('click', function() {
                    notificationDropdown.style.display = (notificationDropdown.style.display === 'none' || notificationDropdown.style.display === '') ? 'block' : 'none';
                });
            }
    
            document.addEventListener('click', function(event) {
                if (notificationIcon && notificationDropdown) {
                    if (!notificationIcon.contains(event.target) && !notificationDropdown.contains(event.target)) {
                        notificationDropdown.style.display = 'none';
                    }
                }
            });
    
            const profileImg = document.getElementById('profile-img');
            const dropdownContent = document.getElementById('dropdown-content');
    
            if (profileImg && dropdownContent) {
                profileImg.addEventListener('click', function() {
                    dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
                });
    
                window.addEventListener('click', function(event) {
                    if (event.target !== dropdownContent && event.target !== profileImg) {
                        dropdownContent.style.display = 'none';
                    }
                });
            }
        });
    </script>
    
</body>
</html>
