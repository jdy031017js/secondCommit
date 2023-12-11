<?php
include('index_DB.php');

// 세션을 시작합니다.
session_start();

// 로그인 상태를 확인합니다.
$loggedIn = isset($_SESSION['username']);

// 로그아웃 처리
if (isset($_GET['logout'])) {
    // 세션을 파기합니다.
    session_destroy();

    // 로그인 페이지로 리디렉션합니다.
    header("Location: login.php");
    exit();
}

// 게시글을 데이터베이스에 저장
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post'])) {
    $description = $_POST['description'];
    $username = $_SESSION['username'];

    // 현재 로그인한 사용자의 ID를 가져옴 (user_id)
    $userQuery = "SELECT id FROM users WHERE username = '$username'";
    $userResult = $conn->query($userQuery);

    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $userId = $userRow['id'];

        // 게시글을 데이터베이스에 삽입
        $insertQuery = "INSERT INTO posts (post_content, user_id) VALUES ('$description', '$userId')";
        $result = $conn->query($insertQuery);

        if ($result) {
            // 성공적으로 게시글을 저장한 경우 다시 로드
            header("Location: index.php");
            exit();
        } else {
            echo "게시글을 저장하는 동안 오류가 발생했습니다.";
        }
    }
}

// 게시글을 가져오는 쿼리
$postsQuery = "SELECT posts.id, posts.post_content, posts.post_date, users.username 
               FROM posts 
               INNER JOIN users ON posts.user_id = users.id 
               ORDER BY posts.post_date DESC";

$postsResult = $conn->query($postsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>You and I</title>
</head>
<body>

<div class="container">
    <div class="left-link">
        <a href="#YOU AND I" style="font-weight: bold; text-decoration: none; color:white; font-size: 0.7em; font-weight: bold; padding: 40px;">YOU AND I</a>
    </div>

    <div class="right-links">
        <?php if ($loggedIn): ?>
            <!-- 로그인 상태에서는 '로그인 하러가기'를 보이지 않게 합니다. -->
            <a href="#MYHOME" style="text-decoration: none; color: rgb(89, 89, 232); font-size: 1.3em; margin-right: 50px;">MYHOME</a>
            <!-- 로그아웃 링크 -->
            <a href="?logout=true" style="text-decoration: none; color: rgb(89, 89, 232); font-size: 1.3em; margin-right: 50px;">LOGOUT</a>
        <?php else: ?>
            <!-- 로그인 상태가 아닐 때는 '로그인 하러가기'를 보입니다. -->
            <a href="login.php" style="text-decoration: none; color: rgb(89, 89, 232); font-size: 1.3em; margin-right: 50px;">LOGIN</a>
        <?php endif; ?>
    </div>
</div>

<div class="container2">
    <div class="main-text">
        "일상의 작은 순간들, 랜덤으로 만나는 아름다움."
        <div class="subtitle-text">
            일상의 아름다움
        </div>
    </div>
    <img src="https://cdn.pixabay.com/photo/2015/06/19/21/24/avenue-815297_1280.jpg" alt="Main Image" width="300">
    <div class="main-title">
        MYHOME
    </div>
     
    <h2>게시글</h2>
    <!-- 게시글 작성 폼 -->
    <form class="post-form" method="post">
        <label for="post-description">게시글 작성:</label>
        <textarea id="post-description" name="description" required></textarea>
        <button type="submit" name="post">올리기</button>
    </form>

    <!-- 게시글 표시 -->
    <div class="post-list">
        <?php while ($post = $postsResult->fetch_assoc()): ?>
            <div class="post">
                <p><strong><?= $post['username'] ?></strong> - <?= $post['post_date'] ?></p>
                <p><?= $post['post_content'] ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>

