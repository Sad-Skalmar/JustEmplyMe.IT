document.addEventListener('DOMContentLoaded', function () {
    const jobPage = document.getElementById('job_offer_page');

    window.addEventListener('scroll', function () {
        const scrollPosition = window.scrollY; 
        console.log(scrollPosition);
        if (scrollPosition > 200) { 
            jobPage.style.position = 'fixed';
            jobPage.style.bottom =  '11.8vw';
            jobPage.style.right = '6.2vw';
        } else {
            jobPage.style.position = 'static'
            jobPage.style.margin = '2vw 0vw 2vw 7vw';
        }
    });
});