<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dish Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <header>
        <div class="logo">
            <p><span>Your</span>Shop</p>
        </div>
        <ul class="menu">
            <li><a href="#home">Acceuil</a></li>
            <li><a href="#menu">Shop</a></li>
            <li><a href="#about_us">A Propos</a></li>
            <div class="dish">
            <li><a href="compte/connexion.php">Sign in</a></li>
        </div>
        </ul>

        <!-- menu responsive -->
        <div class="toggle_menu"></div>
    </header>
<?php 
    require_once __DIR__.'/../config/config.php';
        if(!empty($_POST['password']) && !empty($_POST['password_repeat']) && !empty($_POST['token'])){
            $password = htmlspecialchars($_POST['password']);
            $password_repeat = htmlspecialchars($_POST['password_repeat']);
            $token = htmlspecialchars($_POST['token']);

            $check = $bdd->prepare('SELECT * FROM utilisateurs WHERE token = ?');
            $check->execute(array($token));
            $row = $check->rowCount();

            if($row){
                if($password === $password_repeat){
                    $cost = ['cost' => 12];
                    $password = password_hash($password, PASSWORD_BCRYPT, $cost);

                    $update = $bdd->prepare('UPDATE utilisateurs SET password = ? WHERE token = ?');
                    $update->execute(array($password, $token));
                    
                    $delete = $bdd->prepare('DELETE FROM password_recover WHERE token_user = ?');
                    $delete->execute(array($token));

                    echo "Le mot de passe a bien été modifie";
                }else{
                    echo "Les mots de passes ne sont pas identiques";
                }
            }else{
                echo "Compte non existant";
            }
        }else{
            echo "Merci de renseigner un mot de passe";
        }
        ?>
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;500;700&display=swap');
        *
        {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif; 
        }
        section {
            margin-top: 50px;
        }
        body {
            position: relative;
        }
        html {
            scroll-behavior: smooth;
            font-size: 62.5%;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 50px;
            padding: 0 10%;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: rgba(255 255 255 /0.9);
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            z-index: 10;
        }
        .menu {
            display: flex;
        }
        .logo {
            color: #276aae;
            font-weight: 700;
            font-size: 25px;
        }
        .logo span {
            color: #273e60;
        }
        .menu li {
           margin: 0 15px;
           list-style: none;
        }
        .menu li a {
            font-size: 14px;
            text-decoration: 0;
            color: #999;
            position: relative;
        }
        .menu li a::before {
            position: absolute;
            top: -5px;
            left: 0;
            content: "";
            width: 0;
            height: 2px;
            border-radius: 6px;
            background-color: #276aae;
            transition: 0.5s;
        }
        .menu li a:hover::before {
            width: 100%;
        }
        .menu li a::after {
            position: absolute;
            bottom: -5px;
            right: 0;
            content: "";
            width: 0;
            height: 2px;
            border-radius: 6px;
            background-color: #276aae;
            transition: 0.5s;
        }
        .menu li a:hover::after {
            width: 100%;
        }
        .menu li a:hover {
            color: #000;
        }
        
        /* home CSS */
        #home {
            margin-top: 50px;
            display: flex;
            align-items: center;
            margin-left: 10%;
            margin-right: 10%;
            height: calc(100vh - 50px);
            justify-content: space-between;
        }
        #home .left {
            width: 40%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        #home .left h4 {
            font-size: 20px;
            color: #276aae;
        }
        #home .left h1 {
            font-size: 40px;
        }
        #home .left p {
            font-size: 12px;
            color: #999;
        }
        #home .left button {
             margin-top: 20px;
             width: fit-content;
             padding: 5px 10px;
             background-color: #000;
             border: 0;
             transition: 0.5s;
             position: relative;
             cursor: pointer;
            }
            #home .left button  a {
                text-decoration: 0;
                color: #fff;
                font-weight: bold;
                text-transform: uppercase;
                transition: 0.5s;
        }
        #home .left button::before {
            position: absolute;
            left: 5px;
            top: 5px;
            content: "";
            height: 100%;
            width: 100%;
            z-index: -1;
            background-color: #276aae;
        }
        #home .left button:hover a{
           letter-spacing: 1px;
        }
        
        #home .right {
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #home .right img {
            width: 900px;
            animation: animate 2s linear;
            transition: 0.5s;
            
        }
        #home .right img:nth-child(1) {
            width: 900px;
            animation: animate 2s linear;
            transition: 0.5s;
            position: absolute;
        right: 2;
        opacity: 0;
            
        }
        
        #home .right:hover img:nth-child(1){
            opacity: 1;
           
        }
        .menu .dish a {
            margin-top: 10px;
            font-size: 11px;
            text-decoration: 0;
            background-color: #276aae;
            padding: 5px 20px;
            color: #fff;
            border-radius: 6px;
        }
        /* animation image */
        
        @keyframes animate {
            0%{opacity: 0;}
            100%{opacity: 1;}
        }
        
        /* menu CSS */
        
        #menu {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background-color: rgba(0,0,0,0.05);
            padding: 50px 10px;
        }
        .mini_title {
            margin-top: 25px;
            font-size: 16px;
            color: #276aae;
            text-transform: capitalize;
        }
        .title {
            font-size: 20px;
            text-transform: uppercase;
            color: #273e60;
            margin-bottom: 25px;
            text-align: center;
        }
        .dishes {
            display: flex;
            flex-wrap: wrap;
            width: 80%;
            justify-content: space-around;
        }
        .dishes .dish {
            height: 280px;
            width: 30%;
            background-color: #fff;
            padding: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border-radius: 6px;
            margin-bottom: 35px;
            transition: 0.5s;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        
        }
        .dishes .dish  img {
            width: 250px;
            height: 170px;
            margin-bottom: 15px;
        }
        .dishes .dish p {
            text-align: center;
            font-size: 18px;
        
        }
        .dishes .dish a {
            margin-top: 10px;
            font-size: 14px;
            text-decoration: 0;
            background-color: #276aae;
            padding: 5px 60px;
            color: #fff;
            border-radius: 6px;
        }
        
        /*Scrollbar CSS*/
        ::-webkit-scrollbar {
            width: 0px;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #276aae;
        }
        
        /* about us CSS */
        
        #about_us {
            display: flex;
            align-items: center;
            height: calc(100vh - 50px);
            flex-direction: column;
            padding: 50px 10%;
            width: 100%;
        }
        .about {
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: space-between;
            height: 70vh;
            
        }
        .about .left {
             width: 40%;
             display: flex;
             align-items: center;
             justify-content: center;
             height: 100vh;
             
        }
        .about .left img {
            width: 90%;
            opacity: 90%;
            border-radius: 5px;
            
        }
        .about .right {
            width: 60%;
        }
        .about .right h3 {
            font-size:35px;
            color: #273e60;
            margin: 10px 0;
        }
        .about .right p {
            font-size: 14px ;
            color: #999;
        }
        .about .right button {
            margin: 20px 0;
            padding: 5px 60px;
            background-color: #276aae;
            border: 0;
        }
        .about .right button a{
            color: #fff;
            text-decoration: 0;
            font-weight: bolder;
        }
        
        
        /* comment section CSS */
        
        .comment_section {
            display: flex;
            align-items: center;
            justify-content: center;
            height: calc(100vh - 50px);
            flex-direction: column;
            padding: 0 10%;
        }
        
        .comments {
            display: flex;
            justify-content: space-around;
            width: 100%;
            flex-wrap: wrap;
        }
        .comments  .comment div {
           display: flex;
           align-items: center;
           margin-bottom: 10px;
        }
        .comments  .comment div img {
           width: 50px;
           height: 50px;
           border: 2px solid #276aae;
           border-radius: 50%;
        }
        .comments  .comment {
            width: 30%;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 20px;
        }
        .comments  .comment div h4 {
            margin-left: 15px;
            font-size: 14px;
            color: #273e60;
        }
        .comments  .comment p {
            font-size: 13px;
            color: #999;
        }
        /* reservation CSS */
        
        #reservation {
            margin-top: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            flex-direction: column;
        }
        #reservation form {
            display: flex;
            background-color: rgba(0,0,0,0.05);
            padding: 25px;
            border-radius: 6px;
            flex-direction: column;
            width: 350px;
        }
        #reservation form  label {
            margin-bottom: 8px;
            font-size: 14px;
        }
        #reservation form input {
            margin-bottom: 10px;
           padding: 5px;
           border: 1px solid transparent;
           box-shadow: 0 0 10px rgba(0,0,0,0.05);
           outline: 0;
        }
        #reservation form input:focus {
            outline: 1px solid #276aae;
        }
        #reservation form input[type="submit"]{
            margin-top: 15px;
            color: #fff;
            background-color: #276aae;
            border: 1px solid #276aae;
        }
        
        /* footer CSS */
        
        footer {
            background-color: rgba(0,0,0,0.05);
        }
        footer .services_list {
            padding: 10px 10%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .service img {
            width: 40px;
            background-color: #276aae;
            padding: 10px;
            border-radius: 50%;
            margin-bottom: 10px;
        
        }
        .service {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin: 25px auto;
        }
        .service  p {
            color: #333;
        }
        hr {
            background-color: #ccc;
            border: 0;
            height: 2px;
            width: 100%;
        }
        .footer_text {
            text-align: center;
            font-size: 15px;
            padding: 8px 0;
        }
        .footer_text span {
            color: #276aae;
        }
        .toggle_menu {
            display: none;
        }
        /* Responsive */
        @media (max-width:964px) {
            header .menu {
                display: none;
            }
            header {
                padding: 0 20px;
            }
            #home {
                flex-direction: column;
                padding: 12px;
                height: fit-content;
        
            }
            #home .left , #home .right  {
                width: 100%;
                padding: 0;
            }
            #home .left {
                margin: 100px 0;
            }
            #home .left h1 {
                font-size: 20px;
                margin-bottom: 15px;
            }
            #home .left h4 {
                font-size: 15px;
            }
            #home .left p {
                font-size: 15px;
            }
            #menu .dishes .dish {
                width: 100%;
                max-width: 260px;
            }
            #about_us {
                padding: 10px ;
                height: auto;
            }
            #about_us .about {
                flex-direction: column;
               height: fit-content;
            }
            #about_us .left , #about_us .right {
                width: 100%;
            }
            #about_us .left {
                height: fit-content;
            }
            #about_us .left img {
                width: 50%;
            }
            #about_us .right {
                text-align: center;
                padding: 20px;
            }
            .comment_section {
                height: auto;
            }
            .comment_section .comments  .comment{
                width: 100%;
                margin-top: 20px;
            }
            .services_list .service {
                padding: 0 50px;
            }
            .toggle_menu {
                display: flex;
                height: 40px;
                width: 40px;
                 display: flex;
                 align-items: center;
                 justify-content: center;
                 position: relative;
                 cursor: pointer;
            }
            .toggle_menu::before {
                position: absolute;
                content: "";
                height: 3px;
                width: 28px;
                background-color: #276aae;
                border-radius: 6px;
                box-shadow: 0 10px 0 #276aae;
                transform: translateY(-10px);
                transition: 0.5s;
            }
            .toggle_menu.active::before {
                transform: translateY(0) rotate(135deg);
                box-shadow: 0 0 0 #276aae
            }
            .toggle_menu::after {
                position: absolute;
                content: "";
                height: 3px;
                width: 28px;
                background-color: #276aae;
                border-radius: 6px;
                transform: translateY(10px);
                transition: 0.5s;
            }
            .toggle_menu.active::after {
                transform: translateY(0) rotate(-135deg);
              
            }
            header .menu.responsive {
                display: flex;
                position: absolute;
                top: 50px;
                left: 0;
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                flex-direction: column;
            }
            header .menu.responsive li {
                margin: 15px 0;
            }
        
        }
        </style>