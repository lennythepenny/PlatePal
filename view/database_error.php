<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database Error</title>
    <link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>
    <header>
        <h1>Plate Pal</h1>
    </header>
    <main>
        <h2>Database Connection Error</h2>
        <p>There was an issue connecting to the database.</p>
        <p>Error message: <?php echo htmlspecialchars($error_message); ?></p>
    </main>
</body>
</html>
