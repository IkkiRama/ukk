
    <aside>
        <div class="profil">
            <img src="img/img1.jpg" alt="img user">
            <p><?php echo $_SESSION['pelanggan']['username'] ?></p>
        </div>
        
        <a href="index.php" class="perMenu">
            <div class="icon">
                <i class="fas fa-home"></i>
            </div>
            <p>Home</p>
        </a>

        <a href="buku.php" class="perMenu">
            <div class="icon">
                <i class="fas fa-book-open"></i>
            </div>
            <p>Buku</p>
        </a>

        <a href="user.php" class="perMenu">
            <div class="icon">
                <i class="fas fa-user-alt "></i>
            </div>
            <p>User</p>
        </a>


        <a href="logout.php" class="perMenu">
            <div class="icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <p>Logout</p>
        </a>

    </aside>