document.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap === 'undefined') return

    const lines     = document.querySelectorAll('.hero-line-inner')
    const fades     = document.querySelectorAll('[data-anim="fade"]')
    const rolecards = document.querySelectorAll('[data-anim="role"]')

    if (!lines.length) return

    // Initial state
    gsap.set(lines,     { y: '105%' })
    gsap.set(fades,     { opacity: 0, y: 16 })
    gsap.set(rolecards, { opacity: 0, y: 22 })

    const tl = gsap.timeline({ defaults: { ease: 'power3.out' } })

    tl.to(lines, {
            y: '0%',
            duration: 0.95,
            stagger: 0.11,
            delay: 0.1,
        })
        .to(fades, {
            opacity: 1,
            y: 0,
            duration: 0.75,
            stagger: 0.1,
        }, '-=0.5')
        .to(rolecards, {
            opacity: 1,
            y: 0,
            duration: 0.6,
            stagger: 0.09,
        }, '-=0.35')

    // Subtle parallax on glow blobs
    const blob1 = document.querySelector('.hero-blob--1')
    const blob2 = document.querySelector('.hero-blob--2')

    if (blob1 && blob2) {
        window.addEventListener('mousemove', (e) => {
            const x = (e.clientX / window.innerWidth  - 0.5) * 30
            const y = (e.clientY / window.innerHeight - 0.5) * 20

            gsap.to(blob1, { x:  x * 0.6, y:  y * 0.5, duration: 1.8, ease: 'power1.out' })
            gsap.to(blob2, { x: -x * 0.4, y: -y * 0.3, duration: 2.2, ease: 'power1.out' })
        }, { passive: true })
    }
})
