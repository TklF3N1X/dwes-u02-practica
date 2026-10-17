
<?php

function getDeck(): array
{
    $deck = [];
    $suits = ['corazones', 'picas', 'rombos', 'treboles'];
    $suitsred = ['cor', 'pic', 'rom', 'tre'];

    for ($i = 0; $i < count($suits); $i++) {
        for ($numero = 1; $numero <= 13; $numero++) {
            if ($numero == 1) {
                $valor = 'A';
                $imagen = '1';
            } elseif ($numero >= 2 && $numero <= 10) {
                $valor = $numero;
                $imagen = $numero;
            } elseif ($numero == 11) {
                $valor = 'J';
                $imagen = 'j';
            } elseif ($numero == 12) {
                $valor = 'Q';
                $imagen = 'q';
            } else {
                $valor = 'K';
                $imagen = 'k';
            }

            $carta = [
                'suit' => $suits[$i],
                'value' => $valor,
                'image' => $suitsred[$i] . '_' . $imagen . '.png'
            ];

            $deck[] = $carta;
        }
    }

    $deck[] = [
        'suit' => 'comodines',
        'value' => 'JOKER',
        'image' => 'jok_1.png'
    ];

    $deck[] = [
        'suit' => 'comodines',
        'value' => 'JOKER',
        'image' => 'jok_2.png'
    ];

    return $deck;
}
