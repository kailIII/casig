<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Factures</title>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"/></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>

</head>
<body>	
<?php
	include_once("./inc_facture/header_facture.inc.php");
?>
<style type="text/css" media="screen">
			.containing-element .ui-slider-switch { width: 15em;}
</style>
<div id="mil" data-role="content-secondary">

</div>
<div id="div_choix_option" data-role="collapsible-set" data-theme="b" data-content-theme="f">
	
</div>
<div id="div_resultat" data-role="content">

</div>

<script type="text/javascript">

chercher_millesime();
afficher_options();

chercher_millesime();
function chercher_millesime(){
	$.ajax({
  type: 'POST',
  url: 'ajax_facture.php',
  data: {
    action: 'cocher_millesime'
  },
  success : function(data){
  	var obj = jQuery.parseJSON(data);
    var row = obj[0];
  	buffer='<h4>Millésime courant : '+ row[1] + '</h4>';
  	$('#mil').html(buffer);
	$('#mil').trigger('create');
  }
  });
}
function afficher_options(){
	$.ajax({
		type: 'POST',
		url: 'ajax_facture.php',
			data: {
			action: 'liste_statut'
		},
		success : function(data){
			
			buffer= '<ul data-role="listview" data-theme="c" data-inset="true" data-dividertheme="f" >';
			buffer=buffer + '<li data-role="list-divider">Choix du statut</li>';
			var obj = jQuery.parseJSON(data);
			for(i=0;i<obj.length;i++){
				var tmp=obj[i];
				buffer=buffer + '<li><a href="#" data-inline="true" onclick="afficher_liste_facture(' + tmp[0] + ')" >' + tmp[1] + '</a></li>';
				
										}
			buffer=buffer + '</ul>';
		
			$('#div_choix_option').html(buffer);
			$('#div_choix_option').trigger('create');	
			
			}
		});
}
function afficher_liste_facture(idstatut)
	{
		$.ajax({
			type: 'POST',
			url: 'ajax_facture.php',
			datatype: 'json',
			data: {
				action : 'info_facture_statut',
				idstatut : idstatut
			},
			success : function(data){
				
				
				buffer2= '<h4>Listes des factures : </h4>';
				buffer2=buffer2 + '<div data-role="fieldcontain" >';
				buffer2=buffer2 + '<fieldset data-role="controlgroup" data-mini="true" >';
				var obj = jQuery.parseJSON(data);
				for(i=0;i<obj.length;i++){
				var tmp=obj[i];
				buffer2=buffer2 + '<input type="checkbox" name="ch" id="ch' + tmp[0] + '" value="' + tmp[0] + '" class="custom"/>';
				buffer2=buffer2 + '<label for="ch' + tmp[0] + '">'+ tmp[1] + ' ('+ tmp[2] + ', ' + tmp[3] + ')</label>';
				}
				buffer2=buffer2 + '</fieldset>';
				buffer2=buffer2 + '</div>';
				buffer2=buffer2 +'<div data-role="fieldcontain" id="r">';
		buffer2=buffer2 + '<fieldset data-role="controlgroup" data-type="horizontal"  id="f1">';		
		buffer2=buffer2 + '<input type="radio" name="radio-view" id="radio-view-a" value="1"   />';
		buffer2=buffer2 + '<label for="radio-view-a">En Attente</label>';
		buffer2=buffer2 + '<input type="radio" name="radio-view" id="radio-view-b" value="2"  />';
		buffer2=buffer2 + '<label for="radio-view-b">Traitée</label>';
		buffer2=buffer2 + '<input type="radio" name="radio-view" id="radio-view-c" value="5"  />';
		buffer2=buffer2 + '<label for="radio-view-c">Erreur</label>';
		buffer2=buffer2 + '</fieldset>';
		buffer2=buffer2 + '</div>';		
		$('#div_resultat').html(buffer2);
		$('#div_resultat').trigger('create');
					// Définit l'evenement
		$('#r').change(function(){
		$('input[type=checkbox][name=ch]:checked').each(function(){
			
			afficher_resultat_recherche($(this).val());
			
		})
		});
		
	
			}
		});
	}

function afficher_resultat_recherche(idep){
		$.ajax({
			type: 'POST',
			url: 'ajax_facture.php',
			datatype: 'json',
			data: {
				action: 'test',
				idep : idep,
				idstatut : $('input[type=radio][name=radio-view]:checked').attr('value')
			},
			success : function(data){
			afficher_liste_facture($('input[type=radio][name=radio-view]:checked').attr('value'));
			}
		})
	}	

				
</script>
<?php
	include_once("../inc_footer.php/footer_cda.inc.php");
?>	
</body>
</html>