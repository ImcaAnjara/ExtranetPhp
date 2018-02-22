<?php 
session_start ();
if (isset($_SESSION['nomprof']) && isset($_SESSION['codeprof'])) {
    
    $nom = strtoupper($_SESSION['nomprof']);
    
    }
    else {
        echo '<meta http-equiv="refresh" content="0;URL=loginprof.php">';
    }
?>

<section id="main" class="no-padding">
                <header class="page-header">
                    <div class="container">
                        <div class="col-md-6">
                            <h1 class="title">ACCÈS PROFESSEUR: <?php echo($nom);?></h1>

                        </div>
                        <div class="col-md-6"></div>
                        <div class="breadcrumb-box pull-right">
                            <div class="breadcrum_inner"><a class="home" href="">Accueil</a> > Accès Professeur et Forma2+</div>
                        </div>
                    </div>
                </header>
                <div class="container">
                    <div class="row">
                        <!-- .content -->
                        <section>
                        </section>

                    </div>
                </div>
            </section>
        </div>
    </div>