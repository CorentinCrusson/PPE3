<div class="navbar-collapse collapse w-100" id="navbar3">
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
            <li class="nav-item active">
                <ul class="dropdown">
                    <button class="btn btn-secondary ml-auto dropdown-toggle" type="button" data-toggle="dropdown"><a href="index.php?vue=videotheque&action=aleatoire" style="text-decoration:none;color:white;" >Support Aléatoire</a></button>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?vue=videotheque&action=aleatoire">Aléatoire</a></li>
                        <li><a href="index.php?vue=videotheque&action=aleatoire&genre=4">Policier</a></li>
                    </ul>
                </ul>
            </li>
        </ul>

        <!--<div class="form-group form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" id="search-video" type="text" placeholder="Search">
        </div>
        <div>
         <div id="result-search"></div> <!-- C'est ici que nous aurons nos résultats de notre recherche -->
       <!--</div> -->


        <ul class="nav navbar-nav ml-auto pos-a'vatar justify-content-end">

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
