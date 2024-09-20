<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .create-user-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
        }
        .create-user-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .half-width {
            width: 48%;
        }
        .save-btn {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .save-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="create-user-container">
    <h2>Create User</h2>
    <form action="save_data.php" method="POST">
        <div class="form-group">
            <div class="half-width">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>
            <div class="half-width">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>
        </div>

        <div class="form-group">
            <div class="half-width">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="half-width">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
        </div>

        <div class="form-group">
            <div class="half-width">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="half-width">
                <label for="address">address</label>
                <input type="text" id="address" name="address">
            </div>
        </div>

        <div class="form-group">
            <div class="half-width">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                
            </div>
            <div class="half-width">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
        </div>

        <button type="submit" class="save-btn">Save</button>
    </form>
</div>

<script>
    // Simple client-side password match check
    document.querySelector('form').addEventListener('submit', function(event) {
        var password = document.getElementById('password').value;
        var confirm_password = document.getElementById('confirm_password').value;
        
        if (password !== confirm_password) {
            event.preventDefault(); // Prevent form submission
            alert('Passwords do not match!');
        }
    });
</script>

</body>
</html>

