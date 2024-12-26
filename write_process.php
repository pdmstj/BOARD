<?php
include 'db.php'; // 데이터베이스 연결 파일

$title = $_POST['title'] ?? '';
$author = $_POST['name'] ?? '';
$content = $_POST['content'] ?? '';

// 데이터베이스에 저장 (Prepared Statement 사용)
$stmt = $conn->prepare("INSERT INTO posts (title, author, content) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $title, $author, $content);

if ($stmt->execute()) {
    header("Location: list.php"); // 글 목록 페이지로 이동
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
