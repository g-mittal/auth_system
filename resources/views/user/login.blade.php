@extends('layouts.app')

@section('content')
    <button id="logout" onclick="logout()">
        Logout
    </button>

    <div>
        <form id="login-form">
            <h1>Login</h1>
            @csrf
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Login</button>
            <br>
            <br>
            <a href="/forgot_password">
                <button type="button">Forgot Password ?</button>
            </a>
        </form>
        <div id="response"></div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const access_token = localStorage.getItem('access_token');
            if (access_token) {
                // If access_token is present, show the Logout button and hide the login form
                document.getElementById('logout').style.display = 'block';
                document.getElementById('login-form').style.display = 'none';
            } else {
                // If access_token is not present, show the login form and hide the Logout button
                document.getElementById('login-form').style.display = 'block';
                document.getElementById('logout').style.display = 'none';
            }
        });

        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Send a POST request to your server to log in the user
            fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: email,
                    password: password,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    console.log(data);

                    localStorage.setItem('access_token', data.access_token);

                    // Login successful, you can handle the response as needed
                    document.getElementById('response').textContent = 'Login successful';

                    window.location.href = '/';
                } else {
                    // Login failed, display an error message
                    document.getElementById('response').textContent = 'Login failed';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
        
        const logout = () => {
            
            access_token = localStorage.getItem('access_token');
            console.log(access_token)
            
            
            // Send a POST request to your server to log in the user
            fetch('/api/logout', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${access_token}`
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    // console.log(data);
                    localStorage.removeItem('access_token');
                    document.getElementById('response').textContent = 'Logout successful';

                    window.location.href = '/';
                } else {
                    // Login failed, display an error message
                    console.log("error");
                    document.getElementById('response').textContent = 'Logout failed';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
@endsection