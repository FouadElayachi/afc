<!DOCTYPE html>
<html>
<head>
    <title class="droid-arabic-kufi" dir="rtl" lang="ar">مرحبا بكم في الموقع الرسمي لأكاديمية أطر الغد</title>
</head>
 
<body class="droid-arabic-kufi" dir="rtl" lang="ar">
<h2>{{$user['first_name_ar']}} {{$user['last_name_ar']}}</h2>
<h3>مرحبا بكم في الموقع الرسمي لأكاديمية أطر الغد</h3>
<br/>
البريد الإ لكتروني الخاص بك هو: {{$user['email']}}
<br/>
المرجوا الضغط على الرابط التالي لتأكيد تسجيلكم
<br/>
<a href="{{url('user/verify', $user->verifyUser->token)}}"><h3>تأكيد</h3></a>
</body>
 
</html>