<header>
    <div class="nav__container">
        <nav>
            <input type="checkbox" id="nav-toggle" class="nav__toggle-checkbox">
            <label for="nav-toggle" class="nav__toggle-label">
                <span class="nav__toggle-icon"></span>
            </label>
            <a href="index.php" class="nav__logo">
                <img src="../../imgs/logo.png" alt="click here to go to BBC homepage">
            </a>
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="index.php" class="nav__link">Home</a>
                </li>
                <li class="nav__item red-after">
                    <a href="kategorija.php?id=news" class="nav__link">News</a>
                </li>
                <li class="nav__item yellow-after">
                    <a href="kategorija.php?id=sport" class="nav__link">Sport</a>
                </li>
                <li class="nav__item green-after">
                    <a href="kategorija.php?id=culture" class="nav__link">Culture</a>
                </li>
                <li class="nav__item blue-after">
                    <a href="login.php" class="nav__link">Admin</a>
                </li>
            </ul>
        </nav>
        <div class="search" id="search" onclick="toggleSearch()">
            <img src="../../imgs/search.png">
        </div>
        <div class="searchContent">
            <p>Šalim se, ne postoji search :)</p>
        </div>
    </div>
    <script>
        function toggleSearch() {
            const searchContent = document.querySelector('.searchContent');
            searchContent.classList.toggle('open');
        }
    </script>
</header>