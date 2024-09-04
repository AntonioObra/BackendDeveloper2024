<?php
define("SAMOGLASNICI", ["a", "e", "i", "o", "u"]);

function broj_slova(string $rijec) : int
{
    $broj_slova = strlen($rijec);

    return $broj_slova;
}

function broj_suglasnika(string $rijec) : int
{
    // * Dobivamo broj suglasnika tako da umjesto da istim nacinom dobivanja broja_suglasnika
    // * deklariramo sve suglasnika mozemo samo izbaciti sve samoglasnike i pomocu funkcije
    // * broj_slova dobiti broj suglasnika

    // * Zamijeni sve samoglasnike sa '', koristimo str_ireplace umjesto str_replace da bude case-insensitive
    $rijec_bez_samoglasnika = str_ireplace(SAMOGLASNICI, '', $rijec);

    return broj_slova($rijec_bez_samoglasnika);
}

function broj_samoglasnika(string $rijec) : int
{
    // * Dobivamo broj samoglasnika tako da provjeravamo svaki char jeli koji od samoglasnika
    $broj_samoglasnika = 0;

    for ($i = 0; $i < broj_slova($rijec); $i++) {
        if (! in_array(strtolower($rijec[$i]), SAMOGLASNICI)) {
            continue;
        }

        $broj_samoglasnika++;
    }

    return $broj_samoglasnika;
}

function dobi_sve_rijeci() : array
{
    // * Dobi sve rijeci iz words.json
    $json_data = json_decode(file_get_contents("words.json"));
    $words     = $json_data;

    return $words;
}

function dodaj_novu_rijec(string $rijec) : void
{
    // * Ako ne postoji rijec izbaci
    if (empty($rijec)) {
        return;
    }

    $nova_rijec = array(
        "rijec"             => $rijec,
        "broj_slova"        => broj_slova($rijec),
        "broj_suglasnika"   => broj_suglasnika($rijec),
        "broj_samoglasnika" => broj_samoglasnika($rijec),
    );

    // * Dobi stare rijeci i dodaj u taj array novu rijec
    $sve_rijeci   = dobi_sve_rijeci();
    $sve_rijeci[] = $nova_rijec;

    // * Dodaj rijeci u words.json
    file_put_contents("words.json", json_encode($sve_rijeci));
}

// * Dodaj novu rijec u words.json
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["rijec"])) {
    dodaj_novu_rijec($_POST["rijec"]);
}

// * Dobi sve rijeci
$sve_rijeci = dobi_sve_rijeci();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        main {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 60vw;
            margin: 0 auto;
            height: 100vh;
            gap: 100px;
        }

        main .container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 100px;
            width: 100%;
        }

        form {
            width: 300px;
        }

        form .input-container {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        form button {
            margin-top: 15px;
            cursor: pointer;
        }

        table {
            flex: 2;
            border: 1px solid;
        }

        table td,
        tr {
            border: 1px solid;
        }
    </style>
</head>

<body>
    <main>
        <h1>Upišite željenu riječ!</h1>

        <div class="container">
            <form action="" method="POST">
                <div class="input-container">
                    <label for="rijec">Upišite riječ:</label>
                    <input type="text" name="rijec" id="rijec" required>
                </div>

                <button type="submit">pošalji</button>
            </form>

            <table>
                <thead>
                    <td>Rijec</td>
                    <td>Broj slova</td>
                    <td>Broj suglasnika</td>
                    <td>Broj samoglasnika</td>
                </thead>

                <tbody>
                    <?php foreach ($sve_rijeci as $rijec) : ?>
                        <tr>
                            <td>
                                <?php echo $rijec->rijec; ?>
                            </td>

                            <td>
                                <?php echo $rijec->broj_slova; ?>
                            </td>

                            <td>
                                <?php echo $rijec->broj_suglasnika; ?>
                            </td>

                            <td>
                                <?php echo $rijec->broj_samoglasnika; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>
