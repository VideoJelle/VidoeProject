<?php
	//session_start();	
	if ( !isset( $_SESSION['id']))
	{
		//var_dump($_SESSION);
		echo "<h3 style='text-align: center;' >U bent niet ingelogd en daarom niet bevoegd om deze pagina te bekijken. U wordt teruggestuurd naar de loginpagina.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
		header("refresh:5;url=index.php?content=inloggen_Registreren");
		exit();
	}
	else if ( !(in_array($_SESSION['userrole'], $userrole) ))
	{
		echo "<h3 style='text-align: center;' >U bent niet gemachtigd (te weinig rechten) en daarom niet bevoegd om deze pagina te bekijken. U wordt teruggestuurd naar uw homepagina.</h3><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
		header("refresh:5;url=index.php?content=".$_SESSION['userrole']."Homepage");
		exit();	
	}
	else
	{
        
	}
?>