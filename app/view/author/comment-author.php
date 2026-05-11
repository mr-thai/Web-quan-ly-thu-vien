<section class="tg-parallax tg-bgtestimonials tg-haslayout" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-05.jpg">
    <div class="tg-sectionspace tg-haslayout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-push-2">
                    <div id="tg-testimonialsslider" class="tg-testimonialsslider tg-testimonials owl-carousel">
                        <?php require_once 'app/config.php';
                        require_once 'app/model/model_author.php';
                        $highlightAuthors = getDanhSachTacGia($conn);
                        ?>
                        <?php if ($highlightAuthors && $highlightAuthors->num_rows > 0): ?>
                            <?php $index = 0; while ($author = $highlightAuthors->fetch_assoc()): if ($index >= 3) break; ?>
                                <?php $authorImage = !empty($author['avatar_url']) ? ltrim($author['avatar_url'], '/') : 'images/author/imag-' . str_pad(((($index + 1) % 26) + 1), 2, '0', STR_PAD_LEFT) . '.jpg'; ?>
                                <div class="item tg-testimonial">
                                    <figure class="mb-5"><img src="<?php echo htmlspecialchars($authorImage); ?>" alt="image description" ></figure>
                                    <blockquote><q><?php echo htmlspecialchars(!empty($author['tieu_su']) ? $author['tieu_su'] : $author['ghi_chu']); ?></q></blockquote>
                                    <div class="tg-testimonialauthor">
                                        <h3><?php echo htmlspecialchars(!empty($author['but_danh']) ? $author['but_danh'] : $author['ho_ten']); ?></h3>
                                        <span><?php echo htmlspecialchars(!empty($author['quoc_tich']) ? $author['quoc_tich'] : ('Tổng sách: ' . $author['so_sach'])); ?></span>
                                    </div>
                                </div>
                            <?php $index++; endwhile; ?>
                        <?php else: ?>
                            <div class="item tg-testimonial">
                                <figure><img src="images/author/imag-02.jpg" alt="image description"></figure>
                                <blockquote><q>chưa có dữ liệu</q></blockquote>
                                <div class="tg-testimonialauthor">
                                    <h3>QLTV</h3>
                                    <span>Hệ thống thư viện</span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>