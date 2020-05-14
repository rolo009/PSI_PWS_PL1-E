<?php

class NumerosBloqueio
{
    Public $numerosBloqueio = [1, 2, 3, 4, 5, 6, 7, 8, 9];

    public function iniciar(){

        for ($i = 0; $i <= 9; $i++) {
            $numerosBloqueio[$i] = false;
        }
    }

    public function bloquearNumeros(){
        for ($i = 0; $i <= 9; $i++) {
            if($numerosBloqueio[$i] = false) {
                $numerosBloqueio[$i] = true;
            }
            else{
                echo "Número já selecionado!";
            }
        }
    }

    public function checkFinalJogada(){

    }

    public function getFinalPointSum(){

    }
}