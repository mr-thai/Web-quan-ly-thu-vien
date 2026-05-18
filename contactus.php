<?php require_once 'app/config.php'; ?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Book Library</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/transitions.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body>

    <div id="tg-wrapper" class="tg-wrapper tg-haslayout">
      <!--************************************
          Header Start
      *************************************-->
      <?php include 'app/view/header.php'; ?>
      <!--************************************
          Header End
      *************************************-->
      <!--************************************
          Inner Banner Start
      *************************************-->
      <div class="tg-innerbanner tg-haslayout tg-parallax tg-bginnerbanner" data-z-index="-100" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-07.jpg">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="tg-innerbannercontent">
                <h1>Contact Us</h1>
                <ol class="tg-breadcrumb">
                  <li><a href="index.php">home</a></li>
                  <li class="tg-active">Contact Us</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--************************************
          Inner Banner End
      *************************************-->
      <!--************************************
          Main Start
      *************************************-->
      <main id="tg-main" class="tg-main tg-haslayout">
        <!--************************************
            Quick Feedback Section Start
        *************************************-->
        <div class="tg-sectionspace tg-haslayout" style="padding: 60px 0; background: #f9f9f9; border-bottom: 1px solid #e0e0e0;">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-sectionhead" style="text-align: center; margin-bottom: 50px;">
                  <h3 style="margin: 0; font-size: 32px; color: #333; font-weight: bold;">Góp ý</h3>
                  <p style="margin: 12px 0 0 0; color: #666; font-size: 16px;">Chia sẻ ý kiến của bạn với chúng tôi</p>
                </div>
              </div>
              <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                <form class="tg-formtheme" method="post" action="app/controller/contact_submit.php">
                  <fieldset>
                    <div class="form-group" style="margin-bottom: 20px;">
                      <input type="text" name="fullname" class="form-control" placeholder="Họ và tên" style="padding: 12px 15px; font-size: 15px;" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                      <input type="email" name="email" class="form-control" placeholder="Email" style="padding: 12px 15px; font-size: 15px;" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                      <textarea name="message" class="form-control" placeholder="Nội dung góp ý..." style="padding: 12px 15px; font-size: 15px; height: 120px; resize: vertical;"></textarea>
                    </div>
                    <div class="form-group" style="text-align: center;">
                      <button type="submit" class="tg-btn tg-active" style="padding: 12px 50px; font-size: 15px; font-weight: bold;">Gửi</button>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--************************************
            Quick Feedback Section End
        *************************************-->

        <!--************************************
            Detailed Contact Section Start
        *************************************-->
        <div class="tg-sectionspace tg-haslayout">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-sectionhead" style="text-align: center; margin-bottom: 60px;">
                  <h2 style="margin: 0; font-size: 36px; font-weight: bold;">Thông tin liên hệ</h2>
                  <p style="margin: 15px 0 0 0; color: #666; font-size: 16px;">Liên hệ trực tiếp với thư viện để được hỗ trợ</p>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- Contact Info Column -->
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div style="padding: 30px; background: #f5f5f5; border-radius: 8px; margin-bottom: 30px;">
                  <h4 style="margin: 0 0 15px 0; color: #333; font-size: 18px; font-weight: bold;"><i class="icon-apartment" style="margin-right: 12px; color: #77b748;"></i>Địa chỉ</h4>
                  <p style="margin: 0; color: #666; font-size: 15px; line-height: 1.7;">
                    Phòng Quản lý Thư viện<br>
                    Tầng 2, Tòa nhà A<br>
                    123 Đường Thư Viện<br>
                    Quận Hòa Bình, TP. Hồ Chí Minh
                  </p>
                </div>
              </div>

              <!-- Phone Column -->
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div style="padding: 30px; background: #f5f5f5; border-radius: 8px; margin-bottom: 30px;">
                  <h4 style="margin: 0 0 15px 0; color: #333; font-size: 18px; font-weight: bold;"><i class="icon-phone-handset" style="margin-right: 12px; color: #28a745;"></i>Liên lạc</h4>
                  <p style="margin: 0; color: #666; font-size: 15px; line-height: 2;">
                    <strong style="color: #333;">Hotline:</strong> <span style="color: #77b748; font-weight: bold;">(028) 1234 5678</span><br>
                    <strong style="color: #333;">Mobile:</strong> <span style="color: #77b748; font-weight: bold;">0909 123 456</span><br>
                    <strong style="color: #333;">Email:</strong> <a href="mailto:thuvien@domain.local" style="color: #77b748; text-decoration: none; font-weight: bold;">thuvien@domain.local</a>
                  </p>
                </div>
              </div>

              <!-- Hours Column -->
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div style="padding: 30px; background: #f5f5f5; border-radius: 8px; margin-bottom: 30px;">
                  <h4 style="margin: 0 0 15px 0; color: #333; font-size: 18px; font-weight: bold;"><i class="icon-clock" style="margin-right: 12px; color: #ffc107;"></i>Giờ làm việc</h4>
                  <p style="margin: 0; color: #666; font-size: 15px; line-height: 2;">
                    <strong style="color: #333;">Thứ 2 - Thứ 6:</strong><br>08:00 - 12:00 | 13:00 - 17:00<br>
                    <strong style="color: #333;">Thứ 7:</strong> 08:00 - 12:00<br>
                    <strong style="color: #333;">Chủ nhật:</strong> Đóng cửa
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--************************************
            Detailed Contact Section End
        *************************************-->
      </main>
      <!--************************************
          Main End
      *************************************-->
      <!--************************************
          Footer Start
      *************************************-->
      <?php include 'app/view/footer.php'; ?>
      <!--************************************
          Footer End
      *************************************-->
    </div>
    <!--************************************
        Wrapper End
    *************************************-->
    <script src="js/vendor/jquery-library.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.vide.min.js"></script>
    <script src="js/countdown.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/parallax.js"></script>
    <script src="js/countTo.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/gmap3.js"></script>
    <script src="js/main.js"></script>
  </body>

</html>
