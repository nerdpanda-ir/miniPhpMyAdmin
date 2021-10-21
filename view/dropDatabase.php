<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>drop database <?php echo $database->getName()?></title>
</head>
<body>
    <?php if(!$database->getIsExist()) : ?>
        <section class="errorMsg">
            <h1>همچین دیتابیسی موجود نیست !!!</h1>
        </section>
    <?php elseif($isDeleted and $database->getIsExist()) : ?>
        <section>
            <h1>
                <?php echo $database->getName();?>
                با موفقیت حذف شد !!!
            </h1>
        </section>
    <?php elseif(!$isDeleted and $database->getIsExist()) :?>
        <section>
            <h1>
                <?php echo $database->getName();?>
                متاسفانه حذف نشد !!!
            </h1>
        </section>
        <?php endif;?>

</body>
</html>