document.addEventListener("DOMContentLoaded", function () {
    gsap.to(".navbar", { duration: 1, y: 0, opacity: 1, ease: "power3.out" });
    gsap.from(".hero-text", { duration: 1.5, x: -50, opacity: 0, delay: 0.5, ease: "power3.out" });
    gsap.from(".hero-section img", { duration: 1.5, x: 50, opacity: 0, delay: 0.8, ease: "power3.out" });
});
