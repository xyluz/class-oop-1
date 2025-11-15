<?php namespace App\SharedClasses;

use PDO;
use PDOException;
use PDOStatement;

class Database {

    protected ?PDO $pdo = null;
    protected ?PDOStatement $stmt;

    public function __construct(){

        $this->connect();

    }

    /**
     * @return PDO|string|null
     */
    public function connect(): PDO|string|null
    {

        try{

            if($this->pdo) return $this->pdo;

            if ( !extension_loaded('pdo') ) return "PDO is not enabled on this machine. PDO is required for this application";

            $dsn = 'mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'];
            $this->pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ));
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch (PDOException $e){
            dd("[".date('Y-m-d H:i:s')."] DB Connection failed: " . $e->getMessage());
        }


        return $this->pdo;

    }

    public function isConnected(): bool {
        return $this->pdo instanceof PDO;
    }

    /**
     * @param string $query
     * @return Database
     */
    public function prepare(string $query): static
    {
        $this->stmt = $this->pdo->prepare($query);
        return $this;
    }

    /**
     * @param string|int $param
     * @param mixed $value
     * @param int|null $type
     * @return void
     */
    public function bind(string|int $param, mixed $value, ?int $type = null): void
    {
        if (empty($type)) {
            $type = match (true) {
                is_int($value) => PDO::PARAM_INT,
                is_bool($value) => PDO::PARAM_BOOL,
                is_null($value) => PDO::PARAM_NULL,
                default => PDO::PARAM_STR,
            };
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function multiBind(array $params, array $values): void
    {
        foreach($params as $key => $param){
            $this->bind($param, $values[$param]);
        }

    }

    /**
     * @return mixed
     */
    public function execute(): mixed
    {
        try {

            return $this->stmt->execute();

        } catch (\PDOException $e) {

            dd($e);
            dd("[" . date('Y-m-d H:i:s') . "] Query execution failed: " . $e->getMessage());

        }
    }

    /**
     * @param int $result_type
     * @return mixed
     */
    public function resultset(int $result_type = PDO::FETCH_ASSOC): mixed
    {
        try {

            $this->execute();
            return $this->stmt->fetchAll($result_type);

        } catch (\PDOException $e) {

            dd( $e );

        } finally {
            $this->stmt = null;
        }
    }

    /**
     * @return mixed
     */
    public function single(): mixed{

        try {

            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {

           dd( $e );


        } finally {
            $this->stmt = null;
        }
    }

    /**
     * @return mixed
     */
    public function rowCount(): mixed{
        return $this->stmt->rowCount();
    }

    /**
     * @return mixed
     */
    public function columnCount(): mixed
    {
        return $this->stmt->columnCount();
    }

    /**
     * @return mixed
     */
    public function lastInsertId(): mixed
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * @return mixed
     */
    public function beginTransaction(): mixed
    {
        return $this->pdo->beginTransaction();
    }

    /**
     * @return mixed
     */
    public function endTransaction(): mixed
    {
        return $this->pdo->commit();
    }

    /**
     * @return mixed
     */
    public function cancelTransaction(): mixed
    {
        return $this->pdo->rollBack();
    }

    /**
     * Debug Function
     */
    public function debugDumpParams(){
        return $this->stmt->debugDumpParams();
    }

    /**
     * @return void
     */
    public function disable_only_full_group_by_option(): void
    {
        try {

            $this->prepare("SET SESSION sql_mode = REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', '');");
            $this->execute();
            dd("[" . date('Y-m-d H:i:s') . "] ONLY_FULL_GROUP_BY disabled for session.");

        } catch (\PDOException $e) {

            dd("[" . date('Y-m-d H:i:s') . "] Failed to disable ONLY_FULL_GROUP_BY: " . $e->getMessage());

        }
    }

    public function disable_foreign_key_checks(): void{
        $this->prepare("SET FOREIGN_KEY_CHECKS=0;");
        $this->execute();
    }

    public function enable_foreign_key_checks(): void{
        $this->prepare("SET FOREIGN_KEY_CHECKS=1;");
        $this->execute();
    }

    public function __destruct()
    {
        $this->pdo = null;

    }
}