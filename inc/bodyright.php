<div id="bodyRight">
        <?php if(!isset($_GET['cat_id'])){?>
        <div class="slider">
            <div class="mainslider">
                <div class="list">
                    <div class="item">
                        <img src="./img/slider/banner-phoi-tranh-va-khung-tu-do.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="./img/slider/onepiece1bg.png" alt="">
                    </div>
                </div>
                <div class="buttons">
                    <button id="prev"><</button>
                    <button id="next">></button>
                </div>
                <ul class="dots">
                    <li class="active"></li>
                    <li></li>
                </ul>
            </div>
            <div class="subslider">
                <div class="adsbanner">
                    <img src="./img/slider/opsubslider.png">
                </div>
                <div class="adsbanner">
                    <img src="./img/slider/Now!.png">
                </div>
            </div>
        </div>
        <!-- <div id="slider">
            <img src="./img/slider/bg.jpg" alt="" width="300">
        </div> -->
        <ul>
        <?php displayAllCategories(); ?>
        </ul><br clear = 'All'>
        <?php } ?>
    </div><!--End of body left-->
