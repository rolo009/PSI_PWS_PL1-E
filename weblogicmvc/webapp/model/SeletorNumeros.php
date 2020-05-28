<?php


class seletorNumeros
{
    private $numerosSelecionados;
    private $userNumber;
    public function validateNumber($userNumber, $numerosBloqueio){
        if($numerosBloqueio[$userNumber] == true){
            return false;
        }
        else{
            return true;
        }
    }

    public function updateSelection($userNumber){
        if(in_array($userNumber, $this->numerosSelecionados) == true){
            //Eliminar o usernumber do vetor this ->numerosSelecionados
            array_splice($this->numerosSelecionados, $userNumber);

        }
        else{
            array_push($this->numerosSelecionados, $userNumber);
        }
    }

    public function checkSelectionTotal($totalDados){
        $soma = 0;

        foreach ($this->numerosSelecionados as $numero){
            $soma+=$numero;
        }

        if($soma == $totalDados){
            return true;
        }
        else{
            return false;
        }
    }

    public function clearSelection(){
        //Remover todos os elementos do vetor this->numerosSelecionados

    }

    public function selectionHasNumber($number){
        //Usar este metodo na vista, para sabermos qual o link a colocar no botão
        return in_array($number, $this->numerosSelecionados);
    }
}