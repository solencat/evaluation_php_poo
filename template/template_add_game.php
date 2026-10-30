<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title><?= $title ?></title>
</head>

<body>
    <?php include 'component/navbar.php' ?>
    <main class="container">
        <form action="#" method="POST">

            <label for="title">Titre:</label>
            <input type="text" name="title" placeholder="Insérer le titre du jeu">

            <label for="type">Type:</label>
            <input type="text" name="type" placeholder="Insérer le type du jeu">

            <label for="publishAt">Date de publication:</label>
            <input type="date" name="publishAt" placeholder="Insérer la date de publication du jeu">

            <select name="console">
                <option value="" disabled>-- Sélectionner une console --</option>
                <option value="">-- Sélectionner une console --</option>
                <option value="PlayStation 5" name="ps5">PlaySation 5 - Sony</option>
                <option value="Switch" name="switch">Switch - Nintendo</option>
                <option value="Xbox Series X" name="xbox-sx">Xbox Series X - Microsoft</option>
                <option value="Steam Deck" name="steam-deck">Steam Deck - Valve</option>

                <!-- Ajouter le count et itérer pour chaque élément -->
            </select>

            <button type="button" value="Ajouter" name="submit">Envoyer</button>



        </form>
    </main>
</body>

</html>