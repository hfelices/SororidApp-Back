<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrucciones - Sororidapp</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap">
    <style>
        :root {
            --ion-color-sororidark: #85267c;
            --ion-color-sororidark-contrast: #ffffff;
            --ion-color-sororidark-shade: #75216d;
            --ion-color-sororidark-tint: #913c89;
            --ion-color-sororilight: #9984b8;
            --ion-color-sororilight-contrast: #000000;
            --ion-color-sororilight-shade: #8774a2;
            --ion-color-sororilight-tint: #a390bf;
        }

        body {
            font-family: 'Comfortaa', cursive;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1, h2 {
            color: var(--ion-color-sororidark);
        }

        p, li {
            color: var(--ion-color-sororilight-shade);
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: var(--ion-color-sororidark);
            color: var(--ion-color-sororidark-contrast);
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: var(--ion-color-sororidark-tint);
        }

        .button i {
            margin-right: 10px;
        }

        .instructions-list {
            list-style-type: none;
            padding-left: 0;
        }

        .instructions-list li {
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h1, h2 {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido a Sororidapp</h1>
        <p>Sororidapp es la aplicación perfecta para volver a casa de forma segura. Puedes añadir gente a tus contactos y compartir tus rutas con ellos, llamada al 112 de forma rápida y más.</p>

        <h2>Instrucciones para Instalar</h2>
        <ul class="instructions-list">
            <li>Poner el móvil en modo desarrollador:
                <ul>
                <br>
                    <li>Ir a <strong>Ajustes</strong></li>
                    <li>Seleccionar <strong>Acerca del teléfono</strong></li>
                    <li>Toque el campo <strong>Número de compilación</strong> 7 veces</li>
                    <li>Verá un mensaje a medida que se aproxime a los 7 toques. Una vez completados verá un mensaje notificando que ahora es desarrollador.</li>
                    <li>Si ya es desarrollador, verá un mensaje que indica que usted ya es desarrollador.</li>
                    <li>Toque la flecha hacia atrás una vez haya terminado y aparecerá <strong>Opciones de desarrollo</strong> en Ajustes.</li>
                </ul>
            </li>
            <li>Acepte instalaciones de orígenes desconocidos</li>
            <li>Descargue el APK y ejecútelo</li>
        </ul>

        <a href="{{ route('download', ['filename' => 'app-debug.apk']) }}" class="button">
            <i class="fas fa-download"></i> Descargar SororidApp
        </a>
    </div>
</body>
</html>
