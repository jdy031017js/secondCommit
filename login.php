<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인</title>
</head>
<body>
    <h2>로그인</h2>
    <form action="login_process.php" method="post">
        <label for="username">사용자명:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">비밀번호:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">로그인</button>
    </form>

    <!-- 회원가입 페이지로 이어지는 버튼 -->
    <p>계정이 없으신가요? <a href="register.php">회원가입</a></p>
</body>
</html>
