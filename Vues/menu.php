﻿<div class="navbar-collapse collapse w-100" id="navbar3">
        <ul class="navbar-nav w-100">
            <li class="nav-item active">
                <ul class="dropdown spec-bot">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">Les Films<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?vue=film&action=visualiser">Voir tous les films</a></li>
                    </ul>
                </ul>
            </li>
            <li class="nav-item active">
                <ul class="dropdown">
                    <button class="btn btn-secondary ml-auto dropdown-toggle" type="button" data-toggle="dropdown">Les Séries<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?vue=serie&action=visualiser">Voir toutes les séries</a></li>
                    </ul>
                </ul>
            </li>
        </ul>

        <div class="md-form mt-0">
          <input class="form-control" type="text" placeholder="Search" aria-label="Search">          
        </div>

        <ul class="nav navbar-nav ml-auto pos-avatar justify-content-end">

            <li class="nav-item active">
                <ul class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle btn-avatar" type="button" data-toggle="dropdown"><img class="avatar" src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png"><?php echo $_SESSION['nom']; echo ' '.$_SESSION['prenom']; ?><span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <!--<li><a href="index.php?vue=compte&action=verifLogin">Se connecter</a></li>-->
                        <li><a href="index.php?vue=compte&action=visualiser">Accéder à mon profil</a></li>
            						<li><a href='index.php?vue=compte&action=visuEmprunt'>Visualiser mes Emprunts</a></li>
            						<li><a href='index.php?vue=compte&action=deconnexion'>Se déconnecter</a></li>
                    </ul>
                </ul>
            </li>
        </ul>
    </div>
</nav>
