<?php include("header.php") ?>



<?php
include("connexionBDD.php");
//verification si le mail existe deja

function MailDansBase($mail)
{
	require('connexionBDD.php');
	$req = $db->prepare('SELECT email FROM membre WHERE email = :email');
	$req->execute(array(':email'=>$mail));
  $doublon= $req->fetch();
  if($doublon) {//si le mail existe deja on envoi vrai 
    return false;
  };
  return true ;
}


	if(!empty($_POST['prenom']) and !empty($_POST['nom']) and !empty($_POST['mdp']) and !empty($_POST['email'])  ){
		$email= addslashes( $_POST['email']);
    $prenom = addslashes($_POST['prenom']);
    $nom= addslashes($_POST['nom']);
		$mdp= addslashes(hash('sha256',$_POST['mdp']));
		//echo "On est inscrit ";

		if(MailDansBase($email) ){
       $client= $db->query(" INSERT INTO membre(prenom,nom,email,mdp) VALUES ('$prenom','$nom','$email','$mdp')  ") ;
        header('Location: login.php');
		}
		else{
			echo"Mail déjà utilisé ou Mots de passes non identiques";
		}
  }
  

	?>


<section class="container">


<div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="mb-3">Créer un compte</h4>
      <form method="POST" action="register.php">
        <div class="row">
        <div class="mb-3 col-6">
          <label for="prenom">Prenom</label>
          <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Jean" required>
        </div>

        <div class="mb-3 col-6">
          <label for="nom">Nom</label>
          <input type="text" class="form-control" id="nom" name="nom" placeholder="DELARUE" required>
        </div>
          
        </div>

        <div class="mb-3">
          <label for="email">Votre mail</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="email" class="form-control" name="email" id="email" placeholder="votremail@exemple.com" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="mdp">Mot de passe</label>
          <input type="password" class="form-control" name="mdp" id="mdp" placeholder="*********" required>
          <span id="msg"></span> 
        </div>

        <div class="mb-3">
          <label for="confirmmdp">Retapez Mot de passe</label>
          <input type="password" class="form-control" id="confirmmdp" disabled placeholder="*********" >
        </div>

        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block envoyer"  type="submit">S'enregistrer</button>
      </form>

    </div>
  </div>

  <script>
console.log('dans le script');
var nom = document.getElementById("nom").value;
var prenom = document.getElementById("prenom").value;
alert(nom);
console.log('je recupere',nom);
function verif(event) { 
    var msg;
    console.log('dans la fonction');
    //le champ qu'on veut verifier 
     var str = document.getElementById("mdp").value;
    if (str.match( /[0-9]/g) && 
            str.match( /[A-Z]/g) && 
            str.match(/[a-z]/g) && 
            str.match( /[^a-zA-Z\d]/g) &&
            //str.match( /[]/g)&&
            //str.match()
            
            str.length >= 12)
            {
              if(str == nom or str == prenom)
              {
                event.preventDefault();
                return false;
              }
              else
              {
                return true;
              }
                
            }
    else 
    {
      console.log('dans le else');
      //btn btn-primary btn-lg btn-block
      event.preventDefault();


    }
  } 
    let formu = document.querySelector('.envoyer') ;
    console.log('salut',formu);
    formu.addEventListener('click',function(event){
      console.log('dans le click');
      verif(event);
    });

       

</script>
</section>

  <?php include("footer.php") ?>