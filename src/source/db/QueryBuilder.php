<?php
namespace app\source\db;

/**
 * Trait QueryBuilder
 *
 * This trait provides methods for building SQL queries.
 */
trait QueryBuilder {
    /**
     * Inserts data into the specified table.
     *
     * @param string $table The name of the table.
     * @param array $columns The columns to insert data into.
     * @param array $values The values to insert.
     * @return string The SQL query.
     */
    public function insert(string $table, array $columns, array $values): string {
        // Implement the insert method here
        return 'INSERT INTO ' . $table . ' (' . implode(', ', $columns) . ') VALUES (' . implode(', ', $values) . ')';
    }

    /**
     * Deletes data from the specified table based on the given condition.
     *
     * @param string $table The name of the table.
     * @param array $condition The condition for deletion.
     * @return string The SQL query.
     */
    public function delete(string $table, array $condition): string {
        return 'DELETE FROM ' . $table . ' WHERE ' . implode(', ', $condition) . '';
        // Implement the delete method here
    }
}