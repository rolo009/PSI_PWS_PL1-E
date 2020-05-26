<?php



class NumerosBloqueio
{
    Public $numerosBloqueio;
    public $seletorNumeros;

    public function __construct(){
        $this->seletorNumeros = new seletorNumeros();
        $this->iniciar();
    }

    public function iniciar(){

        $this->numerosBloqueio['1'] = false;
        $this->numerosBloqueio['2'] = false;
        $this->numerosBloqueio['3'] = false;
        $this->numerosBloqueio['4'] = false;
        $this->numerosBloqueio['5'] = false;
        $this->numerosBloqueio['6'] = false;
        $this->numerosBloqueio['7'] = false;
        $this->numerosBloqueio['8'] = false;
        $this->numerosBloqueio['9'] = false;

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

    public function getNumerosBloqueio(){
        return $this->numerosBloqueio;
    }

    public function checkFinalJogada(){

    }

    public function getFinalPointSum(){

    }


}