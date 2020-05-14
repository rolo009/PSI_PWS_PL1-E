<?php

class NumerosBloqueio
{
    Public $numerosBloqueio = [1, 2, 3, 4, 5, 6, 7, 8, 9];

    public function iniciar(){

        for ($i = 0; $i <= 9; $i++) {
            $numerosBloqueio[$i] = false;
            return $this->numerosBloqueio;
        }
    }

    public function bloquearNumeros($numeroSelecionado){
        $numero = $numeroSelecionado;

        for ($i = 0; $i <= 9; $i++) {
            if($numerosBloqueio[$i] = $numero) {
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