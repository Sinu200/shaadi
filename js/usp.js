function animateCount(element, start, end, duration) {
    let startTime = null;
    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        const progress = Math.min((currentTime - startTime) / duration, 1);
        element.textContent = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            requestAnimationFrame(animation);
        }
    }
    requestAnimationFrame(animation);
}

document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.timer');
    counters.forEach(counter => {
        const countTo = parseInt(counter.getAttribute('data-count'), 10);
        animateCount(counter, 0, countTo, 3000);
    });
});