

function smoothScroll(){
    let x = document.querySelectorAll('a[href*="#"]');
    for(let i = 0; i < x.length ; i++){
        x[i].addEventListener('click', function(e){
            e.preventDefault();
            let target = document.querySelector(this.hash);
            target.scrollIntoView({
                behavior: 'smooth',
                alignToTop: true,
                block: 'center'
            });
        });
    };
}

smoothScroll();


jQuery(function ($) {

    // scroll to element
    const duration = 600;

    const scrollToTarget = function(target) {
        const top = target.getBoundingClientRect().top;
        const startPos = window.pageYOffset;
        const diff = top;

        let startTime = null;
        let requestId;

        const loop = function(currentTime) {
            if (!startTime) {
                startTime = currentTime;
            }

            // Elapsed time in miliseconds
            const time = currentTime - startTime;

            const percent = Math.min(time / duration, 1);
            const easeInQuad = function(t) {
                return t * t;
            };
            window.scrollTo(0, startPos + diff * percent);

            if (time < duration) {
                // Continue moving
                requestId = window.requestAnimationFrame(loop);
            } else {
                window.cancelAnimationFrame(requestId);
            }
        };
        requestId = window.requestAnimationFrame(loop);
    };

    const triggers = [].slice.call(document.querySelectorAll('.trigger'));
    let activeTriggerEle = triggers.length === 0 ? null : triggers[0];

    const clickHandler = function(e) {
        // Prevent the default action
        e.preventDefault();

        // Get the `href` attribute
        const href = e.target.getAttribute('href');
        // const id = href.substr(1);
        const target = document.getElementById('section-1');

        // activeTriggerEle && activeTriggerEle.classList.remove('bg-gray-400');
        // activeTriggerEle = e.target;
        // activeTriggerEle.classList.add('bg-gray-400');

        scrollToTarget(target);
    };

    triggers.forEach(function(ele) {
        ele.addEventListener('click', clickHandler);
    });

});
