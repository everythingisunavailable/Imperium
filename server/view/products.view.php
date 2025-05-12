<?php

function display_products(){
echo <<<HTML
        <div class="main">
            <div class="filter-panel displace-hide animate-in">
                <h3>FILTER BY :</h3>
                <!--Same for evry category-->
                <fieldset class="price">
                    <legend>Price (ALL)</legend>
                    <label for="min">Min Price</label>
                    <div class="price-item">
                        <input type="number" id="min" value="0" onchange="update_value('number')">
                        <input type="range" id="min-range" value="0" onchange="update_value('range')">
                    </div>

                    <label for="max">Max Price</label>
                    <div class="price-item">
                        <input type="number" id="max" value="200000" onchange="update_value('number')">
                        <input type="range" id="max-range" value="100" onchange="update_value('range')">
                    </div>
                    <button class="filter-button">Filter</button>
                </fieldset>

                <!--Changes for different categories-->
                <fieldset>
                    <legend>Filter name</legend>
                    <label><input type="radio" name="filter-choice" id="option_1" value="1"> Option 1</label>
                    <label><input type="radio" name="filter-choice" id="option_2" value="2"> Option 2</label>
                    <label><input type="radio" name="filter-choice" id="option_3" value="3"> Option 3</label>
                    <label><input type="radio" name="filter-choice" id="option_4" value="4"> Option 4</label>
                </fieldset>
                
                <!--Changes for different categories-->
                <fieldset>
                    <legend>Filter name</legend>
                    <label><input type="radio" name="filter-choice-second" id="option_1" value="1"> Option 1</label>
                    <label><input type="radio" name="filter-choice-second" id="option_2" value="2"> Option 2</label>
                    <label><input type="radio" name="filter-choice-second" id="option_3" value="3"> Option 3</label>
                    <label><input type="radio" name="filter-choice-second" id="option_4" value="4"> Option 4</label>
                </fieldset>
            </div>

            <div class="content-panel">

                <div class="sorting-header displace-hide animate-in">
                    <div class="left">
                        <h3>SORT :</h3>
                    </div>
                    <div class="right">
                        <label for="sort">Sort by : </label>
                        <select name="sort" id="sort">
                            <option value="popularity">Popularity 🔥</option>
                            <option value="date">Date 📅</option>
                            <option value="price">Price 🏷️</option>
                            <option value="rating">Rating ⭐</option>
                        </select>
                        <label for="order">Order : </label>
                        <select name="order" id="order">
                            <option value="descending">Descending ▼</option>
                            <option value="ascending">Ascending ▲</option>
                        </select>
                    </div>
                </div>

                <div class="cards displace-hide animate-in">
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                    <div class="card-item"></div>
                </div>

                <div class="page-controls">
                    <div class="button-group">
                        <button class="circle-button">
                            <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14.9991 19L9.83911 14C9.56672 13.7429 9.34974 13.433 9.20142 13.0891C9.0531 12.7452 8.97656 12.3745 8.97656 12C8.97656 11.6255 9.0531 11.2548 9.20142 10.9109C9.34974 10.567 9.56672 10.2571 9.83911 10L14.9991 5" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </button>
                        <span id="page_nr">1</span>
                        <button class="circle-button">
                            <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 5L14.15 10C14.4237 10.2563 14.6419 10.5659 14.791 10.9099C14.9402 11.2539 15.0171 11.625 15.0171 12C15.0171 12.375 14.9402 12.7458 14.791 13.0898C14.6419 13.4339 14.4237 13.7437 14.15 14L9 19" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
HTML;
}