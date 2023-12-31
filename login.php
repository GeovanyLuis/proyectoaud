<?php
include './templates/header.php';

if ($userController->isUserLoggedIn()) {
    header('Location: panel.php');
}

if(isset($_SESSION['isLoggedIn']) && !$_SESSION['isLoggedIn']) {
    $userController->logout();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <style>
        /* Agrega tus estilos CSS aquí */
        body {
            background-color: #f0f0f0;
        }

        /* Puedes agregar más estilos según tus necesidades */
    </style>
</head>
<body>

    <?php include './templates/nav.php' ?>

    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col col-md-6">
                <h3>Iniciar sesion</h3><hr />
                <form id="login-form">                   
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email">            
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>      
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </form>
                <div class="alert alert-danger mt-4 d-none" id="error-message"></div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script>
        document.getElementById('login-form').onsubmit = (e) => {
            e.preventDefault();

            const errorMessage = document.getElementById('error-message');
            errorMessage.classList.add('d-none');            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (!email || !password) {
                return;
            }

            axios.post('api/login.php', { email: email, password: password })
                .then(res => {
                    if (res.data.secondfactor) {
                        window.location = 'login-secondfactor.php';
                    } else {
                        window.location = 'panel.php';
                    }
                })
                .catch(err => {
                    errorMessage.innerText = err.response.data;
                    errorMessage.classList.remove('d-none');                    
                });

        }
    </script>
</body>
</html>