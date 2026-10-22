<?php
$nome    = trim($_POST['nome'] ?? '');
$peso_raw    = $_POST['peso'] ?? '';
$altezza_raw = $_POST['altezza'] ?? '';

$err_nome    = '';
$err_peso    = '';
$err_altezza = '';

$mostra_risultato = false;

// Se la pagina viene richiamata via POST, effettuiamo i controlli
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Controlli sul Nome
    if ($nome === '') {
        $err_nome = 'Il campo Nome è obbligatorio.';
    }

    // Controlli sul Peso
    if ($peso_raw === '') {
        $err_peso = 'Il campo Peso è obbligatorio.';
    } else {
        $peso = (float) $peso_raw;
        if ($peso < 0) {
            $err_peso = 'Il peso non può essere minore di 0.';
        }
    }

    // Controlli sull'Altezza
    if ($altezza_raw === '') {
        $err_altezza = "Il campo Altezza è obbligatorio.";
    } else {
        $altezza = (float) $altezza_raw;
        if ($altezza < 1) {
            $err_altezza = "L'altezza non può essere minore di 1 cm.";
        }
    }

    // Se non ci sono errori, calcoliamo il BMI e mostriamo la card
    if (!$err_nome && !$err_peso && !$err_altezza) {
        $mostra_risultato = true;

        $bmi = $altezza > 0 ? $peso / pow($altezza / 100, 2) : 0;

        if ($bmi < 18.5)    { $classe = 'sottopeso';  $fascia = 'Sottopeso'; }
        elseif ($bmi < 25)  { $classe = 'normopeso';  $fascia = 'Normopeso'; }
        elseif ($bmi < 30)  { $classe = 'sovrappeso'; $fascia = 'Sovrappeso'; }
        else                { $classe = 'obesita';    $fascia = 'Obesità'; }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $mostra_risultato ? 'Il tuo BMI' : 'Calcolo BMI' ?></title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 720px;
            margin: 0;
            background: #F1F3F5;
            font-family: 'IBM Plex Sans', sans-serif;
            color: #1F2328;
        }

        .body {
            width: 480px;
            min-height: 640px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 24px;
            padding: 40px;
        }
        
        .title, h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }

        form {
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

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        label {
            font-size: 14px;
            font-weight: 600;
        }

        input {
            height: 44px;
            box-sizing: border-box;
            padding: 0 12px;
            font-size: 16px;
            font-family: inherit;
            border: 1px solid #C9CED4;
            border-radius: 8px;
        }

        input.error-border {
            border-color: #B32D2D;
        }

        .error-message {
            color: #B32D2D;
            font-size: 13px;
            font-weight: 500;
        }

        button {
            margin-top: 8px;
            height: 44px;
            border: none;
            border-radius: 8px;
            background: #1F2328;
            color: #FFFFFF;
            font-size: 16px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
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
            color: #1F2328;
        }

        p {
            margin: 0;
        }
        
        .bmi {
            margin: 8px 0;
            font-size: 48px;
            font-weight: 700;
            line-height: 1;
            color: #1F2328;
        }
        
        .fascia {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }
        
        a {
            font-size: 15px;
            color: #1F2328;
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

        .card .dati {
            color: #1F2328;
        }
    </style>
</head>
<body>
    <div class="body">
        <?php if ($mostra_risultato): ?>
            <!-- SCHERMATA DI RISULTATO -->
            <h1>Il tuo BMI</h1>
            <div class="card <?= $classe ?>">
                <h2><?= htmlspecialchars($nome) ?></h2>
                <p class="dati">Peso <?= $peso ?> kg · Altezza <?= $altezza ?> cm</p>
                <p class="bmi"><?= number_format($bmi, 2) ?></p>
                <p class="fascia"><?= $fascia ?></p>
            </div>
            <a href="index.php">Calcola di nuovo</a>

        <?php else: ?>
            <!-- SCHERMATA FORM -->
            <h1 class="title">Calcolatore BMI</h1>
            <form method="post" action="index.php" novalidate>
                <div class="input-group">
                    <label for="nome">Nome</label>
                    <input id="nome" name="nome" type="text" placeholder="Luca" value="<?= htmlspecialchars($nome) ?>" class="<?= $err_nome ? 'error-border' : '' ?>">
                    <?php if ($err_nome): ?>
                        <span class="error-message"><?= $err_nome ?></span>
                    <?php endif; ?>
                </div>

                <div class="input-group">
                    <label for="peso">Peso (kg)</label>
                    <input id="peso" name="peso" type="number" min="0" step="any" placeholder="70" value="<?= htmlspecialchars($peso_raw) ?>" class="<?= $err_peso ? 'error-border' : '' ?>">
                    <?php if ($err_peso): ?>
                        <span class="error-message"><?= $err_peso ?></span>
                    <?php endif; ?>
                </div>

                <div class="input-group">
                    <label for="altezza">Altezza (cm)</label>
                    <input id="altezza" name="altezza" type="number" min="1" step="any" placeholder="178" value="<?= htmlspecialchars($altezza_raw) ?>" class="<?= $err_altezza ? 'error-border' : '' ?>">
                    <?php if ($err_altezza): ?>
                        <span class="error-message"><?= $err_altezza ?></span>
                    <?php endif; ?>
                </div>

                <button type="submit">Calcola</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>