<nav class="navbar navbar-expand navbar-light navbar-bg bg-dark-subtle">
    <!-- <a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a> -->
    <a class="sidebar-brand" href="dashbord.php">
        <img src="./img/photos/logo.webp" alt="">
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="./img/photos/a1.jpg" class="avatar img-fluid rounded me-1" alt=""/> <span class="text-dark"> <?php echo $_SESSION['username']; ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    
                    <!-- <a class="dropdown-item" href="register.php"><i class="align-middle me-2" data-feather="user-plus"></i> Account</a>
                    <a class="dropdown-item" href="login.php"><i class="align-middle me-2" data-feather="log-in"></i> Login</a> -->
                                            <!-- <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                    <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item" href="logout.php"><i class="align-middle me-1" data-feather="log-out"></i>Log out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>