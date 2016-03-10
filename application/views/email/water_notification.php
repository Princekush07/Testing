<?php echo doctype('html'); ?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
</head>

<body>
    <div class="container">
        <p>Hi, these are the flower pots that need to be watered at <?php echo $water_time; ?>:</p>

        <ol>
            <?php foreach ($items as $item): ?>
                <li><?php echo $item->name; ?></li>
            <?php endforeach ?>
        </ol>
    </div>
</body>

</html>
