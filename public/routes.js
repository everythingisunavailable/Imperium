/*
base url : http://127.0.0.1:5500/public/index.html/product/productId
what we need : product/productId
what we going to turn it into : /server/routes.php?query0=product&query1=productId
excpected to be called on every GET
*/

const BASE_URL = "public/";
function extract_link(){
    let url = window.location.pathname;
    let sub_url = url.substring(url.indexOf(BASE_URL) + BASE_URL.length);
    let sub_url_arr = sub_url.split('/');

    let get_url = '/imperium/server/routes.php?';
    
    if (sub_url_arr[0] == '') {
        return get_url
    }
    
    for (let i = 0; i < sub_url_arr.length; i++) {
        get_url = get_url + 'query' + i + '=' + sub_url_arr[i];
        if (sub_url_arr.length - i != 1){ //if we are NOT at the last word
            get_url = get_url + '&';
        }
    }
    return get_url
}

function create_page_loader(){
    return '<div class="page-loader"><img src="assets/icons/fan-circled-svgrepo-com.svg" alt="loader"></div>';
}
async function getData() {
    const url = extract_link();

    try {
        const response = await fetch(url);
        if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
        }

        document.querySelector('.content').innerHTML = create_page_loader();
        console.log('fetching data');
        
        const data = await response.text();

        //add data do main page
        document.querySelector('.content').innerHTML = data;

    } catch (error) {
        console.error(error.message);
    }
}

window.onload = async function() {
    await getData();
};
window.addEventListener("popstate", (event) => {getData()});

function goTo(url){
    history.pushState({tab: new URL(location).pathname}, "", url);
    getData();
    window.scrollTo({top: "0", behavior: "smooth"});
}
function eventGoTo(event, url){
    event.preventDefault();
    goTo(url);
}