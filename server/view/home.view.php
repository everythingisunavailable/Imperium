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
    HTML;
}