<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\FichierModel;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class FichierController extends Controller
{
    public function startOrStop(Request $request){
        $projet = $request->input('projet'); // Projet/Gestion.zip
        $statut = $request->input('statut');
        $p = explode('/', $projet)[1]; // Gestion.zip
        $nomProjet = explode('.', $p)[0]; // Gestion
        if($statut == 1){ // démarrer
            $bashScript =  'docker-compose -f ProjetDecompresser/'.$nomProjet.'/docker-compose.yml up -d'; // démarrer
            $message = "Site demarré avec succès";
        }else{ // arrêter
            $bashScript =  'docker-compose -f ProjetDecompresser/'.$nomProjet.'/docker-compose.yml down'; // arrêter
            $message = "Site arrêté";
        }
        exec($bashScript, $output, $returnCode);

        // Ajoutez ces logs
        error_log("Script: $bashScript");
        error_log("Output: " . print_r($output, true));
        error_log("Return Code: $returnCode");

        if ($returnCode === 0) {
            echo $message;
        } else {
            // Handle the error
            dd('Error executing the Bash script.');
        }

    }
    public function create()
    {
        return view('ajouter.ajouter');
    }
   public function handleUpload(Request $request)
    {
        $validatedData = $request->validate([
            'application' => 'required|mimes:zip,rar|max:20480', // 20MB Max
        ]);
        $file = $request->file('application');
        $originalName = $file->getClientOriginalName();
        // Utilisez uniquement 'Projet/nomdufichier.zip' comme chemin à enregistrer dans la base de données
        $relativePath = 'Projet/' . $originalName;
        // Déplacez le fichier vers le dossier public/Projet
        $file->move(public_path('Projet'), $originalName);
        // Création d'une nouvelle instance du modèle FichierModel
        $fichier = new FichierModel();
        // Assurez-vous que le champ 'name' reçoit une valeur valide
        $fichier->name = $request->input('nom'); // Nom du fichier sans extension
        $fichier->fichier = $relativePath; // Chemin relatif du fichier pour utilisation dans l'application
        $fichier->save();
        // Le reste de votre code pour décompresser et dockeriser, si nécessaire
        $this->decompressAndDockerize(public_path($relativePath), pathinfo($originalName, PATHINFO_FILENAME));
        return back()->with('success', 'Fichier uploadé et traitement en cours.');
    }



    private function decompressAndDockerize($filePath, $folderName)
    {
        $decompressedPath = public_path('ProjetDecompresser') . '/';
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        if ($extension === 'zip') {
            $zip = new ZipArchive;
            if ($zip->open($filePath) === TRUE) {
                $zip->extractTo($decompressedPath);
                $zip->close();
            } else {
            }
        } elseif ($extension === 'rar') {
            // Assurez-vous que 'unrar' est installé sur votre serveur
            $process = new Process(['unrar', 'x', '-o+', $filePath, $decompressedPath]);
            $process->run();
            // Vérifie si la commande a réussi
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
        }

        // Appeler la fonction pour créer l'image Docker
        //$this->createDockerImage($decompressedPath, $folderName);
    }

    private function createDockerImage($path, $imageName)
    {
        // Commande pour construire l'image Docker
        // Assurez-vous que Docker est installé et que votre script a les droits nécessaires pour exécuter Docker
        $process = new Process(['docker', 'build', '-t', $imageName, $path]);
        $process->run();

        // Vérifie si la commande a réussi
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Commande pour pousser l'image vers Docker Hub
        // Remplacez 'username' par votre nom d'utilisateur Docker Hub et assurez-vous que vous êtes connecté à Docker Hub
        $process = new Process(['docker', 'push', "issa115/$imageName"]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}
