<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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

                    

                    // localStorage.setItem('access_token', data.access_token);

                    // Login successful, you can handle the response as needed
                    // document.getElementById('response').textContent = data.message;

                    alert("password reset successful, please login with your new password")

                    // window.location.href = '/';
                } else {
                    // Reset failed, display an error message
                    // document.getElementById('response').textContent = data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>