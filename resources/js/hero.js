document.addEventListener('DOMContentLoaded', () => {
    const hero = document.querySelector('[data-hero]')
    if (!hero || typeof gsap === 'undefined') return

    window.addEventListener('mousemove', (e) => {
        const { clientX, clientY } = e
        const x = Math.round((clientX / window.innerWidth) * 100)
        const y = Math.round((clientY / window.innerHeight) * 100)

        gsap.to(hero, {
            '--x': `${x}%`,
            '--y': `${y}%`,
            duration: 0.3,
            ease: 'sine.out',
        })
    })
})
