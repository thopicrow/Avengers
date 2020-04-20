function show(indice, indice2)
{
    if (document.getElementById(indice).style.display==="none") {	// Si la zone indiqué par indice est est invisible
        document.getElementById(indice).style.display = "block"; // On l'affiche
        document.getElementById(indice2).style.display = "none"; //On efface le lien
    }
    else									// Sinon (elle est donc visible)
        document.getElementById(indice).style.display="none";		//On la rend invisible
}

function showLieu(indice) {
    if (document.getElementById(indice).style.display === "none") {	// Si la zone indiqué par indice est est invisible
        document.getElementById(indice).style.display = "block"; // On l'affiche
    }
}

function afficherAdresse() {
    var idLieu = $('#sortie_lieu option:selected').attr('value');
    console.log(idLieu);
    var URL;
    URL = "http://localhost:8000/sortie/add";

    $.ajax(
        {
            url: URL,
            method: "POST",
            data: {id : idLieu},
            success : function (response) {
                console.log(response);
            },
            error : function () {
                console.log("Erreur");
            }
        }
    )


}