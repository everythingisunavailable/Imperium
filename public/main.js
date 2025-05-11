class Hideable {
    constructor(id, move_distance, hide_direction, show_direction){
        this.element = document.getElementById(id);
        this.move_distance = move_distance;
        this.hidden = false;
        this.timeout_id = null;
        this.hide_direction = hide_direction;
        this.show_direction = show_direction;
        this.hide_delay = 3000;

        this.listen_for_activity();
    }
    update_hidden(boolean){
        if(boolean)this.hidden = true;
        else this.hidden = false;
    }
    update_timeout_id(id){
        this.timeout_id = id;
    }
    listen_for_activity(){
        this.element.addEventListener( 'mouseenter', ()=>{
            this.interupt_hide();
        });
        let children = this.element.getElementsByTagName('*');
        for (let element of children){            
            element.addEventListener('focus', ()=>{
                this.interupt_hide();
            });
        };
        
    }
    interupt_hide(){
        clearTimeout(this.timeout_id);
        this.update_hidden(false);
    }
}
class ScrollPos{
    constructor(){
        this.prev_x = null;
        this.prev_y = null;
        this.y = window.scrollY;
        this.x = window.scrollX;
    }

    update(){
        this.prev_x = this.x;
        this.prev_y = this.y;
        this.y = window.scrollY;
        this.x = window.scrollX;
    }
}

function move(element, direction, pixels){    
    switch (direction) {
        case 'up':
            element.style.transform = `translateY(-${pixels}px)`;
            break;
        case 'down':
            element.style.transform = `translateY(${pixels}px)`;
            break;
        case 'left':
            element.style.transform = `translateX(-${pixels}px)`;
            break;
        case 'right':
            element.style.transform = `translateX(${pixels}px)`;
            break;
        default:
            break;
    }
}

const NAV = new Hideable('nav', 100, 'up', 'down');
const SCROLLABLE = new ScrollPos();
const GO_TOP_BUTTON = new Hideable('go_top_button', 100, 'down', 'up');



function hide_object(hideable, delay){
    clearTimeout(hideable.timeout_id);
    if (delay > 0) {
        let tm_id = setTimeout(()=>{move(hideable.element, hideable.hide_direction, hideable.move_distance); hideable.update_hidden(true)}, delay);
        hideable.update_timeout_id(tm_id);
    }
    else{
        move(hideable.element, hideable.hide_direction, hideable.move_distance);
        hideable.update_hidden(true);
    }
}
function show_object(hideable){    
    move(hideable.element, hideable.show_direction, 0);
    hideable.update_hidden(false);
    hide_object(hideable, hideable.hide_delay);
}

// EVENT LISTENERS (desktop-only)
if (window.innerWidth > 975) {
    window.addEventListener('scroll', ()=>{
        SCROLLABLE.update();
        if (SCROLLABLE.y > SCROLLABLE.prev_y && !NAV.hidden) {
            hide_object(NAV, 0);
            hide_object(GO_TOP_BUTTON, 0);
        }
        else if (SCROLLABLE.y < SCROLLABLE.prev_y && NAV.hidden){
            show_object(NAV);
            show_object(GO_TOP_BUTTON);
        }
    });
}

function toggle_ham_menu(){
    document.querySelector('.hamburger').classList.toggle('hide-nav');
}
function close_ham_menu(event){
    if (!document.querySelector('.hamburger').contains(event.target) && !document.querySelector('.ham-button').contains(event.target)) {
        document.querySelector('.hamburger').classList.add('hide-nav');
    }
}
window.addEventListener('click',  (event)=>{    
    close_ham_menu(event);
});

//animate the elements on scroll
let ANIMATION_INTERVAL_ID = setInterval(animate,100);
function animate(){
    let elements = document.getElementsByClassName('animate-in');
    for (let i = 0; i < elements.length; i++) {
        if (elements[i].offsetTop < window.scrollY + window.innerHeight) {
            elements[i].classList.remove('animate-in');
        }
    }
}