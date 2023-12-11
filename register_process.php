<?php
include ('index_DB.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "회원가입이 완료되었습니다.";

        // 메인 페이지로 리다이렉션
        header("Location: index.php");
        exit();
    } else {
        echo "오류: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
