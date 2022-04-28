<?php 

function executeRequete($req){
    global $mysqli;
    //print_r($req);
    $résultat  = $mysqli->query($req);
    if(!$résultat) //
        {
            die("Erreur  sur  la  requete  sql.<br>Message  :  " . $mysqli->error. "<br>Code: ". $req);
        }
    return $résultat; //
    }

    function debug($var, $mode=  1)
    {
        echo'<div  style="background:  orange;  padding:  5px;  float:  right;  clear:  both;  ">';
        $trace=  debug_backtrace();
        $trace= array_shift($trace);
        echo'Debug  demandé  dans  le  fichier  :  $trace[file]  à  la  ligne  $trace[line].';
        if($mode===  1)
            {
                echo'<pre>';  print_r($var); echo'</pre>';
            }
            else
            {
                echo'<pre>';  var_dump($var); echo'</pre>';
            }
            echo'</div>';
    }
    //------------------------------------
    function internauteEstConnecte()
    {
        if(!isset($_SESSION['membres'])) return false;
        else return true;
    }
    //------------------------------------
    function internauteEstConnecteEtEstAdmin()
    {
        if(internauteEstConnecte()  && $_SESSION['membres']['statut']  ==  1) return true;
        else return false;
    }

?>