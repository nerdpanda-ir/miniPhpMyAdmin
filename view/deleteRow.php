<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>delete row <?php echo $row->getName()?> from <?php echo $database->getName().'.'.$table->getName(); ?></title>
</head>
<body>
    <?php if ($isDeleted and $row->getIsExist()) : ?>
        <section>
            <?php echo $row->getName();?>
            با موفقیت حذف شد !!!
        </section>
    <?php elseif(!$row->getIsExist()) : ?>
        <section>
            رکوردی با
            <?php echo $row->getTable()->getPrimaryKeyColumn()?>
            =
            <?php echo $row->getName();?>
            یافت نشد !!!
        </section>
    <?php elseif (!$isDeleted) : ?>
        <section>
            ناموفق در حذف رکورد !!!
        </section>
    <?php endif;?>
</body>
</html>