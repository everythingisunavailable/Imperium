// Hero section pc carousel
function scale_and_move(element, delta_x, delta_y, scale){
    element.style.transform = `scale(${scale}) translate(${delta_x / scale}px, ${delta_y / scale}px)`;
}
function reset_element(element){
    element.style.transform = `translate(0,0)`;
}
function btn_pop_into_view(btn, index){
    btn.disabled = !btn.disabled;
    
    pop_into_view(index);
}
function pop_into_view(index){
    let pc_hero = document.getElementById('hero-right');
    let target = {x: pc_hero.getBoundingClientRect().x + (pc_hero.clientWidth/3), y: pc_hero.getBoundingClientRect().y + pc_hero.clientHeight/2.5};
    
    let pc_array = document.getElementsByClassName('carousel-item');
    //since the buttons are the parents of the above array elements, then we can traverse them using that array
    let btn_array = document.getElementsByClassName('pc_btn');
    for (let i = 0; i < pc_array.length; i++) {
        let start_position = {x: pc_array[i].getBoundingClientRect().x ,y: pc_array[i].getBoundingClientRect().y};
        let delta_x = target.x - start_position.x;
        let delta_y = target.y - start_position.y;

        if (index == i) {
            scale_and_move(pc_array[i], delta_x, delta_y, 7);
        }
        else{
            reset_element(pc_array[i]);
            //reset the buttons also
            btn_array[i].disabled = false;
        }
    }
}
