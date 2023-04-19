<h3>Acharya Password Reset Link</h3>

Dear {{ $user->name }},<br><br>
Please change your account password by clicking below link: <br>
<a href="{{ route('resetpassword', $user->email) }}">Reset Password</a><br><br>

Regards<br>
<p>Team Acharya</p>