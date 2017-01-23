<?php
class Database extends PDO
{
  public static $instance = null;

  /* Constructor */
  public function __construct() {
    parent::__construct(DB_TYPE.':host='.MYSQL_HOSTNAME.';dbname='.MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD);
    parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    parent::exec("SET NAMES utf8");
  }

  /* Singleton instance to database object. */
  public static function getInstance() {
    if(!isset(self::$instance)) {
        self::$instance = new Database();
    }
    return self::$instance;
  }

  /*
   * Determines the amount of rows affected by the passed SQL-statement.
   *
   * @param sql SQL-statement to determine the row count for.
   * @return Amout of rows affected by the passed SQL-statement.
   */
  public function rowCount($sql) {
    $sth = $this->prepare($sql);
    $sth->execute();

    return $sth->rowCount();
  }

  /*
   * Determines the amount of columns affected by the passed SQL-statement.
   *
   * @param sql SQL-statement to determine the column count for.
   * @return Amout of columns affected by the passed SQL-statement.
   */
  public function columnCount($sql) {
    $sth = $this->prepare($sql);
    $sth->execute();

    return $sth->columnCount();
  }

  /*
   * Executes the passed query.
   *
   * @param sql SQL-statement to execute.
   * @return Result of the executed SQL-statement.
   */
  public function query($sql) {
    $sth = $this->prepare($sql);
    $sth->execute();

    return $sth;
  }

  /*
   * Fetches all results from the passed SQL-statement into a data structure.
   *
   * @param tableName Name of target table.
   * @param data array containing data to replace in the SQL-statement (format: 'columnName' => 'value').
   * @param fetchMode Type of the data-structure to return. (FETCH_OBJ = anonymous object, FETCH_ASSOC = assosiativ array)
   * @return Result of the SQL-statement as data-structure.
   */
  public function select($sql, $data = array(), $fetchMode = PDO::FETCH_OBJ) {
    $sth = $this->prepare($sql);
    if(is_array($data)) {
      foreach($data as $key => $value) {
        $sth->bindValue(":$key", $value);
      }
    }
    $sth->execute();

    return $sth->fetchAll($fetchMode);
  }

  /*
   * Inserts the passed data into the given table.
   *
   * @param tableName Name of target table.
   * @param data array containing the data to insert (format: 'columnName' => 'value').
   */
  public function insert($tableName, $data) {
    ksort($data);

    $fieldNames = implode('`, `', array_keys($data));
    $fieldValues = ':'.implode(', :', array_keys($data));

    $sth = $this->prepare("INSERT INTO $tableName (`$fieldNames`) VALUES ($fieldValues)");

    foreach($data as $key => $value) {
      $sth->bindValue(":$key", $value);
    }

    $sth->execute();
  }

  /*
   * Deletes a specifc data record in a table.
   *
   * @param tableName Name of target table.
   * @param id identifier of the record to delete.
   */
  public function delete($table, $id) {
    $sth = $this->prepare("DELETE FROM $table WHERE id = $id");
    $sth->execute();
  }

  /*
   * Updates a specific data record with the passed data.
   *
   * @param tableName Name of target table.
   * @param data array containing the data to insert (format: 'columnName' => 'value').
   * @param id identifier of the database record to update.
   */
  public function update($table, $data, $id) {
    ksort($data);

    $fieldDetails = null;
    foreach($data as $key => $value) {
      $fieldDetails .= "`$key` = :$key,";
    }

    $fieldDetails = rtrim($fieldDetails, ',');

    $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE id = $id");

    foreach($data as $key => $value) {
      $sth->bindValue(":$key", $value);
    }

    $sth->execute();
  }
}
?>
