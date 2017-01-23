<!--This file is required at the beginning of every page as a template-->
<html>
    <head>
         <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>iConsult</title>
        <?php endif ?>
        <link rel="stylesheet" href="../css/style.css">    
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../js/javascript.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet">
    </head>
    <body>
        <h1 class="heading">The Consultant</h1>
        <hr>
