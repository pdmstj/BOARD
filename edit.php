<?php
include 'db.php';

// 게시글 ID 가져오기
$id = intval($_GET['edit_id']);

// 기존 게시글 가져오기
$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "글을 찾을 수 없습니다.";
    exit;
}

// 수정 폼 제출 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];

    $updateSql = "UPDATE posts SET title = ?, author = ?, content = ? WHERE id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("sssi", $title, $author, $content, $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('글이 성공적으로 수정되었습니다.');
                window.location.href = 'view.php?id=$id';
              </script>";
    } else {
        echo "<script>alert('글 수정에 실패했습니다. 다시 시도해주세요.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글 수정</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 50%;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        textarea {
            resize: vertical;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-cancel {
            background-color: #dc3545;
        }
        .btn-cancel:hover {
            background-color: #b02a37;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>글 수정</h1>
        <form method="POST" action="">
            <label for="title">제목</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>

            <label for="author">작성자</label>
            <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($row['author']); ?>" required>

            <label for="content">내용</label>
            <textarea id="content" name="content" rows="10" required><?php echo htmlspecialchars($row['content']); ?></textarea>

            <div class="buttons">
                <button type="submit" class="btn">수정 완료</button>
                <a href="view.php?id=<?php echo $id; ?>" class="btn btn-cancel">취소</a>
            </div>
        </form>
    </div>
</body>
</html>
