@extends('layouts.app')

@push('styles')
<style>
/* Prevent page scroll for the 404 animation */
body { overflow: hidden; }

/* === 404 OCEAN === */
.not-found {
    position: relative;
    overflow: hidden;
    margin: 0 -20vw;
    height: 110vh;
    font-family: var(--font-body);
}

.not-found [class*="wave"] {
    position: absolute;
}

.not-found div {
    position: absolute;
    width: 100%;
    bottom: 0;
    left: 0;
}

.not-found div.sky-bg {
    background: url('http://res.cloudinary.com/andrewhani/image/upload/v1524821915/404/bg-1_gvybzk.svg') center/cover no-repeat;
    height: 100%;
}

.not-found div.wave-1 { background: url('http://res.cloudinary.com/andrewhani/image/upload/v1524501869/404/wave-1.svg') repeat-x bottom; }
.not-found div.wave-2 { background: url('http://res.cloudinary.com/andrewhani/image/upload/v1524501869/404/wave-2.svg') repeat-x bottom; }
.not-found div.wave-3 { background: url('http://res.cloudinary.com/andrewhani/image/upload/v1524501869/404/wave-3.svg') repeat-x bottom; }
.not-found div.wave-4 { background: url('http://res.cloudinary.com/andrewhani/image/upload/v1524501869/404/wave-4.svg') repeat-x bottom; }
.not-found div.wave-5 { background: url('http://res.cloudinary.com/andrewhani/image/upload/v1524501869/404/wave-5.svg') repeat-x bottom; }
.not-found div.wave-6 { background: url('http://res.cloudinary.com/andrewhani/image/upload/v1524501869/404/wave-6.svg') repeat-x bottom; }
.not-found div.wave-7 { background: url('http://res.cloudinary.com/andrewhani/image/upload/v1524501869/404/wave-7.svg') repeat-x bottom; }

.not-found div[class*="wave"]:not(.wave-4) {
    height: calc(100% - 250px);
}

.not-found div.wave-4 {
    height: calc(100% - 430px);
}

.not-found .boat {
    position: absolute;
    top: 0;
    right: 15%;
    width: 150px;
    animation: boat404 15s cubic-bezier(0.65, 0.05, 0.36, 1) infinite;
}

.not-found .wave-lost {
    position: absolute;
    top: 20%;
    left: 50%;
    color: #fff;
    font-size: 20rem;
    animation: surf404 2s;
}

.not-found .wave-lost span {
    float: left;
    animation: float404 3s ease-in infinite;
}

.not-found .wave-lost span:nth-child(2) {
    animation-delay: 2.5s;
}

.not-found .wave-lost span:nth-child(3) {
    animation-delay: 4.5s;
}

.not-found .wave-island {
    position: absolute;
    top: 130px;
    left: 20%;
    padding: 10px;
    width: 170px;
    display: block;
}

.not-found .wave-message {
    position: absolute;
    bottom: 100px;
    left: 50%;
    padding-right: 50%;
    height: auto !important;
    color: #fff;
    font-size: 3rem;
    text-align: left;
    animation: waveMsg404 1s;
}

@keyframes boat404 {
    0%   { transform-origin: left; transform: rotate(-15deg) translate3d(400px, 0px, 0px); }
    20%  { transform-origin: left; transform: rotate(15deg) translate3d(-20vw, 0, 0px); }
    25%  { transform-origin: left; transform: rotate(-7deg) translate3d(-25vw, 0, 0px); }
    50%  { transform-origin: left; transform: rotate(5deg) translate3d(-50vw, 0, 0px); }
    60%  { transform-origin: left; transform: rotate(-1deg) translate3d(-60vw, 0, 0px); }
    100% { transform-origin: left; transform: rotate(2deg) translate3d(-100vw, 0, 0px); }
}

@keyframes float404 {
    0%, 100% { transform: rotate(3deg) translate3d(0px, -10px, 0px); }
    50%       { transform: rotate(-3deg) translate3d(0px, 10px, 0px); }
}

@keyframes surf404 {
    0%   { transform-origin: right; transform: rotate(15deg) translate3d(0, 800px, 0); }
    30%  { transform-origin: right; transform: rotate(15deg) translate3d(0, 500px, 0); }
    100% { transform-origin: right; transform: rotate(0) translate3d(0, 0, 0px); }
}

@keyframes waveMsg404 {
    0%   { transform: translate3d(0, 120%, 0); }
    100% { transform: translate3d(0, 0, 0); }
}

@media (max-width: 767px) {
    .not-found {
        margin: 0;
        height: 100vh;
    }

    .not-found .wave-lost {
        font-size: 7rem;
        left: 50%;
        top: 12%;
        transform: translateX(-50%);
    }

    .not-found .wave-message {
        font-size: 1.4rem;
        left: 50%;
        bottom: 80px;
        padding-right: 0;
        transform: translateX(-50%);
        text-align: center;
        white-space: nowrap;
    }

    .not-found .boat {
        width: 80px;
        right: 5%;
    }

    .not-found .wave-island {
        width: 90px;
        left: 8%;
        top: 100px;
    }
}
</style>
@endpush

@section('content')
<div class="not-found parallax">
    <div class="sky-bg"></div>
    <div class="wave-7"></div>
    <div class="wave-6"></div>
    <a class="wave-island" href="{{ route('home') }}">
        <img src="http://res.cloudinary.com/andrewhani/image/upload/v1524501929/404/island.svg" alt="Island — click to return home">
    </a>
    <div class="wave-5"></div>
    <div class="wave-lost">
        <span>4</span>
        <span>0</span>
        <span>4</span>
    </div>
    <div class="wave-4"></div>
    <div class="wave-boat">
        <img class="boat" src="http://res.cloudinary.com/andrewhani/image/upload/v1524501894/404/boat.svg" alt="Boat">
    </div>
    <div class="wave-3"></div>
    <div class="wave-2"></div>
    <div class="wave-1"></div>
    <div class="wave-message">
        <p>You're lost</p>
        <p>Click the island to return</p>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    function parallax(e) {
        if (window.innerWidth < 768) return;
        var el = document.querySelector('.parallax');
        var halfW = el.offsetWidth / 2;
        var halfH = el.offsetHeight / 2;
        var rect  = el.getBoundingClientRect();
        var x     = e.pageX;
        var y     = e.pageY - (rect.top + window.scrollY);
        var newX  = (x - halfW) / 30;
        var newY  = (y - halfH) / 30;
        el.querySelectorAll('[class*="wave"]').forEach(function (wave, index) {
            wave.style.transition = '';
            wave.style.transform  = 'translate3d(' + (index * newX) + 'px,' + (index * newY) + 'px,0px)';
        });
    }

    function stopParallax() {
        var waves = document.querySelectorAll('.parallax [class*="wave"]');
        waves.forEach(function (wave) {
            wave.style.transform  = 'translate(0px,0px)';
            wave.style.transition = 'all .7s';
        });
        setTimeout(function () {
            waves.forEach(function (wave) { wave.style.transition = ''; });
        }, 700);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var notFound = document.querySelector('.not-found');
        if (notFound) {
            notFound.addEventListener('mousemove', parallax);
            notFound.addEventListener('mouseleave', stopParallax);
        }
    });
})();
</script>
@endpush
