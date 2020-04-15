function show(indice, indice2)
{
    if (document.getElementById(indice).style.display==="none") {	// Si la zone indiqué par indice est est invisible
        document.getElementById(indice).style.display = "block"; // On l'affiche
        document.getElementById(indice2).style.display = "none"; //On efface le lien
    }
    else									// Sinon (elle est donc visible)
        document.getElementById(indice).style.display="none";		//On la rend invisible
}