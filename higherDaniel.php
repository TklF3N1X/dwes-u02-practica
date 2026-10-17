<?php

require_once 'getdeck.php';

$baraja = getDeck();
shuffle($baraja);

$jugador1 = [];
$jugador2 = [];

for ($i = 0; $i < 10; $i++) {
    $jugador1[] = array_pop($baraja);
    $jugador2[] = array_pop($baraja);
}

function valorCarta(array $carta): int
{
    if ($carta['value'] == 'A') {
        return 1;
    } elseif ($carta['value'] == 'J') {
        return 11;
    } elseif ($carta['value'] == 'Q') {
        return 12;
    } elseif ($carta['value'] == 'K') {
        return 13;
    } else {
        return (int) $carta['value'];
    }
}

$puntosJugador1 = 0;
$puntosJugador2 = 0;

$enfrentamientos = [];

for ($i = 0; $i < 10; $i++) {

    $carta1 = $jugador1[$i];
    $carta2 = $jugador2[$i];

    $comodin1 = ($carta1['suit'] == 'comodines');
    $comodin2 = ($carta2['suit'] == 'comodines');

    $valor1 = valorCarta($carta1);
    $valor2 = valorCarta($carta2);

    $puntos1 = 0;
    $puntos2 = 0;
    $resultado = '';

    if ($comodin1 && $comodin2) {
        $puntos1 = -2;
        $puntos2 = -2;
        $resultado = 'Ambos tienen comodín.';

    } elseif ($comodin1) {
        $puntos1 = 2;
        $puntos2 = -1;
        $resultado = 'El jugador 1 tiene comodín.';

    } elseif ($comodin2) {
        $puntos1 = -1;
        $puntos2 = 2;
        $resultado = 'El jugador 2 tiene comodín.';

    } elseif ($valor1 == $valor2) {
        $puntos1 = 1;
        $puntos2 = 1;
        $resultado = 'Las dos cartas tienen el mismo valor.';

    } elseif ($valor1 > $valor2) {
        $puntos1 = 2;
        $resultado = 'Gana el jugador 1.';

    } else {
        $puntos2 = 2;
        $resultado = 'Gana el jugador 2.';
    }

    $puntosJugador1 += $puntos1;
    $puntosJugador2 += $puntos2;

    $enfrentamientos[] = [
        'carta1' => $carta1,
        'carta2' => $carta2,
        'puntos1' => $puntos1,
        'puntos2' => $puntos2,
        'resultado' => $resultado
    ];
}

if ($puntosJugador1 > $puntosJugador2) {
    $ganador = '¡Gana el jugador 1!';
} elseif ($puntosJugador2 > $puntosJugador1) {
    $ganador = '¡Gana el jugador 2!';
} else {
    $ganador = 'La partida termina en empate.';
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Higher | Juegos de cartas</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/cabecera.php';
    ?>

    <main class="contenedor">

        <section class="presentacion">

            <p class="etiqueta">Juego de cartas</p>

            <h1>Higher</h1>

            <p class="descripcion">
                Compara las cartas de los dos jugadores
                y consigue la mayor puntuación.
            </p>

        </section>

        <section class="partida-higher">

            <h2>Enfrentamientos</h2>

            <?php foreach ($enfrentamientos as $i => $ronda): ?>

                <div class="ronda-higher">

                    <h3>Enfrentamiento <?= $i + 1 ?></h3>

                    <div class="cartas-higher">

                        <div class="carta-higher">

                            <p>Jugador 1</p>

                            <img
                                src="img/<?= htmlspecialchars($ronda['carta1']['image']) ?>"
                                alt="Carta del jugador 1"
                            >

                            <p class="puntos-carta">
                                Puntos: <?= $ronda['puntos1'] ?>
                            </p>

                        </div>

                        <div class="versus-higher">VS</div>

                        <div class="carta-higher">

                            <p>Jugador 2</p>

                            <img
                                src="img/<?= htmlspecialchars($ronda['carta2']['image']) ?>"
                                alt="Carta del jugador 2"
                            >

                            <p class="puntos-carta">
                                Puntos: <?= $ronda['puntos2'] ?>
                            </p>

                        </div>

                    </div>

                    <p class="resultado-higher">
                        <?= htmlspecialchars($ronda['resultado']) ?>
                    </p>

                </div>

            <?php endforeach; ?>

        </section>

        <section class="puntuacion-higher">

            <h2>Resultado final</h2>

            <p>
                Jugador 1: <?= $puntosJugador1 ?> puntos
            </p>

            <p>
                Jugador 2: <?= $puntosJugador2 ?> puntos
            </p>

            <h3><?= htmlspecialchars($ganador) ?></h3>

        </section>

    </main>

    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
    ?>

</body>
</html>