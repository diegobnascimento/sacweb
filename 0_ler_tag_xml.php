<?php
$xmlstr = file_get_contents('nfe.xml'); 
$sxe = new SimpleXMLElement($xmlstr);

foreach ($sxe as $pai)
{
    echo nl2br($pai->getName() ."\n");
    $tags[]=$pai->getName();
    foreach ($pai->children() as $filho1){
        echo nl2br(str_repeat('&nbsp;', 3).$filho1->getName() ."\n");
        $tags[]=$filho1->getName();
        foreach ($filho1->children() as $filho2){
            echo nl2br(str_repeat('&nbsp;', 6).$filho2->getName() ."\n");
            $tags[]=$filho2->getName();
            foreach ($filho2->children() as $filho3){
                echo nl2br(str_repeat('&nbsp;', 9).$filho3->getName() ."\n");
                $tags[]=$filho3->getName();
                foreach ($filho3->children() as $filho4){
                    echo nl2br(str_repeat('&nbsp;', 12).$filho4->getName() ."\n");
                    $tags[]=$filho4->getName();
                    foreach ($filho4->children() as $filho5){
                        echo nl2br(str_repeat('&nbsp;', 15).$filho5->getName() ."\n");
                        $tags[]=$filho5->getName();
                        foreach ($filho5->children() as $filho6){
                            echo nl2br(str_repeat('&nbsp;', 18).$filho6->getName() ."\n");
                            $tags[]=$filho6->getName();
                        }
                    }
                }
            }
        }
    }
}
echo '########### LENDO ARRAY ############';
foreach ($tags as $key => $tag) { 
        echo  $tag."<br/>";
}
?>