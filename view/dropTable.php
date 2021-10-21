<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>drop table <?php echo $table->getName()?></title>
</head>
<body>
    <?php if (!$table->getIsExist()) : ?>
        <section class="errorMsg">
            <h1>
                جدول موجود نیست !!!
            </h1>
        </section>
    <?php elseif($isDeleted) : ?>
        <section>
            <?php echo $table->getName();?>
            با موفقیت حذف شد !!!
        </section>
    <?php elseif(!$isDeleted) : ?>
        <section>
            <?php echo $table->getName();?>
                ناموفق در حذف جدول‌!!!
        </section>
    <?php endif;?>
</body>
</html>