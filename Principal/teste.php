<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="../Bootstrap/js/sweetalert2.all.min.js"></script>
    <script src="../Bootstrap/js/jquery-3.5.1.min.js"></script>

</head>
<body>
    <button id="submit">Clique aqui</button>

    <script>
        $("#submit").click(function(){
        Swal.fire({
        icon: 'success',
        title: 'Ééééé gata',
        })
        });
    </script>
</body>
</html>