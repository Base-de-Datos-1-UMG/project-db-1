<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmacias UMG</title>
    <!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body class ="container d-flex flex-column justify-content-center" style="height: 100vh;">
    
    <h1 class="mb-4">Bienvenido a Farmacias UMG</h1>
    <div class="row g-3 form-control">
        <div class="col-auto">
            <label for="staticEmail2" >Usuario</label>
            <input type="text" class="form-control" id="user" name="user" placeholder="Escribe tu usuario">
        </div>
        <div class="col-auto">
            <label for="inputPassword2">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Escribe tu contraseña">
        </div>
        <div class="col-auto w-100 d-flex justify-content-center">
            <button class="btn btn-primary mb-3" id="entrar">Entrar</button>
        </div>
    </div>

    <script>
        $('#entrar').click(function(){
            var user = document.getElementById('user').value;
            var pass = document.getElementById('password').value;

            var ruta = "User="+user+"&Password="+pass;

            $.ajax({
                url: 'includes/login.php',
                type: 'POST',
                data: ruta,
            })
            .done(function (res){
                console.log("exito "+res);
                if(res == "activo"){
                    location.href = "./view-registers/menu.html";
                } else{
                    alert("El usuario esta inactivo");
                }
            })
            .fail(function (){
                console.log("error");
            })
            .always(function (){
                console.log("complete");
            });
        });
    </script>

</body>
</html>