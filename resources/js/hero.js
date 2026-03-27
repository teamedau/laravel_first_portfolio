document.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap === 'undefined') return

    const lines  = document.querySelectorAll('.hero-line-inner')
    const fades  = document.querySelectorAll('[data-anim="fade"]')

    if (!lines.length) return

    // Start hidden
    gsap.set(lines, { y: '105%' })
    gsap.set(fades, { opacity: 0, y: 18 })

    // Staggered reveal timeline
    const tl = gsap.timeline({ defaults: { ease: 'power3.out' } })

    tl.to(lines, {
            y: '0%',
            duration: 1,
            stagger: 0.12,
            delay: 0.15,
        })
        .to(fades, {
            opacity: 1,
            y: 0,
            duration: 0.8,
            stagger: 0.1,
        }, '-=0.55')
})
