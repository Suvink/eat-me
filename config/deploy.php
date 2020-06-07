<php

function execPrint($command){
    $result = array();
    exec($command, $result);
    foreach($result as $line){
        print($line."\n");
    }
}
print("<pre>". execPrint("git pull")."</pre>");

?>