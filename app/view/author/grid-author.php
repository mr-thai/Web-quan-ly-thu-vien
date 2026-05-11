<?php
$authors = $authors ?? false;
?>

<div class="tg-authorsgrid">
    <div class="container">
        <div class="row">
            <div class="tg-authors">    
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php if (is_object($authors)): while($row = $authors->fetch_assoc()): 
                    $anh_tac_gia = !empty($row['avatar_url']) ? ltrim($row['avatar_url'], '/') : 'images/author/imag-24.jpg';
                    $authorLink = 'authordetail.php?id=' . intval($row['ma_tac_gia']);
                    $tenTacGia = $row['but_danh'] ? $row['but_danh'] : $row['ho_ten'];
                ?>  

                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                    <div class="tg-author">
                        <figure><a href="<?php echo $authorLink; ?>"><img src="<?php echo htmlspecialchars($anh_tac_gia); ?>" alt="image description" ></a></figure>
                        <div class="tg-authorcontent">
                            <h2><a href="<?php echo $authorLink; ?>"><?php echo htmlspecialchars($tenTacGia); ?></a></h2>
                            <span><?php echo intval($row['so_sach']); ?> Tổng sách</span>
                            <ul class="tg-socialicons">
                                <li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                                <li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                                <li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
</div>
