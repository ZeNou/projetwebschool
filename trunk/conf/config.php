<?php

### iNFOS SERVEUR MySQL
define("cfgServeur", "localhost");
define("cfgBdd", "projetweb");
define("cfgLogin", "root");
define("cfgPass", "");

### TABLES MySQL
define("tblmembres", "membre");

### iNCLUDES

include_once(dirname(__FILE__). '/../class/db.class.php');
include_once(dirname(__FILE__). '/fonctions.php');

### LiMiTATiONS
define('limHistoriqueParPages',10);
define('limSitesParPages',10);


?>