
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Juegos de cartas | Daniel</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="cabecera">
        <div class="contenedor navegacion">

            <a href="index.php" class="logo">
                <span class="simbolo-logo" aria-hidden="true">♠</span>
                Juegos de cartas
            </a>

            <nav aria-label="Navegación principal">
                <a href="higherDaniel.php">Higher</a>
                <a href="blackjackDaniel.php">Blackjack</a>
            </nav>

        </div>
    </header>

    <main class="contenedor">

        <section class="presentacion">
            <p class="etiqueta">Proyecto PHP</p>

            <h1>Tu próxima partida empieza aquí</h1>

            <p class="descripcion">
                Bienvenido a mi aplicación de juegos de cartas.
                Elige un juego y prepárate para poner a prueba tu suerte.
            </p>
        </section>

        <section class="juegos">

            <h2>Elige tu juego</h2>

            <div class="rejilla-juegos">

                <a href="higherDaniel.php" class="tarjeta-juego">

                    <div class="simbolos" aria-hidden="true">♠ ♥</div>

                    <h3>Higher</h3>

                    <p>
                        Enfrenta tus cartas con las de otro jugador
                        y consigue la mayor puntuación.
                    </p>

                    <span class="enlace-juego">
                        Jugar ahora →
                    </span>

                </a>

                <a href="blackjackDaniel.php" class="tarjeta-juego">

                    <div class="simbolos" aria-hidden="true">♦ ♣</div>

                    <h3>Blackjack</h3>

                    <p>
                        Intenta alcanzar la mejor puntuación
                        sin superar los 21 puntos.
                    </p>

                    <span class="enlace-juego">
                        Jugar ahora →
                    </span>

                </a>

            </div>

        </section>

        <section class="autor">

            <div class="avatar" aria-hidden="true">D</div>

            <div>
                <h2>Desarrollado por Daniel</h2>

                <p>
                    Práctica de Desarrollo Web en Entorno Servidor.
                </p>
            </div>

        </section>

    </main>

    <footer class="pie">

        <p>
            &copy; <?= date('Y') ?> Daniel.
            Aplicación desarrollada con PHP.
        </p>

    </footer>

</body>

</html>
