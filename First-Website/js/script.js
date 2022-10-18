// ************************************ [1] Transparent Header on first section after that header will has background
window.addEventListener('scroll', () => {
    let scrollValue = window.scrollY;
    if (scrollValue > 122) {
        document.querySelector('header').classList.add('bg');
    } else {
        document.querySelector('header').classList.remove('bg');
    }
})

// ************************************ [2] Smooth scroll to section
document.querySelectorAll('a[href^="#"]').forEach((el) => {
    el.onclick = (e) => {
        e.preventDefault();
        document.querySelector(el.getAttribute("href")).scrollIntoView({
            behavior: "smooth"
        });
    }
});

// ************************************ [3] Our Work Filter
let front = document.querySelector('#front'),
    back = document.querySelector('#back'),
    seo = document.querySelector('#seo'),
    hosting = document.querySelector('#hosting'),
    Sfront = document.querySelector('.front'),
    Sback = document.querySelector('.back'),
    Sseo = document.querySelector('.seo'),
    Shosting = document.querySelector('.hosting');

front.onclick = () => {
    Sfront.classList.remove('hide');
    front.classList.add('active');
    Sback.classList.add('hide');
    back.classList.remove('active');
    Sseo.classList.add('hide');
    seo.classList.remove('active');
    Shosting.classList.add('hide');
    hosting.classList.remove('active');
}
back.onclick = () => {
    Sfront.classList.add('hide');
    front.classList.remove('active');
    Sback.classList.remove('hide');
    back.classList.add('active');
    Sseo.classList.add('hide');
    seo.classList.remove('active');
    Shosting.classList.add('hide');
    hosting.classList.remove('active');
}
seo.onclick = () => {
    Sfront.classList.add('hide');
    front.classList.remove('active');
    Sback.classList.add('hide');
    back.classList.remove('active');
    Sseo.classList.remove('hide');
    seo.classList.add('active');
    Shosting.classList.add('hide');
    hosting.classList.remove('active');
}
hosting.onclick = () => {
    Sfront.classList.add('hide');
    front.classList.remove('active');
    Sback.classList.add('hide');
    back.classList.remove('active');
    Sseo.classList.add('hide');
    seo.classList.remove('active');
    Shosting.classList.remove('hide');
    hosting.classList.add('active');
}

// ************************************ [4] Scroll Top



// ************************************ [5] Form Validation with error messages 

let btn = document.querySelector('#btn'),
    required = document.querySelectorAll('.required');
btn.onclick = () => {
    required.forEach((e) => {
        if(e.value ==''){
            e.parentNode.querySelector('span').style.display = 'block';
        }else{
            e.parentNode.querySelector('span').style.display = 'none';
        }
    });
}
// ************************************ [7] Loading screen with percentage of loading
let progres = document.querySelector('.progres'),
    section = document.querySelector('section');

let number = document.querySelector('.number');
let counter = 0;
setInterval(() => {
    if (counter == 100) {
        progres.setAttribute('class', 'hidden');
        section.classList.remove('hidden');
        clearInterval();
    } else {
        counter += 1;
        number.innerHTML = counter + "%";
    }

}, 20);

