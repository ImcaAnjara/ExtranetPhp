<?php 
session_start ();
if (isset($_SESSION['nomprof']) && isset($_SESSION['codeprof'])) {
    
    $nom = strtoupper($_SESSION['nomprof']);
    
    }
    else {
        echo '<meta http-equiv="refresh" content="0;URL=loginprof.php">';
    }
?>
<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="design/extranet/css/jquery.dataTables.min.css" />
		<script src="design/extranet/js/jquery.min.js"></script>
		<script src="design/extranet/js/jquery-1.12.4.js"></script>
		<script src="design/extranet/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
		    $('#example').DataTable( {
		        "ajax": "Ajax/array.txt"
		    } );
		} );
		
		</script>
	</head>
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
                
                 <div class="table-responsive">
                                    <table id="example" class="table table-striped">
                                      <thead>
                                        <tr>
                                                <th> </th>
                                                <th>FDD</th>
                                                <th>QCM</th>
                                                <th>Note</th>
                                                <th> </th>
                                                <th>Stage</th>
                                                <th>Client</th>
                                                <th>Stagiaire</th>
                                                <th>Cours</th>
                                                <th>Durée</th>
                                                <th>Solde heure	</th>
                                                <th>Solde après saisie	</th>
                                                <th>Date affectation</th>
                                                <th>Code Anom.</th>
                                                <th>Dates Cours</th>
                                                <th>Supports</th>
                        				</tr>
                                      </thead>
                                      
                                    </table>
                          </div>     
            </section>
        </div>
    </div>