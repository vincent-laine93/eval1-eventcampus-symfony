<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ApiController extends AbstractController
{
    #[Route('/api/evenements', name: 'app_api')]
    public function index(): Response
    {
        $evenements = $this->getEvenements();
        $evenementsJson = $this->json($evenements);
//        echo "<pre>";
//        var_dump($evenementsJson);
//        echo "</pre>";
        return $this->render('api/index.html.twig', [
            'evenements' => $evenementsJson,
        ]);
    }

    #[Route('/api/evenements/{id}', name: 'app_api_id')]
    public function getApiId(int $id): Response
    {
        $evenements = $this->getEvenements();

        // Filtrer l'événement correspondant à l'id
        $evenementsFilter = array_filter($evenements, function ($event) use ($id) {
            return isset($event['id']) && $event['id'] == $id;
        }) ?? null;

        if (!$evenementsFilter) {
            throw new NotFoundHttpException("Cet événement n'existe pas.");
        }

        $evenement = array_shift($evenementsFilter);
        $evenementJson = $this->json($evenement);


//        echo "<pre>";
//        var_dump($evenementsJson);
//        echo "</pre>";
        return $this->render('api/id/index.html.twig', [
            'evenementJson' => $evenementJson,
            'evenement' => $evenement,
        ]);
    }

    public function getEvenements():array
    {
        return [
            1 => [
                'id' => 1,
                'titre' => 'Soirée Étudiante Halloween',
                'description' => 'Grande soirée costumée pour célébrer Halloween au campus !',
                'date_debut' => '2024-10-31 20:00:00',
                'date_fin' => '2024-11-01 02:00:00',
                'lieu' => 'Amphithéâtre Central',
                'categorie' => 'festif',
                'organisateur' => 'BDE Campus',
                'prix' => 8.0,
                'places_disponibles' => 150,
                'places_totales' => 200,
                'image' => 'halloween.jpg',
                'statut' => 'ouvert'
            ],
            2 => [
                'id' => 2,
                'titre' => 'Tournoi Inter-campus de Football',
                'description' => 'Compétition sportive amicale entre plusieurs campus de la région.',
                'date_debut' => '2024-11-15 10:00:00',
                'date_fin' => '2024-11-15 18:00:00',
                'lieu' => 'Stade Universitaire',
                'categorie' => 'sportif',
                'organisateur' => 'Club Sportif',
                'prix' => 0.0,
                'places_disponibles' => 300,
                'places_totales' => 300,
                'image' => 'football.jpg',
                'statut' => 'ouvert'
            ],
            3 => [
                'id' => 3,
                'titre' => 'Atelier Théâtre Associatif',
                'description' => 'Initiation au théâtre avec la troupe associative du campus.',
                'date_debut' => '2024-12-01 15:00:00',
                'date_fin' => '2024-12-01 18:00:00',
                'lieu' => 'Salle Théâtre',
                'categorie' => 'associatif',
                'organisateur' => 'Association Culturelle',
                'prix' => 5.0,
                'places_disponibles' => 40,
                'places_totales' => 50,
                'image' => 'theatre.jpg',
                'statut' => 'ouvert'
            ],
            4 => [
                'id' => 4,
                'titre' => 'Conférence sur la Culture Numérique',
                'description' => 'Une conférence enrichissante organisée par le club informatique.',
                'date_debut' => '2024-11-22 14:00:00',
                'date_fin' => '2024-11-22 16:00:00',
                'lieu' => 'Amphithéâtre Principal',
                'categorie' => 'culturel',
                'organisateur' => 'Club Informatique',
                'prix' => 0.0,
                'places_disponibles' => 150,
                'places_totales' => 150,
                'image' => 'conference.jpg',
                'statut' => 'ouvert'
            ],
            5 => [
                'id' => 5,
                'titre' => 'Soirée Karaoké Étudiante',
                'description' => 'Ambiance festive garantie avec karaoké organisé par le BDE.',
                'date_debut' => '2024-12-10 20:00:00',
                'date_fin' => '2024-12-11 00:00:00',
                'lieu' => 'Bar Étudiant',
                'categorie' => 'festif',
                'organisateur' => 'BDE Campus',
                'prix' => 5.0,
                'places_disponibles' => 80,
                'places_totales' => 100,
                'image' => 'karaoke.jpg',
                'statut' => 'ouvert'
            ],
            6 => [
                'id' => 6,
                'titre' => 'Collecte Solidaire pour une Association',
                'description' => 'Organisation d’une collecte de vêtements et nourriture pour les plus démunis.',
                'date_debut' => '2024-11-20 09:00:00',
                'date_fin' => '2024-11-20 18:00:00',
                'lieu' => 'Hall d\'entrée',
                'categorie' => 'associatif',
                'organisateur' => 'Association Étudiante Solidaire',
                'prix' => 0.0,
                'places_disponibles' => 200,
                'places_totales' => 200,
                'image' => 'collecte.jpg',
                'statut' => 'ouvert'
            ],
            7 => [
                'id' => 7,
                'titre' => 'Randonnée Sportive en Montagne',
                'description' => 'Sortie organisée pour une journée sportive en pleine nature.',
                'date_debut' => '2024-11-30 07:00:00',
                'date_fin' => '2024-11-30 19:00:00',
                'lieu' => 'Point de ralliement campus',
                'categorie' => 'sportif',
                'organisateur' => 'Club Montagne',
                'prix' => 10.0,
                'places_disponibles' => 30,
                'places_totales' => 30,
                'image' => 'randonnee.jpg',
                'statut' => 'ouvert'
            ],
            8 => [
                'id' => 8,
                'titre' => 'Festival de Musique Étudiant',
                'description' => 'Concerts et animations musicales organisés par les associations du campus.',
                'date_debut' => '2024-12-05 18:00:00',
                'date_fin' => '2024-12-05 23:00:00',
                'lieu' => 'Cour Principale',
                'categorie' => 'festif',
                'organisateur' => 'Union des Associations',
                'prix' => 12.0,
                'places_disponibles' => 300,
                'places_totales' => 350,
                'image' => 'festival.jpg',
                'statut' => 'ouvert'
            ],
        ];
    }
}
