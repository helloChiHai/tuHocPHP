<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thêm chuyên mục</title>
</head>

<body>
    <h1>Thêm chuyên mục</h1>
    <form action="<?php echo route('categories.add'); ?>" method="POST">
        <div>
            <input type="text" name="category_name" placeholder="tên chuyên mục">
        </div>
        <?php echo csrf_field(); ?>
        {{-- <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> --}}
        <button type="submit">Thêm chuyên mục</button>
    </form>
</body>

</html>
