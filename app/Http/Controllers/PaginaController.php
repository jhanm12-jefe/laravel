<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginaController extends Controller
{
    public function inicio()
    {
        return view('inicio');
    }
    public function contacto()
    {
        return view('contacto');
    }
    public function formMayor()
    {
        return view('mayor');
    }

    public function calcularMayor(Request $request)
    {

        $a = $request->a;
        $b = $request->b;
        $c = $request->c;

        $mayor = $a;

        if ($b > $mayor) {
            $mayor = $b;
        }

        if ($c > $mayor) {
            $mayor = $c;
        }

        return view('welcome', [
            'mayor' => $mayor
        ]);
    }

    public function formPrimo()
    {
        return view('primo');
    }

    public function verificarPrimo(Request $request)
    {

        $num = $request->numero;
        $esPrimo = true;

        if ($num <= 1) {
            $esPrimo = false;
        }

        for ($i = 2; $i < $num; $i++) {
            if ($num % $i == 0) {
                $esPrimo = false;
                break;
            }
        }

        return view('welcome', [
            'esPrimo' => $esPrimo,
            'num' => $num
        ]);
    }
}
