
<?php

require_once 'getdeck.php';

$baraja = getDeck();

array_pop($baraja);
array_pop($baraja);

shuffle($baraja);

$banca = [];

$jugadores = [
    [],
    [],
    [],
    [],
    []
];

for ($ronda = 0; $ronda < 2; $ronda++) {
    $banca[] = array_pop($baraja);

    for ($i = 0; $i < 5; $i++) {
        $jugadores[$i][] = array_pop($baraja);
    }
}


function calcularPuntosBlackjack(array $cartas): int {
    $puntos = 0;
    $hayAs = false;

    for ($i = 0; $i < count($cartas); $i++) {
        if ($cartas[$i]['value'] == 'A') {
            if ($hayAs == false) {
                $puntos += 11;
                $hayAs = true;
            } else {
                $puntos += 1;
            }

        } elseif (
            $cartas[$i]['value'] == 'J' ||
            $cartas[$i]['value'] == 'Q' ||
            $cartas[$i]['value'] == 'K'
        ) {
            $puntos += 10;
        } else {
            $puntos += (int) $cartas[$i]['value'];
        }
    }
    if ($puntos > 21 && $hayAs == true) {
        $puntos -= 10;
    }
    return $puntos;
}


while (calcularPuntosBlackjack($banca) < 14) {
    $banca[] = array_pop($baraja);
}

for ($i = 0; $i < 5; $i++) {
    while (calcularPuntosBlackjack($jugadores[$i]) < 14) {
        $jugadores[$i][] = array_pop($baraja);
    }
}

$puntosBanca = calcularPuntosBlackjack($banca);

$resultados = [];
for ($i = 0; $i < 5; $i++) {
    $puntosJugador = calcularPuntosBlackjack($jugadores[$i]);
    if ($puntosJugador > 21) {
        $resultados[$i] = 'PIERDE';

    } elseif ($puntosBanca > 21) {
        $resultados[$i] = 'GANA';

    } elseif ($puntosJugador > $puntosBanca) {
        $resultados[$i] = 'GANA';

    } elseif ($puntosJugador < $puntosBanca) {
        $resultados[$i] = 'PIERDE';

    } else {
        $resultados[$i] = 'EMPATA';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Blackjack | Juegos de cartas</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/cabecera.php';
    ?>

    <main class="contenedor">

        <section class="presentacion">

            <p class="etiqueta">Juego de cartas</p>

            <h1>Blackjack</h1>

            <p class="descripcion">
                Consigue la mejor puntuación sin superar los 21 puntos.
            </p>

        </section>

        <section class="juegos">

            <h2>La banca</h2>

            <div class="tarjeta-juego mano-blackjack">

                <div class="cartas-blackjack">

                    <?php foreach ($banca as $carta): ?>

                        <img
                            src="img/<?= htmlspecialchars($carta['image']) ?>"
                            alt="Carta de la banca"
                        >

                    <?php endforeach; ?>

                </div>

                <p>
                    Puntuación:
                    <strong><?= $puntosBanca ?></strong>
                </p>

            </div>

            <h2>Jugadores</h2>

            <div class="rejilla-juegos">

                <?php for ($i = 0; $i < 5; $i++): ?>

                    <div class="tarjeta-juego mano-blackjack">

                        <h3>Jugador <?= $i + 1 ?></h3>

                        <div class="cartas-blackjack">

                            <?php foreach ($jugadores[$i] as $carta): ?>

                                <img
                                    src="img/<?= htmlspecialchars($carta['image']) ?>"
                                    alt="Carta del jugador <?= $i + 1 ?>"
                                >

                            <?php endforeach; ?>

                        </div>

                        <p>
                            Puntuación:
                            <strong>
                                <?= calcularPuntosBlackjack($jugadores[$i]) ?>
                            </strong>
                        </p>

                        <p class="resultado-blackjack">
                            <?= $resultados[$i] ?>
                        </p>

                    </div>

                <?php endfor; ?>

            </div>

        </section>

    </main>

    <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
    ?>

</body>
</html>
