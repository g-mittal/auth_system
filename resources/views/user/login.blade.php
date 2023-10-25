<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    {{-- <button id="logout" onclick="logout()">
        Logout
    </button>

    <div class="container">
        <h1>Login</h1>
        <form id="login-form">
            @csrf
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Login</button>
        </form>
        <div id="response"></div>
    </div> --}}
    
    @if (Auth::check())
        <button id="logout" onclick="logout()">
            Logout
        </button>
    @else
        <div class="container">
            <h1>Login</h1>
            <form id="login-form">
                @csrf
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                <button type="submit">Login</button>
            </form>
            <div id="response"></div>
        </div>
    @endif

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

                    // window.location.href = '/login';
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
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${access_token}`
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    // console.log(data);

                    document.getElementById('response').textContent = 'Logout successful';

                    // window.location.href = '/login';
                } else {
                    // Login failed, display an error message
                    document.getElementById('response').textContent = 'Logout failed';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>

</body>
</html>