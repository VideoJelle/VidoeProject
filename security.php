<?php
	//session_start();	
	if ( !isset( $_SESSION['id']))
	{
		echo "<h5>U bent niet ingelogd en daarom niet bevoegd om deze pagina te bekijken. U wordt teruggestuurd naar de loginpagina.</h5>";
		header("refresh:5;url=index.php?content=login_form");
		exit();
	}
	else if ( !(in_array($_SESSION['userrole'], $userrole) ))
	{
		echo "<h5>U bent niet gemachtigd (te weinig rechten) en daarom niet bevoegd om deze pagina te bekijken. U wordt teruggestuurd naar uw homepagina.</h5>";
		header("refresh:5;url=index.php?content=".$_SESSION['userrole']."Homepage");
		exit();	
	}
	else
	{
        
	}
?>