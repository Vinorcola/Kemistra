


function manageSubForm($element)
{
    // Initialisation du nombre de sous-formulaires.
    var nbSubForm = $element.children('div').size();
    
    if (nbSubForm != 0)
    {
        $element.children('div').each(function()
        {
            createDeleteButton($(this));
        });
    }
    
    
    
    // Ajout d'un bouton d'ajout de sous-formulaire.
    createAddButton($element);
    
    
    
    function addSubForm($element)
    {
        // Création du prototype.
        // Récupération du contenu de l'attribut data-prototype et remplacement des chaînes necessaires.
        var $prototype = $($element.attr('data-prototype').replace(/__name__label__/g, '')
                                                          .replace(/__name__/g, nbSubForm));
        // Ajout d'un bouton de suppression de sous-formulaire.
        createDeleteButton($prototype);
        
        // Ajout du prototype à la fin de l'élément.
        $element.append($prototype);
        
        // Incrémentation du nombre de sous-formulaires.
        nbSubForm++;
    }
    
    
    
    function createAddButton($element)
    {
        // Création d'un bouton d'ajout.
        var $button = $('<a href="#" id="ajout_typeresultat" class="btn">Ajouter</a>');
        
        // Ajout du bouton au début de la balise concernée.
        $element.prepend($button);
        
        // Ajout de l'action à exécuter lors du clic.
        $button.click(function(e)
        {
            addSubForm($element);
            e.preventDefault();
            return false;
        });
    }
    
    
    
    function createDeleteButton($element)
    {
        // Création d'un bouton de suppression.
        var $button = $('<a href="#" class="btn btn-danger">Supprimer</a>');
        
        // Ajout du bouton à la fin de la balise concernée.
        $element.append($button);
        
        // Ajout de l'action à exécuter lors du clic.
        $button.click(function(e)
        {
            $element.remove();
            e.preventDefault();
            return false;
        });
    }
}





function addResultatSubForm($element,
                            numero,
                            label,
                            unite,
                            typeResultat)
{
    // Création du prototype.
    // Récupération du contenu de l'attribut data-prototype et remplacement des chaînes necessaires.
    var $prototype = $($element.attr('data-prototype').replace(/__name__label__/g, '')
                                                      .replace(/__name__/g, numero)
                                                      .replace(/__result_label__/g, label));
    
    // Ajout du prototype à la fin de l'élément.
    $element.append($prototype);
    
    // Ajout du type de résultat.
    $('input#kemistra_mainbundle_analysetype_resultats_' + numero).val(typeResultat);
    
    // Ajout de l'unité.
    $('div#kemistra_mainbundle_analysetype_resultats_' + numero + ' > div').append('<span class="unite">' + unite + '</span>');
}





function addConsommableSubForm($element,
                               numero,
                               label,
                               unite,
                               typeConsommable)
{
    // Création du prototype.
    // Récupération du contenu de l'attribut data-prototype et remplacement des chaînes necessaires.
    var $prototype = $($element.attr('data-prototype').replace(/__name__label__/g, '')
                                                      .replace(/__name__/g, numero)
                                                      .replace(/__consom_label__/g, label));
    
    // Ajout du prototype à la fin de l'élément.
    $element.append($prototype);
    
    // Ajout du type de résultat.
    $('input#kemistra_mainbundle_analysetype_consommables_' + numero).val(typeConsommable);
    
    // Ajout de l'unité.
    $('div#kemistra_mainbundle_analysetype_consommables_' + numero + ' > div').append('<span class="unite">' + unite + '</span>');
}


