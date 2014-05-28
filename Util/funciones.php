<?php
    function getCodigo($size, $cont, $prefix) {
        $codigo = $prefix;
        $n_cont = strlen($cont);
        $n_zero = $size - $n_cont;
        for($i = 0; $i < $n_zero - 1; $i++)
            $codigo .= "0";
        $codigo .= $cont;
        return $codigo; 
    }
?>