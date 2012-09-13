<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Activité</title>
	<link rel="shortcut icon" href="../img/mobile/favicon.png" />
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<link rel="stylesheet" href="../css/jqm-docs.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>

</head>

<body>	
<div data-role="dialog">
<div data-role="header" data-theme="f">
			<h1>Détail</h1>
</div>
	<div id="div_lsite" data-role="content">
	
	</div>
</div>
<script type="text/javascript">
	
					
  			afficher_resultat_recherche(getUrlParameter('millesime'),getUrlParameter('mois'));

    function afficher_resultat_recherche(millesime,mois){
	
		$.ajax({
			type: 'POST',
			url: 'ajax_activite.php',
			datatype: 'json',
			data: {
				action: 'compte_rendu_horaire',
				millesime : millesime,
				mois : mois
			},
			success : function(data){
				buffer2='<div data-role="fieldcontain" id="a">';
				buffer2=buffer2 +'<h3>Activités : '+ mois +' ' + millesime +'</h3>';
				buffer2=buffer2 + '<ul data-role="listview" data-theme="c" data-divider-theme="e" data-inset="true" >';
				
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
					var tmp=obj[i];
					
					buffer2=buffer2 + '<li data-role="list-divider">' + tmp[0] + '<span class="ui-li-count">' + tmp[1] + '</span></li>';
					buffer2=buffer2 + '<li>';
					buffer2=buffer2 + '<p>Activité : ' + tmp[2] + '</p>';
					buffer2=buffer2 + '</li>';
				} 
				buffer2=buffer2 + '</ul>';
				buffer2=buffer2 + '</div>';
				$('#div_lsite').html(buffer2);
				$('#div_lsite').trigger('create');
			}
		})
	}
	
	
	function getUrlParameter(name) 
{
     var searchString = location.search.substring(1).split('&');
 
    for (var i = 0; i < searchString.length; i++) {
 
        var parameter = searchString[i].split('=');
        if(name == parameter[0])    return parameter[1];
 
    }
 
    return false;
}
	</script>

</body>
</html>