function flip(){
    let form = document.getElementById('form-container');
    if (form.classList.contains('flip-form')) {
        form.classList.remove('flip-form')
        form.classList.add('flip-form-again')
    }
    else{
        form.classList.remove('flip-form-again')
        form.classList.add('flip-form');
    }

    show();
}
let shown = false; 
let delay = 250; //about half the delay of the rotation
function show(){
    if (!shown) {//not shown register
        setTimeout(()=>{
            document.getElementById('login').style.display = 'none';
            document.getElementById('register').style.display = 'flex';
        }, delay);
        shown = !shown;
    }
    else{
        setTimeout(()=>{
            document.getElementById('register').style.display = 'none';
            document.getElementById('login').style.display = 'flex';
        }, delay);
        shown = !shown;
    }
}


//form data validation 
let signup_errors = {
    name: null,
    surname: null,
    email: null,
    password: null,
    password_again: null,
    
    displayed_name: false,
    displayed_surname: false,
    displayed_email: false,
    displayed_password: false,
    displayed_password_again: false
};

let login_errors = {
    email: null,
    password: null,

    displayed_email: false,
    displayed_password: false,
}

let name_div = document.getElementById('name');
let surname_div = document.getElementById('surname');
let email_signup_div = document.getElementById('email_signup');
let password_signup_div = document.getElementById('password_signup');
let password_again_div = document.getElementById('password_again');

let email_login_div = document.getElementById('email_login');
let password_login_div = document.getElementById('password_login');


async function save_data(event, type) {
    event.preventDefault();
    
    //get user input
    let name = name_div.value.trim();
    let surname = surname_div.value.trim();
    let email_signup = email_signup_div.value.trim();
    let password_signup = password_signup_div.value.trim();
    let password_again = password_again_div.value.trim();

    let email_login = email_login_div.value.trim();
    let password_login = password_login_div.value.trim();
    
    //TODO: EXTRACT THE VALUES OF THE INPUTS AND CHECK FOR VALIDATION
    
    //count errors
    
    if (type == 'login'){
        let count = check_login_errors(email_login, password_login);
        //display errors if any or send data to back end
        if (count != 0) {
            display_errors();
        }
        else{
            //send request or subim or smth
        }
    }
    else if ( type == 'signup'){
        let count = check_signup_errors(name, surname, email_signup, password_signup, password_again);
        //display errors if any or send data to back end
        if (count != 0) {
            display_errors();
        }
        else{
            //send request or subim or smth
        }
    }
}


function check_login_errors(email, password){
    //input checked for being null, string or a certain length
    let count = 0;
    if (email === null || !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        login_errors.email = 'Invalid email!';
        count++;
    }
    else{
        clear_error();
        login_errors.email = null;
    }

    
    if (password.length < 8 || password.length > 20 || !/[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(password) || !/\d/.test(password)){
        login_errors.password = 'Password must be between 8 and 20 characters, it should contain at least one symbol and one number';
        count++;
    }
    else{
        clear_error();
        login_errors.password = null;
    }

    return count;
}

// TODO: CONTINUE WITH THE OTHER SIGNUP FUNCTION HERE
function check_signup_errors(name, surname, email, password, password_again){
    let count = 0;

    if (name.length > 20 ) {
        signup_errors.name = "Name can't be more than 20 characters long!";
        count ++;
    }
    else if(!isNaN(name)){
        signup_errors.name = "Name must be a string";
        count ++;
    }
    else if (name === null){
        signup_errors.name = "You must enter a name";
        count ++;
    }
    else{
        clear_error()
        signup_errors.name = null;
    }

    if (surname.length > 20 ) {
        signup_errors.surname = "Surname can't be more than 20 characters long!";
        count ++;
    }
    else if(!isNaN(surname)){
        signup_errors.surname = "Surname must be a string";
        count ++;
    }
    else if (surname === null){
        signup_errors.surname = "You must enter a surname";
        count ++;
    }
    else{
        clear_error()
        signup_errors.surname = null;
    }

    if (email === null || !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        signup_errors.email = 'Invalid email!';
        count++;
    }
    else{
        clear_error();
        signup_errors.email = null;
    }

    if (password.length < 8 || password.length > 20 || !/[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(password) || !/\d/.test(password)){
        signup_errors.password = 'Password must be between 8 and 20 characters, it should contain at least one symbol and one number';
        count++;
    }
    else{
        clear_error();
        signup_errors.password = null;
    }

    if (password_again != password) {                
        signup_errors.password_again = "Passwords don't match";
        count++;
    }
    else{
        clear_error();
        signup_errors.password_again = null;
    }
    

    return count;
}


function display_errors() {
    if (login_errors.email != null && !login_errors.displayed_email) {
        create_error_message(login_errors.email, email_login_div);
        login_errors.displayed_email = true;
    }
    if (login_errors.password != null && !login_errors.displayed_password) {
        create_error_message(login_errors.password, password_login_div);
        login_errors.displayed_password = true;
    }

    if (signup_errors.email != null && !signup_errors.displayed_email){
        create_error_message(signup_errors.email, email_signup_div);
        signup_errors.displayed_email = true;
    }
    if (signup_errors.name != null && !signup_errors.displayed_name){
        create_error_message(signup_errors.name, name_div);
        signup_errors.displayed_name = true;
    }
    if (signup_errors.surname != null && !signup_errors.displayed_surname){
        create_error_message(signup_errors.surname, surname_div);
    }
    if (signup_errors.password != null && !signup_errors.displayed_password) {
        create_error_message(signup_errors.password, password_signup_div);
        signup_errors.displayed_password = true;
    }
    if (signup_errors.password_again != null && !signup_errors.displayed_password_again){
        create_error_message(signup_errors.password_again, password_again_div);
        signup_errors.displayed_password_again = true;
    }
}


function create_error_message(message, element)
{
    //helper function that creates error spans
    let span = document.createElement('span');
    span.innerHTML = message;
    span.className = 'error';

    element.after(span);
    element.value = '';
}


function clear_error(){
    if(login_errors.displayed_email){
        email_login_div.nextElementSibling.remove();
        login_errors.displayed_email = false;
    }    
    else if (login_errors.displayed_password){
        password_login_div.nextElementSibling.remove();
        login_errors.displayed_password = false;
    }
    else if (signup_errors.displayed_email){
        email_signup_div.nextElementSibling.remove();
        signup_errors.displayed_email = false;
    }
    else if(signup_errors.displayed_surname){
        surname_div.nextElementSibling.remove();
        signup_errors.displayed_surname = false;
    }
    else if(signup_errors.displayed_name){
        name_div.nextElementSibling(remove());
        signup_errors.displayed_name = false;
    }
    else if(signup_errors.displayed_password){
        password_signup_div.nextElementSibling.remove();
        signup_errors.displayed_password = false;
    }
    else if(signup_errors.displayed_password_again){
        password_again_div.nextElementSibling.remove();
        signup_errors.displayed_password_again = false;
    }
    
}