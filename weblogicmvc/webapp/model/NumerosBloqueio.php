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

        foreach ($numerosSelecionados as $numero){
            $this->numerosBloqueio[$numero] = true;
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