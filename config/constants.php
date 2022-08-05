<?php
return [
    'statut' => [
        'besoins' => [],
        'ligne_besoins' => [],
        'factures' => [],
        'ligne_factures' => [],
    ],

    'roles' => [
        'ad' => "Assistante de direction",
        'admvente' => 'Administrateur des ventes',
        'admin' => "Administrateur système",
        'caisse' => 'Caissière',
        'chgachat' => "Responsable des achats",
        'chefcomptable' => "Reviseur comptable",
        'comptable' => "Assistant comptable",
        'dg' => "Administrateur général",
        'drh' => "Directeur RH",
        'geststock' => "Gestionnaire des stocks",
        'superadmin' => "Super administrateur",
    ],

    /**
     * Liste des permissions de base par module
     * Toutes les actions possible à mener sur un module par tous les acteurs
     */
    'permissions' => [
        'achat' => [

        ],
        'administration' => [

        ],
        'general' => [

        ],
        'stock' => [

        ],
    ],
];
