<?php

namespace Edsp\Mvc\Repositories;

use Edsp\Mvc\ExpandedObject;
use Edsp\Mvc\Repositories\Interfaces\IRepository;
use PDO;

class Repository extends ExpandedObject implements IRepository
{
    private const CONNECTION_ALIAS = 'default';
    private const USER = 'root';
    private const PASS = '';
    // TODO: Remover USER e PASS, e passar a buscar dinamicamente

    private PDO $connection;

    public function getConnection(): PDO
    {
        $dsn = parse_ini_file(DB_CONFIG_PATH)['dsn.' . self::CONNECTION_ALIAS];
        return $this->connection ??
            new PDO($dsn, self::USER, self::PASS);
    }


}