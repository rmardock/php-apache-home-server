<!--sidebar for non-admin logged in user-->
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left menu-bar">
    <button class="w3-bar-item w3-button w3-large close-button w3-menu-button">Close &times;</button>
    <a href="/php/pages/account-services.php" class="w3-bar-item w3-button w3-menu-button">Account</a>
    <form action="/php/back-end/logout.php" method="post">
        <input type="submit" name="logout" value="Logout" class="w3-bar-item w3-button w3-menu-button">
    </form>
</div>
