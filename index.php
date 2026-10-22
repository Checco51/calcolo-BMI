<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcolo BMI</title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 720px;
            margin: 0;
            background: #F1F3F5;
}
        .body{
            width: 480px;
            height: 640px;
            box-sizing: border-box;
            background: #F1F3F5;
            color: #1F2328;
            font-family: 'IBM Plex Sans', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 24px;
            padding: 40px;
        }
        
        .title{
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }

        form{
            width: 360px;
            box-sizing: border-box;
            background: #FFFFFF;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        div{
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        label{
            font-size: 14px;
            font-weight: 600;
        }
        input{
            height: 44px;
            box-sizing: border-box;
            padding: 0 12px;
            font-size: 16px;
            font-family: inherit;
            border: 1px solid #C9CED4;
            border-radius: 8px;
        }
        button{
            margin-top: 8px;
            height: 44px;
            border: none;
            border-radius: 8px;
            background: #1F2328;
            color: #FFFFFF;
            font-size: 16px;
            font-weight: 600;
            font-family: inherit;
        }

    </style>
</head>
<body>
    <div class="body">
        <h1 class="title">Calcolatore BMI</h1>
        <form method="post" action="bmi.php">
            <div>
                <label for="nome">Nome</label>
                <input id="nome" name="nome" type="text" placeholder="Luca">
            </div>
            <div>
                <label for="peso">Peso (kg)</label>
                <input id="peso" name="peso" type="number" placeholder="70" min="0">
            </div>
            <div>
                <label for="altezza">altezza (cm)</label>
                <input id="altezza" name="altezza" type="number" placeholder="178" min="1">
            </div>
            <button type="submit">Calcola</button>
        </form>
    </div>
</body>
</html>



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