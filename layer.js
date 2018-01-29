var chemin = 'D:/ITOWNS/examples/layers/JSONLayers'
var selection = document.getElementById("formulaire2");


// function check_vitesse(){
//   var radios = document.getElementsByName('Layer'); //liste des 3 boutons
//
//   for(var i = 0; i < radios.length; i++){
//     if(radios[i].checked){ //On ouvre les couche cochées
//       var layer = radios[i].value;
//       radios[i].checked = false;
//       return layer;
//     }
//   }
// }
// function valide(event){
//
//   ajax.addEventListener('readystatechange', function(e){
//     if(ajax.readyState == 4 && ajax.status == 200 ){
//       //remplissage du tableau avec les données du fichier JSON
//       selected = JSON.parse(ajax.responseText);
//       console.log("pep");
//
//       viewerDiv.setView(49,27);
//
//       viewerDiv.fitBounds(trajet.getBounds());
//       //map.addLayer(trajet);
//     }
//   })

//   ajax.send();
//   }

$("#formulaire2").submit(function(event){
  event.preventDefault();
  $file = $("#choixcouche").val();
  console.log($file);
})
