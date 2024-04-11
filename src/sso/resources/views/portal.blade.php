<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <style>
        .container {
            text-align: center;
			align-items: center;
        }
		.heading h2{
			    font-size: 32px;
				font-weight: 700;
				opacity: 0;
				animation: slideBottom .5s ease forwards .7s;
				animation-delay: .7s;
			}
        .button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <section class="container" id="container">
	<h2 class="heading">Bienvenue sur notre site</h2>
        <form action="page1.html" method="GET">
            <button class="button" type="submit">Accreditation</button>
        </form>
		
        <form action="page2.html" method="GET">
            <button class="button" type="submit">Aide à la presse</button>
        </form>
        <form action="page3.html" method="GET">
            <button class="button" type="submit">Site web</button>
        </form>
		
        <form action="page4.html" method="GET">
            <button class="button" type="submit">AVI</button>
        </form>
    
</body>
</html>
