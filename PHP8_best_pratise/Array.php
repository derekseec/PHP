<?php

//1.A var maybe null before using foreach
//Warning: foreach() argument must be of type array|object, null given
foreach (is_array($maybeNull) ? $maybeNull : [] as $key => $item) {
    var_dump($item);
}

//2.var has to be a array before using count() min() max()
//Fatal error: Uncaught TypeError: max(): Argument #1 ($value) must be of type array, null given
$item = null;
$countNumber = count(var);
$minNumber = min(var);
$maxNumber = max(var);


//3.Remember count(null) = 0 works for PHP5,but not for PHP8
//In PHP5.6,the logic here, if $organizedFolder = null, it return $result = 1
$result = 0;
if(count($organizedFolder) <= 0) {
    $result = 1;
}
return $result;

//In PHP8,if just fix it fast, but not consider count(null) = 0
//it will make this code logic compete wrong , it return $result = 0
$result = 0;
if (!empty($organizedFolder) && is_array($organizedFolder)) {
    if(count($organizedFolder) <= 0) {
        $result = 1;
    }
}
return $result;

//Hard way to fix it in PHP8
$result = 0;
$countOrganizedFolder = [];
if (!empty($organizedFolder) && is_array($organizedFolder)) {
    $countOrganizedFolder = $organizedFolder ;
}
if (count($countOrganizedFolder) <= 0) {
    $result = 1;
}

return $result;

//Fast way to fix it in PHP8
$result = 0;
if(count((array)$organizedFolder) <= 0) {
    $result = 1;
}
return $result;
