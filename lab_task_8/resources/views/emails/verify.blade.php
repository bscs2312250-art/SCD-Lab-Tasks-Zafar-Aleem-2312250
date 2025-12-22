<!DOCTYPE html>
<html>
<head>
    <title>Verify Your Email</title>
</head>
<body style="font-family: sans-serif; background-color: #f3f4f6; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px;">
        <h2 style="color: #333;">Verify Your Email Address</h2>
        <p>Please click the link below to verify your email address and activate your account:</p>
        <p>
            <a href="{{ route('verify', $token) }}" style="display: inline-block; padding: 10px 20px; background-color: #6366f1; color: white; text-decoration: none; border-radius: 5px;">Verify Email</a>
        </p>
        <p style="color: #666; font-size: 14px;">If you didn't create an account, you can simply ignore this email.</p>
    </div>
</body>
</html>
