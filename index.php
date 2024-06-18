<?php

$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];

$filteredHotels = $hotels;

if (isset($_GET['parking']) && $_GET['parking'] == '1') {
    $filteredHotels = [];
    foreach ($hotels as $hotel) {
        if ($hotel['parking']) {
            $filteredHotels[] = $hotel;
        }
    }
}

if (isset($_GET['vote']) && is_numeric($_GET['vote'])) {
    $minVote = (int)$_GET['vote'];
    $tempHotels = [];
    foreach ($filteredHotels as $hotel) {
        if ($hotel['vote'] >= $minVote) {
            $tempHotels[] = $hotel;
        }
    }
    $filteredHotels = $tempHotels;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Hotel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Elenco degli Hotel</h1>

        <!-- Filter Form -->
        <form method="GET" class="mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="parking" value="1" id="parking" <?php if (isset($_GET['parking']) && $_GET['parking'] == '1') echo 'checked'; ?>>
                <label class="form-check-label" for="parking">
                    Mostra solo hotel con parcheggio
                </label>
            </div>
            <div class="mb-3">
                <label for="vote" class="form-label">Filtra per voto minimo</label>
                <input type="text" class="form-control" name="vote" id="vote" placeholder="Inserisci il voto minimo" value="<?php echo isset($_GET['vote']) ? htmlspecialchars($_GET['vote']) : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Filtra</button>
        </form>

        <!-- Hotel Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Parcheggio</th>
                    <th>Voto</th>
                    <th>Distanza dal centro</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($filteredHotels)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Nessun hotel trovato.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($filteredHotels as $hotel): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($hotel['name']); ?></td>
                            <td><?php echo htmlspecialchars($hotel['description']); ?></td>
                            <td><?php echo $hotel['parking'] ? 'Sì' : 'No'; ?></td>
                            <td><?php echo htmlspecialchars($hotel['vote']); ?></td>
                            <td><?php echo htmlspecialchars($hotel['distance_to_center']); ?> km</td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>