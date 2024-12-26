<?php
include 'db.php'; // 데이터베이스 연결 파일
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 목록</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaf6ff; /* 파스텔 하늘색 배경 */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 80%;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border: 1px solid #b3d9ff; /* 하늘색 테두리 */
        }
        .top-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
        .write-button {
            padding: 8px 16px;
            background-color: #4a90e2; /* 버튼 하늘색 */
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .write-button:hover {
            background-color: #357ab8; /* 버튼 hover 색상 */
        }
        h1 {
            text-align: center;
            color: #4a90e2; /* 제목 색상 */
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f5fbff; /* 연한 하늘색 배경 */
        }
        th, td {
            border: 1px solid #b3d9ff; /* 테이블 테두리 하늘색 */
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #d9f0ff; /* 헤더 연한 하늘색 */
            color: #4a90e2; /* 헤더 텍스트 색상 */
        }
        td {
            background-color: #ffffff; /* 테이블 데이터 배경 */
            color: #333; /* 텍스트 색상 */
        }
        a {
            text-decoration: none;
            color: #4a90e2; /* 링크 색상 */
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <a href="write.php" class="write-button">글 작성하기</a>
        </div>
        <h1>게시글 리스트</h1>
        <table>
            <thead>
                <tr>
                    <th>글번호</th>
                    <th>글제목</th>
                    <th>작성자</th>
                    <th>작성일</th>
                    <th>조회</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // 데이터베이스에서 게시글 가져오기
                $sql = "SELECT id, title, author, created_at, views FROM posts ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td><a href='view.php?id=" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['title']) . "</a></td>";
                        echo "<td>" . htmlspecialchars($row['author']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['views']) . "</td>"; // 조회수 표시
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>게시글이 없습니다.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
