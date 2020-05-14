<?php


class Dado
{
    public function rolarDado(){
        $numero_dado = rand(1, 6);

        return $numero_dado;
    }
}