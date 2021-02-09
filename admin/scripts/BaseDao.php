<?php

abstract class BaseDao
{
    private PDO $pdo;

    /**
     * BaseDao constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        if ($pdo === null) die("Invalid PDO Argument");
        $this->pdo = $pdo;
    }


    protected final function query(string $sql): array
    {
        $res = [];
        $stm = $this->pdo->query($sql);
        if ($stm)
            while ($row = $stm->fetch(PDO::FETCH_ASSOC))
                $res[] = $row;

        return $res;
    }

    protected final function execute(string $sql, bool $isScalar = false, string ...$args) : ?array
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if($res === false || !$isScalar) return null;
        return $res;
    }

    protected final function lstInsertedId(string $name = null): string
    {
        return $this->pdo->lastInsertId($name);
    }
}