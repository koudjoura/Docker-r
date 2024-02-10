<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <center>
        <h1>Ajout d'une application</h1>
    </center>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif

    <!-- Assurez-vous que l'URL dans l'action du formulaire est correcte -->
    <form action="{{ url('/ajouter') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" required>
        <br>
        <input type="file" name="application" required>
        <button type="submit">Enregistrer</button>
    </form>
    <center>
        <button><a href="" style="color:white;">Retour</a></button>
    </center>
</body>
</html>
