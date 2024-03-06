<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a style="padding-left:5px" class="navbar-brand" href="/PJ2/">
        <img src="https://v4-alpha.getbootstrap.com/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        <span class="menu-collapsed">Tools Cùi</span>
    </a>
    
    <div class="collapse navbar-collapse" id="navbarNav" style="padding-right: 40px;">
        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $_SESSION['PJ2_name']; ?></a>
                </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          
                    <img src="/PJ2/avatar-user.jpg" alt="Avatar" style="width: 30px; height: 30px; border-radius: 50%;">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Edit profile</a>
                    <div class="dropdown-divider"></div>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="submit" class="dropdown-item" name="logout" value="Log out">
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>