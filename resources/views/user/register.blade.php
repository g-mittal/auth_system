<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form id="login-form">
            @csrf
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Register</button>
        </form>
        <div id="response"></div>
    </div>
    
    <script>
            document.getElementById('login-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
    
                // Send a POST request to your server to log in the user
                fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        name: name,
                        email: email,
                        password: password,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 200) {
                        console.log(data);
    
                        // Login successful, you can handle the response as needed
                        document.getElementById('response').textContent = data.message;
    
                        // window.location.href = '/login';
                    } else {
                        // Login failed, display an error message
                        document.getElementById('response').textContent = ' failed';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        </script>
</body>
</html>