<?php
session_start();

include 'index_DB.php';


// 회원가입 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 실제로는 데이터베이스에 저장하는 로직이 필요합니다.
    // 여기서는 간단히 세션에 저장하는 예시를 보여줍니다.
    $_SESSION['username'] = $username;

    header('Location: index.php'); // 회원가입 후 홈페이지로 이동
    exit();
}

// 로그인 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 실제로는 데이터베이스에서 사용자 정보를 확인하는 로직이 필요합니다.
    // 여기서는 간단히 세션에 저장하는 예시를 보여줍니다.
    $_SESSION['username'] = $username;

    header('Location: index.php'); // 로그인 후 홈페이지로 이동
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Text Links with Background</title>
</head>
<body>

<div class="container">
    <div class="left-link">
        <a href="#YOU AND I" style="font-weight: bold; text-decoration: none; color:white; font-size: 0.7em; font-weight: bold; padding: 40px;">YOU AND I</a>
    </div>

    <div class="right-links">
        <a href="#LOGIN" style="text-decoration: none; color: rgb(89, 89, 232); font-size: 1.3em; margin-right: 50px;">LOGIN</a>
        <a href="#MYHOME" style="text-decoration: none; color: rgb(89, 89, 232); font-size: 1.3em; margin-right: 50px;">MYHOME</a>
    </div>
</div>

<div class="container2">
    <div class="main-text">
        "일상의 작은 순간들, 랜덤으로 만나는 아름다움."
        <div class="subtitle-text">
            일상의 아름다움
        </div>
    </div>
    <img src="your-image-path.jpg" alt="Main Image" width="300">
    <div class="main-title">
        MYHOME
    </div>
        <h2>게시글</h2>
		<?php
		// 데이터베이스 연결 설정 (데이터베이스 호스트, 사용자이름, 비밀번호, 연결할 dB 이름)
		$conn = mysqli_connect("localhost", "hanuser", "1234", "handb");

		// 연결 여부 확인
		if (!$conn) {
		    die("데이터베이스 연결 실패: " . mysqli_connect_error());
		}

		// 실행할 SQL 쿼리문, table에서 모든 열 선택
		$sql = "SELECT * FROM hantable";
		$result = mysqli_query($conn, $sql);

		// 쿼리 결과 확인
		if (!$result) {
		    die("쿼리 실행 실패: " . mysqli_error($conn));
		}

		// 결과 출력
		echo "<h2>hantable 테이블 정보</h2>";
		echo "<table border='1'>";
		echo "<tr><th>ID</th><th>Description</th></tr>";

		// 결과 집합에서 각 행을 배열로 가져와 출력
		while ($row = mysqli_fetch_assoc($result)) {
		    echo "<tr><td>{$row['id']}</td><td>{$row['description']}</td></tr>";
		}

		echo "</table>";

		// 연결 종료
		mysqli_close($conn);
		?>

    </div>

    <!-- 회원가입 폼 추가 -->
    <form class="signup-form" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm-password">Confirm Password:</label>
        <input type="password" id="confirm-password" name="confirm-password" required>

        <button type="submit" name="signup">Sign Up</button>
    </form>

    <!-- 로그인 폼 추가 -->
    <form class="login-form" method="post">
        <label for="login-username">Username:</label>
        <input type="text" id="login-username" name="username" required>

        <label for="login-password">Password:</label>
        <input type="password" id="login-password" name="password" required>

        <button type="submit" name="login">Log In</button>
    </form>
</div>
</body>
</html>
