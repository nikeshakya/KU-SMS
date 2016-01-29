<?php

	function CustSort(array &$array) {
        $length=count($array);
        for ($i=1;$i<$length;$i++) {
            $element=$array[$i];
            $j=$i;
            while($j>0 && $array[$j-1]->start_time > $element->start_time) {
                //move value to right and key to previous smaller index
                $array[$j]=$array[$j-1];
                $j=$j-1;
                }
            //put the element at index $j
            $array[$j]=$element;
            }
        return $array;
    }

?>
