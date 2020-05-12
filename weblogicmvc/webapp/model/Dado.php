<?php


class Dado
{
    public function RolarDado(){
        $numero_dado = rand(1, 6);

        return $numero_dado;
    }
}