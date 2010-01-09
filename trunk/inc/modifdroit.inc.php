<?php
if(isset($_SESSION['id']))
{	
	if(isset($_GET['idmem']))
	{
		$idok = base64_decode($_GET['idmem']) ;
		
		$autorisation = new Sql();
		
		$tab_autorisation = Tab($autorisation,'	SELECT *
												FROM droitbycategorie 
												WHERE membre_id = '.$idok.'');
		
		if(count($tab_autorisation) == 0)
		{
			echo 'aucune restriction' ;
		}
		else
		{
			foreach($tab_autorisation as $msg_autorisation)
			{
				if($msg_autorisation['membre_id'] == $idok)
				{
					echo 'restriction ok' ;
				}	
			}
		}
	}
}
?>