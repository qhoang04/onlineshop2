
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="./css/contact.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


<!-- <link href="../css/contact.css" rel="stylesheet" type="text/css" /> -->

<div id="navbar">
    <div id="contactModal" class="modal contact-modal">
        <span class="closeBtn" onclick="closeModal('contactModal')">&times;</span>
        <div class="contact-content">
            <div class="contact-in">
                <div class="contact-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d806.3658615002611!2d108.25299479488652!3d15.97473567246747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2sVietnam%20-%20Korea%20University%20of%20Information%20and%20Communication%20Technology.!5e0!3m2!1sen!2s!4v1702188237166!5m2!1sen!2s" width="100%" height="auto" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <div class="contact-form">
                    <h1>Liên Hệ</h1>
                    <form action="inc/contact.php" method="post">
                        <input type="text" name="name" placeholder="Tên của bạn" class="contact-form-txt" />
                        <input type="text" name="email" placeholder="Email" class="contact-form-txt" />
                        <textarea name="message" placeholder="Nội dung" class="contact-form-textarea"></textarea>
                        <input type="submit" name="submit" value="Gửi" class="contact-form-btn" />
                    </form>
                </div>
            </div>
        </div>
    </div>

        <ul>
            <li>
                <a href="#">Danh mục sản phẩm</a>
                <ul>
                    <?php all_cat() ?>
                </ul>
            </li>
            <li>
                <a href="#">ý tưởng trang trí</a>
                <ul>
                    <li><a href="#">Góc làm việc</a></li>
                    <li><a href="#">Gaming</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Hướng dẫn mua hàng</a>
                <ul>
                </ul>
            </li>
            <!-- <li>
                <a href="#">Tuyển dụng</a>
                <ul>
                    <li><a href="#">Các vị trí</a></li>
                </ul>
            </li> -->
            <li>
                <a href="#" id="contactModalBtn">Liên hệ - Thông tin</a>
            </li>
            <!-- <li><a href="#">Offer Zone</a></li> -->
        </ul>
    </div>
    <script>
        document.getElementById('contactModalBtn').addEventListener('click', function(e) {
            e.preventDefault();
            openModal('contactModal');
        });

        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
        });

        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
            document.querySelector('.overlay').style.display = 'block';
            document.querySelector('.slider').classList.add('blurred');
            document.querySelector('.product_by_cate').classList.add('blurred');
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>