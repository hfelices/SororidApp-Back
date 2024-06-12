<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrucciones - Sororidapp</title>
    <link rel="icon" href="{{ asset('SororidApp.jpg') }}" type="image/jpeg">

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

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
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
        .header-image{
            width: 15vw
        }
        .header-div{
            display: flex;
            flex-direction: column;
           align-items: center
        }
        .font-sororidapp{
            font-weight: bolder;
           font-size: 110%;
           color: #85267c;
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
        <div class="header-div">
            <img src="{{ asset('image.png') }}" alt="Sororidapp" class="header-image">
        </div>
        
        <p><strong class="font-sororidapp">SororidApp</strong> es la aplicación perfecta para volver a casa de forma segura. Puedes añadir gente a tus contactos y compartir tus rutas con ellos, llamada al 112 de forma rápida y más.</p>

        <h2>Instrucciones para Instalar</h2>
        <ul class="instructions-list">
            <li>Acepte instalaciones de orígenes desconocidos</li>
            <li>Descargue el APK y ejecútelo</li>
        </ul>

        <div class="button-container">
            <a href="{{ route('download', ['filename' => 'SororidApp.apk']) }}" class="button">
                <i class="fas fa-download"></i> Descargar SororidApp
            </a>
        </div>
    </div>
</body>
</html>
