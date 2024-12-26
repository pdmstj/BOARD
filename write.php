<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글 작성 폼</title>
    <style>
        body {
            background-color: #eaf6ff; /* 파스텔톤 하늘색 배경 */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            width: 900px;
            position: relative;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #b3d9ff; /* 테두리 하늘색 */
        }
        .form-container input[type="text"],
        .form-container input[type="password"],
        .form-container select,
        .form-container textarea,
        .form-container input[type="file"] {
            width: 70%;
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #b3d9ff; /* 입력 필드 테두리 하늘색 */
            background-color: #f5fbff; /* 입력 필드 연한 하늘색 배경 */
        }
        .form-container input#name,
        .form-container input#title,
        .form-container input#password {
            width: 40%;
            border-radius: 15px;
        }
        .form-container select#grade {
            width: auto;
            padding: 8px;
            border-radius: 15px;
            border: 1px solid #b3d9ff;
            background-color: #f5fbff;
        }
        .form-container textarea {
            width: 70%;
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #b3d9ff;
            background-color: #f5fbff;
        }
        .form-container input[type="radio"] {
            margin-right: 10px;
        }
        .form-container label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #4a90e2; /* 라벨 하늘색 */
        }
        .form-container .buttons {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
            gap: 10px;
        }
        .form-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            color: white;
            transition: background-color 0.3s;
        }
        .form-container button[type="submit"] {
            background-color: #4a90e2; /* 작성완료 버튼 하늘색 */
        }
        .form-container button[type="submit"]:hover {
            background-color: #357ab8; /* 작성완료 버튼 hover 하늘색 */
        }
        .form-container button[type="reset"] {
            background-color: #4a90e2; /* 다시입력 버튼 부드러운 빨간색 */
        }
        .form-container button[type="reset"]:hover {
            background-color: #357ab8; /* 다시입력 버튼 hover 빨간색 */
        }
        .inline-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 20px;
        }
        .inline-buttons button {
            padding: 8px 16px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .inline-buttons button:hover {
            background-color: #357ab8;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="inline-buttons">
            <button onclick="location.href='login.php'">로그인</button>
            <button onclick="location.href='signup.php'">회원가입</button>
        </div>
        <form action="write_process.php" method="post" enctype="multipart/form-data">
            <label for="name">이름</label>
            <input type="text" id="name" name="name" required>

            <label for="title">제목</label>
            <input type="text" id="title" name="title" required>

            <label for="grade">학년</label>
            <select id="grade" name="grade">
                <option value="1">1학년</option>
                <option value="2">2학년</option>
                <option value="3">3학년</option>
            </select>

            <label>휴대폰</label>
            <div style="margin-bottom: 20px;">
                <input type="radio" name="phone" value="SKT" required> SKT
                <input type="radio" name="phone" value="KTF"> KTF
                <input type="radio" name="phone" value="LGU+"> LGU+
            </div>

            <label for="content">내용</label>
            <textarea id="content" name="content" rows="5" required></textarea>

            <label for="password">비밀번호</label>
            <input type="password" id="password" name="password" required>

            <label for="file">파일첨부</label>
            <input type="file" id="file" name="file" class="file-input">

            <div class="buttons">
                <button type="submit">작성완료</button>
                <button type="reset">다시입력</button>
            </div>
        </form>
    </div>
</body>
</html>
