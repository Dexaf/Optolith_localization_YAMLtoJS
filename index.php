<?php
    /* check esistenza parametro */
    if(isset($_GET['lang']))
    {
        /* otteniamo la lingua passata via richiesta */
        $lang = $_GET['lang'];

        /* directory ai file, da cambiare nella messa online */
        $url = "C:/Users/Federico/Desktop/Data/";

        /* estrapoliamo la lista di file presenti dentro la directory associata alla lingua */
        $directory = $url.$lang."/";

        if(scandir($directory) == false)
        {
            echo ("Error directory isn't real");
        }
        else
        {
            $scanned_directory = array_diff(scandir($directory), array('..', '.'));
            $i = 0;
            $j = 0;
    
            /* cicliamo i file, per ognuno di essi ci salviamo il relativo nome e contenuto su due array diversi */
            foreach ($scanned_directory as &$value) 
            {
                $tmp = file_get_contents($url.$lang."/".$value);
                $arrayFile[$j] = $value;
                /* facciamo il parse del contenuto da yaml ad array */
                $arrayContent[$i] = yaml_parse($tmp);
                $i++;
                $j++;
            }
            $data = array();
            $data['FileName'] = $arrayFile;
            $data['FileContents'] = $arrayContent;
            /* codifichiamo tutto in json e mandiamo */
            echo json_encode($data);
        }
    }
    else
        echo("Error param not passed");

        

?>