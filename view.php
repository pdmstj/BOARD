<?php
include 'db.php';

// 게시글 ID 가져오기
$id = intval($_GET['id']);

// 조회수 증가 쿼리
$updateViewsSql = "UPDATE posts SET views = views + 1 WHERE id = ?";
$stmt = $conn->prepare($updateViewsSql);
$stmt->bind_param("i", $id);
$stmt->execute();

// 게시글 가져오기 쿼리
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
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 상세보기</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #eaf6ff; /* 파스텔 하늘색 배경 */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* height 대신 min-height로 수정 */
            margin: 0;
        }
        .container {
            width: 60%;
            max-width: 800px; /* 최대 너비 설정 */
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #b3d9ff; /* 하늘색 테두리 */
        }
        h1 {
            text-align: center;
            color: #4a90e2; /* 짙은 하늘색 */
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px; /* 패딩 줄이기 */
            border: 1px solid #b3d9ff;
            text-align: left;
            font-size: 14px; /* 폰트 크기 줄이기 */
        }
        th {
            width: 20%;
            background-color: #d9f0ff; /* 연한 하늘색 */
            color: #4a90e2; /* 짙은 하늘색 텍스트 */
        }
        td {
            background-color: #f5fbff; /* 아주 연한 하늘색 */
        }
        .buttons {
            display: flex;
            justify-content: flex-end; /* 오른쪽 정렬 */
            gap: 5px; /* 간격 줄이기 */
            flex-wrap: wrap; /* 작은 화면에서 줄바꿈 허용 */
        }
        .btn {
            padding: 6px 12px; /* 버튼 크기 줄이기 */
            background-color: #4a90e2; /* 버튼 색상 */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            font-size: 12px; /* 폰트 크기 줄이기 */
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #357ab8; /* 버튼 hover 색상 */
        }
        .btn-delete {
            background-color: #f56262; /* 삭제 버튼 색상 변경 */
        }
        .btn-delete:hover {
            background-color: #d14545;
        }
        @media (max-width: 600px) {
            .container {
                width: 90%;
            }
            .btn {
                flex: 1 1 auto; /* 버튼 크기 자동 조절 */
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>게시글 상세보기</h1>
        <table>
            <tr>
                <th>제목</th>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
            </tr>
            <tr>
                <th>작성자</th>
                <td><?php echo htmlspecialchars($row['author']); ?></td>
            </tr>
            <tr>
                <th>작성시간</th>
                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
            </tr>
            <tr>
                <th>조회수</th>
                <td><?php echo htmlspecialchars($row['views']); ?></td>
            </tr>
            <tr>
                <th>내용</th>
                <td><?php echo nl2br(htmlspecialchars($row['content'])); ?></td>
            </tr>
        </table>
        <div class="buttons">
            <a href="write.php" class="btn">새글 작성</a>
            <a href="edit.php?edit_id=<?php echo $row['id']; ?>" class="btn">글 수정</a>
            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-delete" onclick="return confirm('정말 삭제하시겠습니까?')">글 삭제</a>
            <a href="list.php" class="btn">목록으로</a>
        </div>
    </div>
</body>
</html>
