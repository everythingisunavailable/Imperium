<?php
function display_home(){    
    echo <<<HTML
        <div class="hero">
            <div class="left">
                <div class="cto">
                    <h1>Conquer Your Next Build</h1>
                    <h3>High-performance parts. Unmatched reliability. Built for victory.</h3>
                    <button class="cto-button">BUY NOW</button>
                </div>
            </div>

            <div class="right" id="hero-right" >
                <div class="carousel-wrapper">
                    <div class="carousel">

                        <button class="carousel-item-wrapper pc_btn" disabled onclick="btn_pop_into_view(this, 0)">
                            <div class="carousel-item first-selected">
                                <img src="assets/pictures/pc-item.png" alt="prebuild pc">
                            </div>
                        </button>                    
                        <button class="carousel-item-wrapper pc_btn" onclick="btn_pop_into_view(this, 1)">
                            <div class="carousel-item">
                                <img src="assets/pictures/pc-item.png" alt="prebuild pc">
                            </div>
                        </button>                        
                        <button class="carousel-item-wrapper pc_btn" onclick="btn_pop_into_view(this, 2)">
                            <div class="carousel-item">
                                <img src="assets/pictures/pc-item.png" alt="prebuild pc">
                            </div>
                        </button>                        
                        <button class="carousel-item-wrapper pc_btn" onclick="btn_pop_into_view(this, 3)">
                            <div class="carousel-item">
                                <img src="assets/pictures/pc-item.png" alt="prebuild pc">
                            </div>
                        </button>                        
                        <button class="carousel-item-wrapper pc_btn" onclick="btn_pop_into_view(this, 4)">
                            <div class="carousel-item">
                                <img src="assets/pictures/pc-item.png" alt="prebuild pc">
                            </div>
                        </button>                        

                    </div>
                </div>
            </div>
        </div>

        
        <div class="categories">
            <h2>Explore Categories</h2>
            <div class="category-wrapper">

                <div class="category-item">
                    <div class="background" style="background-image: url(assets/pictures/pc-background.png);"></div>
                    <div class="foreground">
                        <span class="upper-bold">PREBUILDS</span>
                    </div>
                </div>
                <div class="category-item">
                    <div class="background" style="background-image: url(assets/pictures/components-background.png);"></div>
                    <div class="foreground">
                        <span class="upper-bold">COMPONENTS</span>
                    </div>
                </div>
                <div class="category-item">
                    <div class="background" style="background-image: url(assets/pictures/peripherals-background.png);"></div>
                    <div class="foreground">
                        <span class="upper-bold">PERIPHERALS</span>
                    </div>
                </div>
                <div class="category-item">
                    <div class="background" style="background-image: url(assets/pictures/deals-background.png);"></div>
                    <div class="foreground">
                        <span class="upper-bold">DEALS</span>
                    </div>
                </div>

            </div>
        </div>


        
        <h2>BEST SELLING PRODUCTS</h2>
        <div class="carousel-wrapper-basic">
            <div class="carousel" id="first-carousel">
                
                <div class="carousel-item">
                    <h3>CARBON X1 BUNDLE</h3>
                    <img src="assets/pictures/computer-bundle-transparent.png" alt="pc">
                </div>
                <div class="carousel-item">
                    <h3>CARBON X1 BUNDLE</h3>
                    <img src="assets/pictures/computer-bundle-transparent.png" alt="pc">
                </div>
                <div class="carousel-item">
                    <h3>CARBON X1 BUNDLE</h3>
                    <img src="assets/pictures/computer-bundle-transparent.png" alt="pc">
                </div>
                <div class="carousel-item">
                    <h3>CARBON X1 BUNDLE</h3>
                    <img src="assets/pictures/computer-bundle-transparent.png" alt="pc">
                </div>
                <div class="carousel-item">
                    <h3>CARBON X1 BUNDLE</h3>
                    <img src="assets/pictures/computer-bundle-transparent.png" alt="pc">
                </div>

            </div>
            <button class="left button-link" onclick="carousel_one('right',0)"><img src="assets/icons/left-2-svgrepo-com.svg" width="30px" alt="left"></button>
            <button class="right button-link" onclick="carousel_one('left',0)"><img src="assets/icons/right-2-svgrepo-com.svg" width="30px" alt="right"></button>
            <div class="carousel-button-group">
                <ul id="first-carousel-buttons">
                    <li><button onclick="carousel_one('move_to',0)" class="expand-button"><div class="fill-button"></div></button></li>
                    <li><button onclick="carousel_one('move_to',1)"><div class="fill-button"></div></button></li>
                    <li><button onclick="carousel_one('move_to',2)"><div class="fill-button"></div></button></li>
                    <li><button onclick="carousel_one('move_to',3)"><div class="fill-button"></div></button></li>
                    <li><button onclick="carousel_one('move_to',4)"><div class="fill-button"></div></button></li>
                </ul>
            </div>
        </div>
    HTML;
}