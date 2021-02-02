<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerPinturaPiramide extends Controller{

    const TIPO_TINTA_1 = 127.90;
    const TIPO_TINTA_2 = 258.98;
    const TIPO_TINTA_3 = 344.34;

    private function CalculoPinturaPiramide($fH, $fAb, $iTipoTinta){
        $informacoes[0] = $fAb;
        $informacoes[1] = $fH;
        $informacoes[2] = $this->calculoA1($fAb, $fH);
        $informacoes[3] = $this->calculoAreaTriangulo($fAb, $fH);
        $informacoes[4] = $this->calculoAreaTotal($fAb, $fH);
        $informacoes[5] = $this->calculoBase($fAb, $fH);
        $informacoes[6] = $iTipoTinta;
        $informacoes[7] = $this->calculoLitros($fAb, $fH);
        $informacoes[8] = $this->calculoLatas($fAb, $fH);
        $informacoes[9] = $this->calculoPreco($iTipoTinta, $fAb, $fH);
        $informacoes[10] = $this->volumePiramide($fAb, $fH);

        return $informacoes;
    }

    private function calculoA1($fAb, $fH){
        return sqrt(($fAb * $fAb) + ($fH * $fH));
    }

    private function calculoAreaTotal($fAb, $fH){
        return $this->calculoBase($fAb) + ($this->calculoAreaTriangulo($fAb, $fH) * 4);
    }

    private function calculoAreaTriangulo($fAb, $fH){
        return $fAb * $this->calculoA1($fAb, $fH);
    }

    private function calculoBase($fAb){
        return ($fAb * $fAb) * 4;
    }

    private function calculoLitros($fAb, $fH){
        return $this->calculoAreaTotal($fAb, $fH)/ 4.76;
    }

    private function calculoLatas($fAb, $fH){
        return ceil($this->calculoLitros($fAb, $fH)/18);
    }

    private function calculoPreco($iTipoTinta, $fAb, $fH){
        if($iTipoTinta == 1){
            return $this->calculoLatas($fAb, $fH) * self::TIPO_TINTA_1;
        }else if ($iTipoTinta == 2){
           return $this->calculoLatas($fAb, $fH) * self::TIPO_TINTA_2;
        }else{
            return $this->calculoLatas($fAb, $fH) * self::TIPO_TINTA_3;
        }
    }

    private function volumePiramide($fAb, $fH){
        return ($this->calculoBase($fAb) * $fH)/3;
    }

    public function retornoUsuario($fH, $fAb, $iTipoTinta){
        $informacoes = $this->CalculoPinturaPiramide($fH, $fAb, $iTipoTinta);
        $stringRetorno = '';

        $stringRetorno = 'AB: '             .$informacoes[0]  .'<br>'.
                         'H: '              .$informacoes[1]  .'<br>'.
                         'A1: '             .$informacoes[2]  .'<br>'.
                         'Área Triângulo: ' .$informacoes[3]  .'<br>'.
                         'Área Base: '      .$informacoes[4]  .'<br>'.
                         'Área Total: '     .$informacoes[5]  .'<br>'.
                         'Tipo de Tinta: '  .$informacoes[6]  .'<br>'.
                         'Litros: '         .$informacoes[7]  .'<br>'.
                         'Latas: '          .$informacoes[8]  .'<br>'.
                         'Preço: '          .$informacoes[9]  .'<br>'.
                         'Volume: '         .$informacoes[10] .'<br>';

        return $stringRetorno;
    }

}
