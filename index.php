<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Globe</title>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="examples/GUI/dat.gui/dat.gui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="itowns.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <div id="titre">
          <h1>Neuilly-Plaisance, Ville d'exception</h1>
        </div>
        <!-- Formulaire 1 : Choix de la couche -->
    <form action="#" method="post" id="selectioncouche">

        <!-- Liste déroulante pour choisir le fichier json qu'on veut afficher -->
        <label for="choixcouche">Choisir une course</label> : <select name="fichiercouche" id="choixcouche">
          <!-- Option par défaut -->
          <option value="">---</option>
          <!-- Autres options ajoutées par scan du dossier contenant les json via php  -->
          <?php
          //Fonction qui pour une directory donnée comprenant un fichier de correspondance
          //entre le nom des fichiers et un nom qui leur est associé de type csv,
          //crée de nouvelles options dans la liste déroulante représentant les json de cette
          //directory avec leur nom associé dans le csv.
          function selec_JSON($csv_file,$JSON_dir){
            //Initialisation d'un dictionnaire
            $dict_csv = array();
            //Si le fichier de correspondance metadata.csv existe,
            if($csv = file('metadata.csv')) {
              //On parcourt ces lignes
              foreach ($csv as $value) {//Pour chacune d'elles,
                //On remplit le dictionnaire en séparant la ligne en 2
                //première partie nom du fichier => clef du dictionnaire
                //deuxième partie nom associé => valeur associé dans le dictionnaire
                $splitline = explode(";",$value);
                $dict_csv[$splitline[0]] = $splitline[1];
              }
            }
            //On définit la directory où sont placés les json
            if ($handle = opendir($JSON_dir)) {//si elle existe,
              //on parcourt tous les fichiers à l'intérieur
              while (false !== ($entry = readdir($handle))) {
                //on regarde l'extension du fichier en ne conservant que la deuxième partie
                //d'un split du nom du fichier
                $split_entry = explode(".",$entry);
                if ($split_entry[count($split_entry)-1] == "json"){//si l'extension est un json
                  //on regarde le nom associé dans le dictionnaire créé plus haut à partir du csv
                  if(($entryname = $dict_csv[$entry])) {//si ce nom existe (la clef nom du fichier en cours de traitement existe)
                    //on ajoute au html une option supplémentaire à la liste déroulante qui prend le nom associé au fichier dans le csv
                    echo "<option value=".$entry.">".$entryname."</option>";
                  }
                  else {//Si le nom du fichier est absent du dictionnaire
                    //on ajoute au html une option supplémentaire à la liste déroulante qui prend le nom du fichier
                    echo "<option value=".$entry.">".$entry."</option>";
                  }
                }
              }
              //Fermeture de la directory
              closedir($handle);
            }
          }
          //On applique cette fonction
          selec_JSON('metadata.csv','examples\layers\JSONLayers');
          ?>
        </select>
    </form>

        <div id="pause" style="visibility: hidden;"><input type="submit" id="pause_button" value="Pause"/></div>
        <br/><br/>

        <div id="viewerDiv"></div>
        <script src="examples/GUI/GuiTools.js"></script>
        <script src="itowns.js"></script>
        <script src="layer.js"></script>
        <script type="text/javascript">
            /* global itowns,document,GuiTools*/

            // Initial position
            var positionOnGlobe = { longitude: 2.506388888888889, latitude: 48.8619444, altitude: 5000 };

            // iTowns namespace defined here
            // Creation of the HTML DOM where the view will be initialized
            var viewerDiv = document.getElementById('viewerDiv');
            // Creation of the globe
            var globeView = new itowns.GlobeView(viewerDiv, positionOnGlobe);
            // Creation of the menu
            var menuGlobe = new GuiTools('menuDiv', globeView);
            menuGlobe.view = globeView;


            function addLayerCb(layer) {
                return globeView.addLayer(layer);
            }

            // Adding Layers
            var promises = []
            promises.push(itowns.Fetcher.json('examples/layers/JSONLayers/Ortho.json').then(addLayerCb));
            promises.push(itowns.Fetcher.json('examples/layers/JSONLayers/WORLD_DTM.json').then(addLayerCb));
            promises.push(itowns.Fetcher.json('examples/layers/JSONLayers/IGN_MNT_HIGHRES.json').then(addLayerCb));

            menuGlobe.addGUI('RealisticLighting', false,
                function(newValue) { globeView.setRealisticLightingOn(newValue); });

            // Adding layers in the menu
            Promise.all(promises).then(function () {
                menuGlobe.addImageryLayersGUI(globeView.getLayers(function (l) { return l.type === 'color'; }));
                menuGlobe.addElevationLayersGUI(globeView.getLayers(function(l) { return l.type === 'elevation'; }));
                console.info('menuGlobe initialized');
            }).catch( function (e) { console.error(e) });

            // Wait that the globe is well initialized, you should put your function in this event
            globeView.addEventListener(itowns.GLOBE_VIEW_EVENTS.GLOBE_INITIALIZED, function () {
                // eslint-disable-next-line no-console
                console.info('Globe initialized');
                /*
                ****************************
                ****************************
                CODE HERE
                CODE HERE
                CODE HERE
                ****************************
                ****************************
                */
            });



            window.globeView = globeView;

</script>
    </body>
</html>
