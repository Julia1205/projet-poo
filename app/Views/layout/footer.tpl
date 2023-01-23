{*On fait le footer*}
</div>
<div class="container">
    <footer class="py-3 my-4" id="footer">
        <ul class="nav justify-content-center pb-3 mb-3" id="footer-list">
            <li class="nav-item text-muted"><a href="{base_url('/')}" class="nav-link px-2 text-reset">Home</a></li>
            <li class="nav-item text-muted"><a href="{base_url('/cgu')}" class="nav-link px-2 text-reset">GCU</a></li>
            <li class="nav-item text-muted"><a href="{base_url('/rgpd')}" class="nav-link px-2 text-reset">RGPD</a></li>
            <li class="nav-item text-muted"><a href="{base_url('/about')}" class="nav-link px-2 text-reset">About</a></li>
        </ul>
        <p class="text-center text-muted">&copy; 2023 Cocktail point, 2 allée des foulons 67380 Lingolsheim</p>
    </footer>
</div>
    {block name="js_bot"}
    {/block}
</body>
</html>