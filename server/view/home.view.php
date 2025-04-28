<?php
function display_home(){    
    echo <<<HTML
        <div class="hero">
            <div class="left">
                <div class="cto">
                    <h1>Create your Empire or smth</h1>
                    <p>this is some description of what i said earlier</p>
                    <button class="cto-button">BUY NOW</button>
                </div>
            </div>

            <div class="right" id="hero-right">
                <div class="carousel-wrapper">
                    <div class="carousel">

                        <div class="carousel-item">
                            <img src="assets/pictures/pc-item.png" alt="prebuild pc" onclick="pop_into_view(0)">
                        </div>
                        <div class="carousel-item">
                            <img src="assets/pictures/pc-item.png" alt="prebuild pc" onclick="pop_into_view(1)">
                        </div>
                        <div class="carousel-item">
                            <img src="assets/pictures/pc-item.png" alt="prebuild pc" onclick="pop_into_view(2)">
                        </div>
                        <div class="carousel-item">
                            <img src="assets/pictures/pc-item.png" alt="prebuild pc" onclick="pop_into_view(3)">
                        </div>
                        <div class="carousel-item">
                            <img src="assets/pictures/pc-item.png" alt="prebuild pc" onclick="pop_into_view(4)">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    HTML;
}