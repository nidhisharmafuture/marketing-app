<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Marketing App – Associate Access</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background: #f1f1f1;
            padding: 30px;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
        .title {
            font-size: 26px;
            color: #333;
        }
        .btn {
            background-color: #198754;
            color: #fff;
            padding: 12px 20px;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
        }
        .credentials {
            margin-top: 15px;
        }
        .footer {
            font-size: 13px;
            color: #666;
            margin-top: 40px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="title">Hi {{ $user->name }},</div>
    <p>Your Associate account has been approved successfully!</p>

    <div class="credentials">
        <p><strong>Username (Email):</strong> {{ $user->email }}</p>
        <p><strong>Password:</strong> {{ $password }}</p>
    </div>

    <p>Tap the button below to access your mobile dashboard and start using the Marketing App:</p>
    <a href="{{ url('/associate/login') }}" class="btn">Login to Your Account</a>

    <div class="footer">
        Need help? Contact our support team.<br>
        Thank you for joining us!<br><br>
        — Marketing App Team
    </div>
</div>
</body>
</html>
