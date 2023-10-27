@extends('layouts.app')

@section('content')
    {{-- <button id="logout" onclick="logout()">
        Logout
    </button> --}}

    
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
    

    <script>

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

                    window.location.href = '/user';
                } else {
                    // Login failed, display an error message
                    document.getElementById('response').textContent = 'Login failed';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
        
    </script>
@endsection