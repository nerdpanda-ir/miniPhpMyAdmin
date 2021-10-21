<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>show databases</title>
</head>
<body>
<h1> databases : </h1>
<?php if (is_array($databases) and count($databases)>=1) : ?>
    <table>
        <thead>
            <tr>
                <td>
                    name
                </td>
                <td>
                    show tables
                </td>
                <td>
                    drop
                </td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($databases as  $database) : ?>
                <?php $name = $database->getName();?>
                <tr>
                    <td>
                        <?php echo $name;?>
                    </td>
                    <td>
                        <a href="?action=1&database=<?php echo $name?>">
                            show <?php echo $name?>
                        </a>
                    </td>
                    <td>
                        <a href="?database=<?php echo $name?>&action=2">
                            Drop <?php echo $name?>
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
<?php else : ?>
<?php endif;?>
</body>
</html>