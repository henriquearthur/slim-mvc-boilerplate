<?php

namespace App\Model\Core;

class Database extends \PDO
{
    /**
     * Insert row in a table
     * @param  string $table table name
     * @param  array  $data  row columns
     * @return boolean       success on insert
     */
    public function insert(string $table, array $data)
    {
        if (empty($table)) {
            throw new \Exception("Table name not provided.");
        }

        if (empty($data)) {
            throw new \Exception("Data to be inserted on the table not provided.");
        }

        $columns = array();
        $values = array();

        foreach ($data as $column => $value) {
            ($value === null) ? $value = '':  '';

            $columns[] = $column;
            $values[] = $value;
        }

        if (count($columns) != count($values)) {
            throw new \Exception("The count of columns and its values are not equal.");
        }

        $columnsQuery = implode(",", $columns);
        $valuesQuery = array();

        foreach ($columns as $current) {
            $valuesQuery[] = '?';
        }

        $valuesQuery = implode(",", $valuesQuery);

        $query = "INSERT INTO {$table} ({$columnsQuery}) VALUES ({$valuesQuery})";

        $sql = $this->prepare($query);

        for ($i = 0; $i < count($columns); $i++) {
            $realI = $i + 1;

            $sql->bindValue($realI, $values[$i]);
        }

        $exec = $sql->execute();

        if (!$exec) {
            throw new \Exception($this->errorInfo());
        }

        return true;
    }

    /**
     * Update row in a table
     * @param  string $table  table name
     * @param  array  $data   row columns
     * @param  array  $where  conditions
     * @return boolean        success on update
     */
    public function update(string $table, array $data, array $where = array())
    {
        if (empty($table)) {
            throw new \Exception("Table name not provided.");
        }

        if (empty($data)) {
            throw new \Exception("Data to be updated on the table not provided.");
        }

        $columns = array();
        $values = array();
        $conditionsCol = array();
        $conditionsVal = array();

        foreach ($data as $column => $value) {
            ($value === null) ? $value = '':  '';

            $columns[] = $column;
            $values[] = $value;
        }

        foreach ($where as $column => $value) {
            $conditionsCol[] = $column;
            $conditionsVal[] = $value;
        }

        if (count($columns) != count($values)) {
            throw new \Exception("The count of columns and its values from SET block are not equal.");
        }

        if (count($conditionsCol) != count($conditionsVal)) {
            throw new \Exception("The count of columns and its values from WHERE block are not equal.");
        }

        $i = 0;
        $setQuery = '';
        foreach ($columns as $current) {
            $setQuery .= $current . '=?,';

            $i++;
        }

        $setQuery = substr($setQuery, 0, -1);

        if (empty($where)) {
            $query = "UPDATE {$table} SET {$setQuery}";
        } else {
            $whereQuery = '';

            foreach ($where as $column => $value) {
                $whereQuery .= $column . '=? AND ';
            }

            $whereQuery = substr($whereQuery, 0, -strlen(' AND '));

            $query = "UPDATE {$table} SET {$setQuery} WHERE {$whereQuery}";
        }

        $sql = $this->prepare($query);

        for ($i = 0; $i < count($columns); $i++) {
            $realI = $i + 1;

            $sql->bindValue($realI, $values[$i]);
        }

        for ($i = 0; $i < count($conditionsCol); $i++) {
            $realI = $realI + 1;

            $sql->bindValue($realI, $conditionsVal[$i]);
        }

        $exec = $sql->execute();

        if (!$exec) {
            throw new \Exception($this->errorInfo());
        }

        return true;
    }

    /**
     * Delete row in a table
     * @param  string $table  table name
     * @param  array  $where  conditions
     * @return boolean        success on delete
     */
    public function delete(string $table, array $where = array())
    {
        $conditionsCol = array();
        $conditionsVal = array();

        foreach ($where as $column => $value) {
            ($value === null) ? $value = '':  '';

            $conditionsCol[] = $column;
            $conditionsVal[] = $value;
        }

        if (count($conditionsCol) != count($conditionsVal)) {
            throw new \Exception("The count of columns and its values from WHERE block are not equal.");
        }

        $whereQuery = '';
        foreach ($where as $column => $value) {
            $whereQuery .= $column . '=? AND ';
        }

        $whereQuery = substr($whereQuery, 0, -strlen(' AND '));

        $query = "DELETE FROM {$table} WHERE {$whereQuery}";

        $sql = $this->prepare($query);

        for ($i=0; $i < count($conditionsCol); $i++) {
            $realI = $i + 1;

            $sql->bindValue($realI, $conditionsVal[$i]);
        }

        $exec = $sql->execute();

        if (!$exec) {
            throw new \Exception($this->errorInfo());
        }

        return true;
    }

    /**
     * Get ID of last inserted row
     * @return string row ID of last inserted row
     */
    public function getLastInsertId()
    {
        return $this->lastInsertId();
    }

    /**
     * Get value from $column in a $table with a specific $id
     * @param  string  $column column name
     * @param  string  $table  table name
     * @param  integer $id    row id (primary key)
     * @return mixed          value
     */
    public function getValueFrom($column, $table, $id)
    {
        $sql = $this->prepare("SELECT {$column} FROM {$table} WHERE id = ?");

        $sql->bindValue(1, $id);
        $sql->execute();

        $val = $sql->fetchColumn();

        return $val;
    }
}
