<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dock-CHAD - Votre plateforme d'hébergement</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }

        center {
            text-decoration: underline;
            font-size: 1.5em;
            font-weight: bold;
            display: block;
            margin-bottom: 20px;
        }

        nav {
            background-color: #007bff;
            padding: 10px;
            border-radius: 5px;
            margin-left: auto;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <center>Dock-CHAD votre plateforme d'hébergement</center>
    <nav>
        <a href="/">Accueil</a>
        <a href="/ajouter">Nouveau hébergement</a>
    </nav>

    {{-- affichage des projets --}}
    <div class="col mt-3">
        <h3>LISTE DES SITES HEBERGES</h3>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Site</th>
                    <th>Demarer</th>
                    <th>Arreter</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fichiers as $fichier)
                <tr>
                    <td>{{$fichier->name}}</td>
                    <td>
                        <div class="row">
                            <div class="col">
                                <form action="{{route('hebergement')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="projet" value="{{$fichier->fichier}}">
                                    <input type="hidden" name="statut" value="1" placeholder="Site en cours ">
                                    <button class="btn btn-success">
                                        <i class="bi bi-skip-start-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td> <div class="col">
                        <form action="{{route('hebergement')}}" method="POST">
                            @csrf
                            <input type="hidden" name="projet" value="{{$fichier->fichier}}">
                            <input type="hidden" name="statut" value="0">
                            <button class="btn btn-danger">
                                <i class="bi bi-stop-circle-fill"></i>
                            </button>
                        </form>
                    </div>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
