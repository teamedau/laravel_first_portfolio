<footer class="footer">

    <!-- COL 2: CONNECT (social links) -->
    <div class="footer-social">
        <h4>Connect</h4>
        <ul>
            <li><a href="https://www.linkedin.com/in/vivianacastrillonolave/" target="_blank" rel="noopener">LinkedIn</a></li>
            <li><a href="https://github.com/teamedau" target="_blank" rel="noopener">GitHub</a></li>
            <li><a href="mailto:hello@vicaprojects.com">Email</a></li>
        </ul>
    </div>

    <!-- COL 3: EXPLORE (nav links) -->
    <div class="footer-menu">
        <h4>Explore</h4>
        <ul>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('projects.index') }}">Projects</a></li>
        </ul>
    </div>

    <!-- BOTTOM -->
    <div class="footer-bottom">
        <p>© {{ date('Y') }} Vica Projects. All rights reserved.</p>
    </div>
</footer>
