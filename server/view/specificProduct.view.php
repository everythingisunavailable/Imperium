<?php 
function display_specific_product(){
    echo <<<HTML
        <div class="main-section">
            <div class="carousel-wrapper-basic product-picture-carousel displace-hide animate-in">
                <div class="carousel" id="second-carousel">   
                    <div class="carousel-item">
                        <img src="assets/pictures/computer-bundle-transparent.png" alt="pc">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/pictures/computer-bundle-transparent.png" alt="pc">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/pictures/computer-bundle-transparent.png" alt="pc">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/pictures/computer-bundle-transparent.png" alt="pc">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/pictures/computer-bundle-transparent.png" alt="pc">
                    </div>

                </div>
                <button class="left button-link" onclick="carousel_two('right',0)"><img src="assets/icons/left-2-svgrepo-com.svg" width="30px" alt="left"></button>
                <button class="right button-link" onclick="carousel_two('left',0)"><img src="assets/icons/right-2-svgrepo-com.svg" width="30px" alt="right"></button>
                <div class="carousel-button-group">
                    <ul id="second-carousel-buttons">
                        <li><button onclick="carousel_two('move_to',0)" class="expand-button"><div class="fill-button"></div></button></li>
                        <li><button onclick="carousel_two('move_to',1)"><div class="fill-button"></div></button></li>
                        <li><button onclick="carousel_two('move_to',2)"><div class="fill-button"></div></button></li>
                        <li><button onclick="carousel_two('move_to',3)"><div class="fill-button"></div></button></li>
                        <li><button onclick="carousel_two('move_to',4)"><div class="fill-button"></div></button></li>
                    </ul>
                </div>
            </div>
            <div class="description displace-hide animate-in">
                <h2>The best pc ever produced</h2>
                <div class="price-section">
                    <div class="price"> <span class="number"> 49 900</span> <span class="currency">ALL</span></div>
                    <div class="original-price"><span class="number">59 900</span><span class="currency"> ALL</span></div>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis erat erat, ultricies vel velit ac, suscipit aliquet lorem. In sollicitudin odio eu pulvinar volutpat. Aliquam a eros velit. Quisque ut magna viverra, blandit mauris commodo, pulvinar ante. Nullam tempor quis lorem eu consequat. Curabitur ipsum tortor, vestibulum et lacus in, sodales malesuada tortor. Sed sit amet leo sed lectus interdum iaculis eu in dolor.</p>
                <button class="cto-button displace-hide animate-in">BUY NOW</button>
            </div>
        </div>
HTML;
}
