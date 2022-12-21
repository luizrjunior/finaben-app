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

