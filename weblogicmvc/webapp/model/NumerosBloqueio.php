<?php



class NumerosBloqueio
{
    Public $numerosBloqueio = [1, 2, 3, 4, 5, 6, 7, 8, 9];
    public $seletorNumeros;

    public function __construct(){
        $this->seletorNumeros = new seletorNumeros();

    }

    public function iniciar(){

        for ($i = 0; $i <= 9; $i++) {
            $numerosBloqueio[$i] = false;
            return $this->numerosBloqueio;
        }
    }

    public function bloquearNumeros($numerosSelecionados, $somaDados){

        for ($i = 0; $i < 9; $i++) {
            for ($j = 0; $j < 2; $j++) {
                if ($numerosBloqueio[$i] = $numerosSelecionados[$j]) {
                    $numerosBloqueio[$i] = true;
                }
                else{
                    echo "Número já selecionado!";
                }
            }
        }
    }

    public function checkFinalJogada(){

    }

    public function getFinalPointSum(){

    }


}