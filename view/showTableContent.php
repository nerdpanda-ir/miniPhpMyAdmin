<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php if (is_array($rows) and empty($rows)) : ?>
        <h1>
            هیچ محتوایی در این جدول موجود نیست !!!
        </h1>
    <?php else : ?>
        <?php $columns =array_keys(get_object_vars($rows[0]->getContent())); ?>
        <table>
            <thead>
                <tr>
                    <?php foreach ($columns as $column) : ?>
                        <th>
                            <?php echo $column?>
                        </th>
                    <?php endforeach;?>
                    <th>
                        delete
                    </th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $row) : ?>
                <tr>
                    <?php $content = $row->getContent();?>
                    <?php foreach ($content as $item) : ?>
                        <td>
                            <?php echo $item?>
                        </td>
                    <?php endforeach; ?>
                    <td>
                        <a href="?action=2&database=<?php echo $database->getName()?>&table=<?php echo $table->getName()?>&row=<?php echo $content->{$table->getPrimaryKeyColumn()}?>">
                            delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>



    <?php endif;?>


</body>
</html>