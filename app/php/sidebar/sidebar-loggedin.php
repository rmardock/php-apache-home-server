<!--sidebar for non-admin logged in user-->
<div class="w3-sidebar w3-bar-block w3-card w3-animate-left menu-bar">
    <button class="w3-bar-item w3-button w3-large close-button w3-menu-button">close &times;</button>
    <a href="/php/pages/account-services.php" class="w3-bar-item w3-button w3-menu-button">account</a>
    <form action="/php/back-end/logout.php" method="post">
        <input type="submit" name="logout" value="logout" class="w3-bar-item w3-button w3-menu-button">
    </form>
</div>