<?php

namespace models;

use PDO;

class Database
{
    private $pdo;

    /**
     * Constructeur de Base de données, utilise les variables d'environement pour se connecter.
     */
    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
    }

    /**
     * @param string $query la commande sql a executer.
     * @return array|false return un tableau associatif avec les résultat de la requête.
     */
    public function fetchAll(string $query)
    {
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $query la commande sql a executer.
     * @return mixed return le résultat de la requête.
     */
    public function fetch(string $query)
    {
        return $this->pdo->query($query)->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $query la commande sql a executer.
     * @param array $var tableau avec les variables à bind.
     * @return mixed return le résultat de la requête.
     */
    public function prepare(string $query, array $var)
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($var);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $query la commande sql a executer.
     * @param array $var tableau avec les variables à bind.
     * @return array|false return un tableau associatif avec les résultat de la requête.
     */
    public function prepareAll(string $query, array $var)
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($var);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return false|string the last Insert Id in the models.
     */
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }


}