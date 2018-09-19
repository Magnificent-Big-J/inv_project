<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="margin-bottom: 20px">
    <a class="navbar-brand" href="#">Inventory Management System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php"><i class="fa fa-home">&nbsp;</i> Home <span class="sr-only">(current)</span></a>
            </li>

                <?php
                if(isset($_SESSION["userid"]))
                {
                  ?>
            <li class="nav-item">
                    <a class="nav-link active" href="logout.php">Logout</a>
            </li>
                    <?php
                }
                ?>




        </ul>

    </div>
</nav>