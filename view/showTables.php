<?php
    $dbName = $database->getName();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>show tables from <?php echo $dbName;?></title>
    <link rel="stylesheet" href="../../../../assets/css/library/core/core.css">
</head>
<body>
<h1>
    database :
    <?php echo $dbName;?>
    <br>
    showing tables :
</h1>
<?php if($database->getIsExist() and !empty($tables)) : ?>
<table>
    <thead>
        <tr>
            <td> name </td>
            <td> show </td>
            <td> delete </td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tables as $table) : ?>
            <tr>
                <td>
                    <?php echo $table->getName()?>
                </td>
                <td>
                    <a href="?action=1&table=<?php echo $table->getName()?>&database=<?php echo $table->getDatabase()->getName()?>">show</a>
                </td>
                <td>
                    <a href="?table=<?php echo $table->getName()?>&database=<?php echo $table->getDatabase()->getName()?>&action=2">delete</a>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php elseif (empty($table) and $database->getIsExist()):?>
<section class="errorMsg">
    <h1>
        هیچ جدولی موجود نیست !!!
    </h1>
</section>
<?php else : ?>
<section class="errorMsg">
    <h2> not found this database !!! </h2>
</section>
<?php endif;?>

</body>
</html>
