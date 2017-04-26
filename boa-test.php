<?php

include __DIR__.DIRECTORY_SEPARATOR."boa.php";

function kiyasla($str1, $str2) {
    $result = '';
    for ($i = 0; $i < strlen($str2); $i++) {
        $c1 = $str1[$i];
        $c2 = $str2[$i];
        //echo "$c1 - $c2<br>";
        if ($c1 == $c2) {
            
            $result .= '<font color="red">' . $c2 . '</font>';
        } else {
            
            $result .= $c2;
        }
        
        
    }
    return $result;
}


echo "<pre>";
$first = BOA::hash('0');
for ($i = 0; $i < 10000; $i++) {
    $x = dechex($i);
    echo "boa(".str_pad(strval($x) . ")= ", 6, " ", STR_PAD_LEFT);
    echo kiyasla($first, BOA::hash(strval($x)));
    echo "<br>";
}
echo "</pre>";
