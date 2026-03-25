<footer class="footer">
    <!-- LEFT: SUBSCRIBE -->
    <div class="footer-subscribe">
        <h4>Stay in the loop</h4>
        <form class="subscribe-form">
            <input type="text" placeholder="Your name" />
            <input type="email" placeholder="Your email" />
            <button type="submit">Subscribe</button>
        </form>
    </div>

    <!-- CENTER: MENU -->
    <div class="footer-menu">
        <h4>Explore</h4>
        <ul>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('projects.index') }}">Projects</a></li>
            <li><a href="{{ route('login') }}">Sign in</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        </ul>
    </div>

    <!-- RIGHT: SOCIAL -->
    <div class="footer-social">
        <h4>Connect</h4>
        <ul>
            <li><a href="https://www.linkedin.com/in/vivianacastrillonolave/" target="_blank" rel="noopener">LinkedIn</a></li>
            <li><a href="https://github.com/teamedau" target="_blank" rel="noopener">GitHub</a></li>
            <li><a href="mailto:hello@vicaprojects.com">Email</a></li>
        </ul>
    </div>

    <!-- BOTTOM -->
    <div class="footer-bottom">
        <p>© {{ date('Y') }} Vica Projects. All rights reserved.</p>
    </div>
</footer>
