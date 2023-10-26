<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
</head>
<body>
    <h1>User profile</h1>
    <div>
        <p>Name: <span id="name"></span></p>
        <p>Email: <span id="email"></span></p>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const access_token = localStorage.getItem('access_token');
            
            fetch('/api/user', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${access_token}`
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 200) {
                    console.log(data);

                    document.getElementById('name').innerText = data.data.name;
                    document.getElementById('email').innerText = data.data.email;

                    // localStorage.setItem('access_token', data.access_token);

                    // // Login successful, you can handle the response as needed
                    // document.getElementById('response').textContent = 'Login successful';

                    // window.location.href = '/';
                } else {
                    console.log("error");
                    // Login failed, display an error message
                    // document.getElementById('response').textContent = 'Login failed';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>