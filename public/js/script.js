// Navbar toggler
let navToggler = document.getElementById("nav-toggler");
let navCollapse = document.getElementById("nav-dropdown");

navToggler?.addEventListener('click', () => {
    if (navCollapse.classList.contains("toggle-collapse")) {
        navCollapse.classList.remove("toggle-collapse");
    } else {
        navCollapse.classList.add("toggle-collapse");
    }
});


function setThemeCookie(e) {
    let event = new Event("theme-changed");
    event.initEvent('theme-changed', true, true);
    document.cookie = "theme=;expires=Thu, 18 Dec 2021 12:00:00 UTC;path=/";

    let body = document.getElementsByTagName('body')[0];
    let currentTheme = body.classList[0];
    console.log(currentTheme);
    if (e.target.checked  && currentTheme === 'light') {
        document.cookie = "theme=dark;expires=Thu, 18 Dec 2021 12:00:00 UTC;path=/";
        body.dispatchEvent(event);
    } else if (e.target.checked  && currentTheme === 'dark') {
        document.cookie = "theme=light;expires=Thu, 18 Dec 2021 12:00:00 UTC;path=/";
        body.dispatchEvent(event);
    }else if (!e.target.checked  && currentTheme === 'light'){
        document.cookie = "theme=dark;expires=Thu, 18 Dec 2021 12:00:00 UTC;path=/";
        body.dispatchEvent(event);
    }else if (!e.target.checked  && currentTheme === 'dark'){
        document.cookie = "theme=light;expires=Thu, 18 Dec 2021 12:00:00 UTC;path=/";
        body.dispatchEvent(event);
    }
}

function changeTheme(e) {
    let cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        if (cookies[i].split('=')[0].trim() === 'theme') {
            let themeValue = cookies[i].split('=')[1];
            e.target.classList = '' + themeValue;
        }
    }


}

document.getElementById('theme-mode').addEventListener('click', setThemeCookie);

document.getElementsByTagName('body')[0].addEventListener('theme-changed', changeTheme);
