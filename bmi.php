<?php
$nome    = htmlspecialchars($_POST['nome'] ?? '');
$peso    = (float) ($_POST['peso'] ?? 0);
$altezza = (float) ($_POST['altezza'] ?? 0);

$bmi = $altezza > 0 ? $peso / pow($altezza / 100, 2) : 0;

if ($bmi < 18.5)    { $classe = 'sottopeso';  $fascia = 'Sottopeso'; }
elseif ($bmi < 25)  { $classe = 'normopeso';  $fascia = 'Normopeso'; }
elseif ($bmi < 30)  { $classe = 'sovrappeso'; $fascia = 'Sovrappeso'; }
else                { $classe = 'obesita';    $fascia = 'Obesità'; }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Il tuo BMI</title>
    <style>
        body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height:720px;
        margin: 0;
        background: #F1F3F5;
    }
        .body {
            width: 480px;
            height: 640px;
            box-sizing: border-box;
            color: #1F2328;
            font-family: 'IBM Plex Sans', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 24px;
            padding: 40px;
        }
    
        h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        
        .card {
            width: 360px;
            box-sizing: border-box;
            border: 3px solid;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            text-align: center;
        }

        h2 {
            margin: 0;
            font-size: 22px;
        }

        p {
            margin: 0;
        }
        
        .bmi {
            margin: 8px 0;
            font-size: 48px;
            font-weight: 700;
            line-height: 1;
        }
        
        .fascia {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }
        
        a {
            font-size: 15px;
        }

        .sottopeso  {
            background: #E3EEF9;
            border-color: #2F6FB3;
            color: #2F6FB3;
        }

        .normopeso  {
            background: #E3F4E6;
            border-color: #256D34;
            color: #256D34;
        }

        .sovrappeso {
            background: #FCEBD7;
            border-color: #9A4F06;
            color: #9A4F06;
        }

        .obesita {
            background: #FBE2E2;
            border-color: #B32D2D;
            color: #B32D2D;
        }

        .card h2 {
            color: #1F2328;
        }
        
        .card .dati {
            color: #1F2328;
        }

        .card .bmi {
            color: #1F2328;
        }
    </style>
</head>
<body>
    <div class="body">
        <h1>Il tuo BMI</h1>
        <div class="card <?= $classe ?>">
            <h2><?= $nome ?></h2>
            <p class="dati">Peso <?= $peso ?> kg · Altezza <?= $altezza ?> cm</p>
            <p class="bmi"><?= number_format($bmi, 2) ?></p>
            <p class="fascia"><?= $fascia ?></p>
        </div>
        <a href="form.html">Calcola di nuovo</a>
    </div>
</body>
</html>