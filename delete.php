<?php
include 'db.php'; // 데이터베이스 연결

// URL에서 게시글 ID 가져오기
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // ID를 정수형으로 변환하여 SQL 인젝션 방지

    // 삭제 확인
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id); // SQL에 ID 매핑
        if ($stmt->execute()) {
            // 삭제 성공 시 목록 페이지로 리다이렉트
            echo "<script>
                    alert('게시글이 성공적으로 삭제되었습니다.');
                    window.location.href = 'list.php';
                  </script>";
        } else {
            // 삭제 실패 시 오류 메시지 출력
            echo "<script>
                    alert('게시글 삭제에 실패했습니다.');
                    window.location.href = 'list.php';
                  </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
                alert('잘못된 요청입니다.');
                window.location.href = 'list.php';
              </script>";
    }
} else {
    echo "<script>
            alert('잘못된 요청입니다.');
            window.location.href = 'list.php';
          </script>";
}

$conn->close();
?>
