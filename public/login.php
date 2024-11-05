<!-- public/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Login</title>
    <style>
        body {
            background-color: #f8f9fa; /* Light background for the body */
        }
        .fade-in {
            opacity: 0;
            animation: fadeIn 1s forwards; /* Fade-in effect */
        }
        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
        .container {
            max-width: 400px; /* Limit container width for better appearance */
            margin-top: 100px; /* Adjust top margin for centering */
            padding: 20px; /* Add padding to the container */
            background-color: white; /* White background for the form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
        }
        h2, h3 {
            color: #343a40; /* Darker color for the headings */
        }
        .btn-primary {
            background-color: #007bff; /* Primary button color */
            border-color: #007bff; /* Border color */
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-color: #0056b3; /* Border color on hover */
        }
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="dashboard_admin.php">The Book Blockbuster</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
<body class="fade-in">
    <div class="container mt-5">
        <h2 class="text-center">Login</h2>
        
        <form action="../includes/auth.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button> <!-- Added btn-block for full-width -->
        </form>
        <p class="mt-3 text-center">
            <a href="register.php">Register</a> | 
            <a href="forgot_password.php">Forgot Password?</a>
        </p>
    </div>
</body>
</html>