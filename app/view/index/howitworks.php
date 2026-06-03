<?php
/* ===== SECTION: QUY TRÌNH MƯỢN SÁCH (HOW IT WORKS) START ===== */
?>
<section class="ml-howitworks-section tg-sectionspace tg-haslayout" style="background: linear-gradient(to bottom, #ffffff, var(--background));">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-sectionhead text-center" style="margin-bottom: 48px;">
                    <h2 style="font-size: 32px; font-weight: 800; color: var(--text-main); margin-bottom: 12px;">Quy Trình Mượn Sách</h2>
                    <p style="color: var(--text-muted); font-size: 16px; max-width: 600px; margin: 0 auto;">Chỉ với 3 bước đơn giản, bạn có thể dễ dàng tìm kiếm và mượn những cuốn sách yêu thích từ hệ thống thư viện Manlib.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="ml-step-card">
                    <div class="ml-step-icon">
                        <i class="fa fa-search"></i>
                        <span class="ml-step-number">01</span>
                    </div>
                    <div class="ml-step-content">
                        <h3>Tìm kiếm Sách</h3>
                        <p>Sử dụng thanh công cụ để tìm kiếm sách theo tên, tác giả hoặc thể loại mà bạn mong muốn.</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="ml-step-card">
                    <div class="ml-step-icon">
                        <i class="fa fa-shopping-basket"></i>
                        <span class="ml-step-number">02</span>
                    </div>
                    <div class="ml-step-content">
                        <h3>Thêm vào Giỏ</h3>
                        <p>Chọn mượn và thêm các cuốn sách vào giỏ mượn. Kiểm tra lại danh sách trước khi xác nhận.</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="ml-step-card">
                    <div class="ml-step-icon">
                        <i class="fa fa-check-circle-o"></i>
                        <span class="ml-step-number">03</span>
                    </div>
                    <div class="ml-step-content">
                        <h3>Nhận Sách</h3>
                        <p>Đến thư viện để nhận sách trực tiếp. Thời hạn mượn sách sẽ được tính từ lúc bạn hoàn tất thủ tục.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* ===== CSS CHO HOW IT WORKS ===== */
.ml-howitworks-section .tg-sectionhead {
    position: relative;
    padding-bottom: 20px;
}
.ml-howitworks-section .tg-sectionhead::after {
    content: '';
    position: absolute;
    bottom: 0; left: 50%;
    transform: translateX(-50%);
    width: 60px; height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--gold));
    border-radius: var(--radius-full);
}

.ml-step-card {
    background: #fff;
    border-radius: var(--radius-lg);
    padding: 40px 24px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0,0,0,0.04);
    border: 1px solid var(--border-light);
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
    overflow: hidden;
    z-index: 1;
}
.ml-step-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(135deg, rgba(92,138,110,0.05) 0%, rgba(212,175,55,0.05) 100%);
    z-index: -1;
    opacity: 0;
    transition: opacity 0.4s ease;
}
.ml-step-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(139,94,60,0.1);
    border-color: var(--primary-light);
}
.ml-step-card:hover::before {
    opacity: 1;
}

.ml-step-icon {
    width: 80px;
    height: 80px;
    background: var(--surface-warm);
    border-radius: 50%;
    margin: 0 auto 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    color: var(--primary);
    position: relative;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.ml-step-card:hover .ml-step-icon {
    transform: scale(1.1) rotate(5deg);
    background: var(--primary);
    color: #fff;
}

.ml-step-number {
    position: absolute;
    top: -5px; right: -5px;
    width: 28px; height: 28px;
    background: var(--gold);
    color: #fff;
    font-size: 13px;
    font-weight: 800;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.ml-step-content h3 {
    font-size: 20px;
    font-weight: 700;
    color: var(--text-main);
    margin-bottom: 12px;
}
.ml-step-content p {
    font-size: 14px;
    color: var(--text-muted);
    line-height: 1.6;
    margin: 0;
}

/* Thêm đường viền đứt quãng nối giữa các bước trên Desktop */
@media (min-width: 768px) {
    .ml-howitworks-section .col-sm-4 { position: relative; }
    .ml-howitworks-section .col-sm-4:not(:last-child)::after {
        content: '\f178';
        font-family: 'FontAwesome';
        position: absolute;
        top: 80px; right: -15px;
        color: var(--border-color);
        font-size: 24px;
        z-index: 2;
        transition: color 0.3s ease;
    }
    .ml-howitworks-section .col-sm-4:hover::after {
        color: var(--primary);
    }
}
</style>
<?php /* ===== SECTION: QUY TRÌNH MƯỢN SÁCH END ===== */ ?>
