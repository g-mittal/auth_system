@extends('layouts.app')

@section('content')
    <div class="container">
        <form id="login-form">
            <h1>Reset your password</h1>
            @csrf
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="enter email" required>
            <br>
            <br>
            <button type="submit">Submit</button>
        </form>
        <div id="response"></div>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            
            // Send a POST request to your server to log in the user
            fetch('/api/send_reset_password_email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: email,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    console.log(data);

                    // localStorage.setItem('access_token', data.access_token);

                    // Login successful, you can handle the response as needed
                    document.getElementById('response').textContent = data.message;
                    alert(data.message);

                    // window.location.href = '/';
                } else {
                    // Login failed, display an error message
                    document.getElementById('response').textContent = data.message;
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
@endsection