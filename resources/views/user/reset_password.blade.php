@extends('layouts.app')

@section('content')
    <div class="container">
        <form id="login-form">
            <h1>Enter new password</h1>
            @csrf
            <label for="password">Your new password:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <br>
            <button type="submit">Submit</button>
        </form>
        <div id="response"></div>

        
    </div>

    <script>
        // const token = ''
        const token = '<?php echo $token; ?>';
        console.log(token);

        document.getElementById('login-form').addEventListener('submit', function(e) {
            console.log("hi")
            e.preventDefault();
            const password = document.getElementById('password').value;
            
            // Send a POST request to your server to log in the user
            fetch('/api/reset_password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    password: password,
                    token: token
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    console.log(data);

                    alert(data.message);

                    window.location.href = '/login';
                } else {
                    // Reset failed, display an error message
                    alert(data.message);
                    window.location.href = '/forgot_password';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
@endsection