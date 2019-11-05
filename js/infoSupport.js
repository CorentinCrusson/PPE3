function infoSupport(myselect){

	$.ajax({
   			type: "POST",
        			url: "ajax/recherche_informations_support.php",
        			dataType: "json",
			encode          : true,
        			data: "id_img="+myselect.options[myselect.selectedIndex].value, // on envoie via post l’id
        			success: function(retour) {
                displaySupport.style.visibility = "hidden";
                infoSupport.style.visibility = "visible";
            			$.each(retour, function(index, value)
            			 { // pour chaque noeud JSON
                		// on ajoute l option dans la liste
                    $("#titre").val(retour ["titreS"]);
                    $("#realisateur").val(retour ["realisateurS"]);
                    $("#genre").val(retour ["libelleG"]);
                  });
   					},
   			error: function(jqXHR, textStatus)
			{
			// traitement des erreurs ajax
     			if (jqXHR.status === 0){alert("Not connect.n Verify Network.");}
    			else if (jqXHR.status == 404){alert("Requested page not found. [404]");}
				else if (jqXHR.status == 500){alert("Internal Server Error [500].");}
				else if (textStatus === "parsererror"){alert("Requested JSON parse failed.");}
				else if (textStatus === "timeout"){alert("Time out error.");}
				else if (textStatus === "abort"){alert("Ajax request aborted.");}
				else{alert("Uncaught Error.n" + jqXHR.responseText);}
			}
   				});
}
