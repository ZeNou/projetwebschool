<?php

### iNFOS SERVEUR MySQL
define("cfgServeur", "localhost");
define("cfgBdd", "dizsurf");
define("cfgLogin", "root");
define("cfgPass", "bambou");

### TABLES MySQL
define("tblmembres", "membres");

### iNCLUDES

include_once(dirname(__FILE__). '/../class/db.class.php');
include_once(dirname(__FILE__). '/fonctions.php');

### LiMiTATiONS
define('limHistoriqueParPages',10);
define('limSitesParPages',10);


?>