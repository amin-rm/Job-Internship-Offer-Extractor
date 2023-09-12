function verif()
{
    nom=f.nom.value
    var i
    if(nom=="")
    {
        alert("Nom ne doit pas etree vide")
        return false
    }
    for(i=0;i<nom.length;i++)
    {
        if(nom.charAt(i).toUpperCase()<'A' || nom.charAt(i).toUpperCase()>'Z')
        {
            alert("Nom doit etre alphabétique")
            return false
        }
    }
    prenom=f.prenom.value

    if(prenom=="")
    {
        alert("Prenom ne doit pas etree vide")
        return false
    }

    for(i=0;i<prenom.length;i++)
    {
        if(prenom.charAt(i).toUpperCase()<'A' || prenom.charAt(i).toUpperCase()>'Z')
        {
            alert("Prenom doit etre alphabétique")
            return false
        }
    }
    email=f.email.value

    if (email === "") 
    {
        alert("L'email ne doit pas être vide");
        return false;
    }
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) 
    {
        alert("L'email n'est pas valide");
        return false;
    }
    msg=f.message.value
    if(msg=="")
    {
        alert("Veuillez saisir votre message")
        return false
    }

    return true
}

function validateForm() {
    var username = document.forms["fsgn"]["username"].value;
    var nom = document.forms["fsgn"]["nom"].value;
    var prenom = document.forms["fsgn"]["prenom"].value;
    var email = document.forms["fsgn"]["email"].value;
    var password = document.forms["fsgn"]["password"].value;
    var confirmPassword = document.forms["fsgn"]["confirm_password"].value;

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
    var errorMessages = document.getElementsByClassName("error-message");
    for (var i = 0; i < errorMessages.length; i++) {
      errorMessages[i].innerHTML = "";
    }
    if (username === "") {
      document.getElementById("username-error").innerHTML = "Veuillez entrer un nom d'utilisateur.";
      return false;
    }
  
    if (nom === "") {
      document.getElementById("nom-error").innerHTML = "Veuillez entrer votre nom.";
      return false;
    }
  
    if (prenom === "") {
      document.getElementById("prenom-error").innerHTML = "Veuillez entrer votre prénom.";
      return false;
    }
  
    if (!emailRegex.test(email)) {
      document.getElementById("email-error").innerHTML = "Veuillez entrer une adresse e-mail valide.";
      return false;
    }
    if (password !== confirmPassword) 
    {
      document.getElementById("confirm-password-error").innerHTML = "Les mots de passe saisis ne correspondent pas.";
      return false;
    }
    return true;
  }