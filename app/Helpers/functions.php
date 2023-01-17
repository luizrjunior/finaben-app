<?php

if (!function_exists('retornaValorAntigo')) {

    /**
     * Retornar Valor Antigo da Variavel
     * @param $variavel
     * @param $atributo
     * @return mixed
     */
    function retornaValorAntigo($variavel, $atributo)
    {
        if (old($atributo) != "") {
            $variavel = old($atributo);
        }
        return $variavel;
    }
}

if (!function_exists('numberFormatFinaBen')) {

    /**
     * Formatar Numero AppMatic
     * @param type $valor
     * @return type
     */
    function numberFormatFinaBen($valor)
    {
        if (strstr($valor, '.')) {
            $valor = number_format($valor, 2, ",", ".");
            $n = explode(',', $valor);
            if (count($n) > 1) {
                if (strlen($n[1]) == 1) {
                    $valor = $n[0] . "," . $n[1] . "0";
                }
            }
        } else {
            $valor = number_format($valor, 2, ",", ".");
        }
        return $valor;
    }
}



