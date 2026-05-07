<?php
$sach_noi_bat = $sach_noi_bat ?? false;
$row = $row ?? [];
$bookImage = !empty($row['url_anh']) ? ltrim($row['url_anh'], '/') : 'images/products/img-01.jpg';
?>  
    <section class="tg-bglight tg-haslayout">
        <div class="container">
            <div class="row">
                <div class="tg-featureditm">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="tg-featureditmcontent">
                            <div class="tg-themetagbox"><span class="tg-themetag"><?= htmlspecialchars($row['ten_the_loai']) ?></span></div>
                            <div class="tg-booktitle"><h3><a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>"><?= htmlspecialchars($row['ten_sach']) ?></a></h3></div>
                            <span class="tg-bookwriter">Bởi: <a href="productdetail.php?id=<?= intval($row['ma_sach']) ?>"><?= htmlspecialchars($row['ten_tac_gia']) ?></a></span>
                            <span class="tg-stars"><span></span></span>
                            <div class="tg-priceandbtn">
                                <a class="tg-btn tg-btnstyletwo tg-active" href="app/controller/control_muon_sach.php?action=add&id=<?php echo $row['ma_sach']; ?>"><i class="fa fa-book"></i><em>Mượn sách</em></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>