<?php

function searchBooks($conn, $keyword, $limit = 20)
{
	$keyword = trim((string)$keyword);
	$limit = max(1, (int)$limit);

	if ($keyword === '') {
		return false;
	}

	$sql = "SELECT s.ma_sach, s.ten_sach, s.isbn, s.mo_ta, s.ten_the_loai, s.nam_xuat_ban, s.so_trang, s.gia_sach,
				   tg.ma_tac_gia, tg.ho_ten AS ten_tac_gia, tg.but_danh, a.url_anh
			FROM sach s
			JOIN tac_gia tg ON s.ma_tacgia = tg.ma_tac_gia
			LEFT JOIN anh_sach a ON s.ma_sach = a.ma_sach AND a.anh_chinh = 1
			WHERE s.ten_sach LIKE ?
			   OR s.isbn LIKE ?
			   OR s.mo_ta LIKE ?
			   OR tg.ho_ten LIKE ?
			   OR tg.but_danh LIKE ?
			GROUP BY s.ma_sach
			ORDER BY s.ten_sach ASC
			LIMIT ?";

	if ($stmt = $conn->prepare($sql)) {
		$like = '%' . $keyword . '%';
		$stmt->bind_param('sssssi', $like, $like, $like, $like, $like, $limit);
		$stmt->execute();
		$result = $stmt->get_result();
		$rows = [];

		while ($row = $result->fetch_assoc()) {
			$row['result_type'] = 'book';
			$row['detail_url'] = 'productdetail.php?id=' . (int)$row['ma_sach'];
			$rows[] = $row;
		}

		$stmt->close();
		return $rows;
	}

	return false;
}

function searchAuthors($conn, $keyword, $limit = 20)
{
	$keyword = trim((string)$keyword);
	$limit = max(1, (int)$limit);

	if ($keyword === '') {
		return false;
	}

	$sql = "SELECT tg.ma_tac_gia, tg.ho_ten, tg.but_danh, tg.ngay_sinh, tg.ngay_mat, tg.quoc_tich, tg.avatar_url,
				   tg.tieu_su, tg.ghi_chu, COUNT(s.ma_sach) AS so_sach
			FROM tac_gia tg
			LEFT JOIN sach s ON tg.ma_tac_gia = s.ma_tacgia
			WHERE tg.ho_ten LIKE ?
			   OR tg.but_danh LIKE ?
			   OR tg.quoc_tich LIKE ?
			   OR tg.tieu_su LIKE ?
			   OR tg.ghi_chu LIKE ?
			GROUP BY tg.ma_tac_gia
			ORDER BY so_sach DESC, tg.ho_ten ASC
			LIMIT ?";

	if ($stmt = $conn->prepare($sql)) {
		$like = '%' . $keyword . '%';
		$stmt->bind_param('sssssi', $like, $like, $like, $like, $like, $limit);
		$stmt->execute();
		$result = $stmt->get_result();
		$rows = [];

		while ($row = $result->fetch_assoc()) {
			$row['result_type'] = 'author';
			$row['detail_url'] = 'authordetail.php?id=' . (int)$row['ma_tac_gia'];
			$rows[] = $row;
		}

		$stmt->close();
		return $rows;
	}

	return false;
}

function searchAll($conn, $keyword, $limitEach = 10)
{
	$books = searchBooks($conn, $keyword, $limitEach);
	$authors = searchAuthors($conn, $keyword, $limitEach);

	return [
		'books' => is_array($books) ? $books : [],
		'authors' => is_array($authors) ? $authors : [],
	];
}

function getSearchResultByType($conn, $keyword)
{
	return searchAll($conn, $keyword, 12);
}

