<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('assets/common/css/login.css') }}">
</head>

<body>
    <div class="container flex">
        <div class="facebook-page">
            <div class="left-section">
                <img src="{{ asset('assets/common/images/login.png') }}" alt="Image Not Found!">
            </div>
            <div class="right-section">
                <div class="text">
                    <h4>Login to your account</h4>
                </div>
                <div class="button-container">
                    <button class="login" id="userLogin" onclick="switchToUserLogin()">Login as User</button>
                    <button class="login" id="adminLogin" onclick="switchToAdminLogin()">Login as Admin</button>
                </div>
                <form id="loginForm" onsubmit="event.preventDefault(); loginUser();" method="POST">
                    @csrf
                    <input type="hidden" id="role" name="role" value="admin">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email or phone number" required>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>

                    <!-- Make sure the error container always exists in the DOM -->
                    <div class="error-container" id="errorMessage" style="display: none; color: red;"></div>

                    <div class="link">
                        <button type="submit" class="login">Login</button>
                        <span>Don&#39;t have an account? <a href="{{ route('register')  }}" class="forgot">Register</a></span>
                    </div>
                    <hr>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('userLogin').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('role').value = 'user';
        });

        document.getElementById('adminLogin').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('role').value = 'admin';
        });

        function switchToUserLogin() {
            document.getElementById('userLogin').style.backgroundColor = '#1381CA';
            document.getElementById('userLogin').style.color = '#fff';
            document.getElementById('adminLogin').style.backgroundColor = '#fff';
            document.getElementById('adminLogin').style.color = '#1381CA';
        }

        function switchToAdminLogin() {
            document.getElementById('adminLogin').style.backgroundColor = '#1381CA';
            document.getElementById('adminLogin').style.color = '#fff';
            document.getElementById('userLogin').style.backgroundColor = '#fff';
            document.getElementById('userLogin').style.color = '#1381CA';
        }

        async function loginUser() {
            const form = document.getElementById('loginForm');

            const formData = new FormData(form);

            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });
            try {
                const response = await fetch('/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();
                const errorContainer = document.getElementById('errorMessage');
                if (result.success) {
                    localStorage.setItem('authToken', result.token);

                    window.location.href = result.redirect;
                } else {
                    errorContainer.innerHTML = result.error || "Login failed. Please check your credentials.";
                    errorContainer.style.display = 'block';
                }
            } catch (error) {
                console.error('Login failed:', error);
                const errorContainer = document.getElementById('errorMessage');
                errorContainer.innerHTML = "An unexpected error occurred. Please try again.";
                errorContainer.style.display = 'block';
            }
        }
    </script>
</body>

</html>
