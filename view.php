<?php 

class Viewer {
    private $dbConnection;
    private $dbPropel;
    private $dbDefault;

    public function __construct(PostgreSQLConnection $dbConnection) {
        $this->dbConnection = $dbConnection;
        $this->dbPropel = new DataBaseActions($dbConnection);
        $this->dbDefault = new DataBaseActionsPDO($dbConnection);
    }

    public function displayTables($table_name = NULL) {
        $result = "";
    
        if ($table_name == NULL) {
            $result = "
                    <h2>Таблиці</h2><br>
                    <table class=\"table\">
                        <thead>
                            <tr>
                                <th>Назва таблиці</th>
                                <th>Кількість записів</th>
                            </tr>
                        </thead>
                        <tbody>
                  ";

            $tables = $this->dbPropel->getAllTables();

            foreach ($tables as $table) {
                $result .= "<tr>";
                $result .= "<td><a href=\"index.php?view_table={$table->getName()}\">{$table->getName()}</a></td>";
                $result .= "<td>{$this->dbPropel->countRows($table->getName())}</td>";
                $result .= "</tr>";
            }

            $result .= "    </tbody>
                        </table>
                        ";

        } else {
            $table_sanitized = trim(filter_var($table_name, FILTER_SANITIZE_SPECIAL_CHARS));
            $result = "<h2>$table_sanitized</h2><br>";

            $columns_data = $this->dbPropel->getColumnsNames($table_sanitized);
            $table_data = $this->dbPropel->getNecessaryTable($table_sanitized);
            $first_column_saved = false;
            $data_id = "";

            $result .= "
                        <table class=\"table\">
                            <thead>
                                <tr>
                        ";

            foreach ($columns_data as $column) {
                if (!$first_column_saved) {
                    $data_id = $column['column_name'];
                }
                $result .= "<th>{$column['column_name']}</th>";
                $first_column_saved = true;
            }

            $result .= "<th style=\"text-align: center;\" colspan=\"2\">Дії</th>";

            $result .= "       </tr>
                            </thead>
                            <tbody>
                        ";

            foreach ($table_data as $row) {
                $result .= "<tr>";

                foreach ($row as $cell) {
                    $result .= "<td>{$cell}</td>";
                }
                $result .= "<td><a href=\"index.php?edit_table=$table_sanitized&edit=$row[$data_id]\">Змінити</a></td>";
                $result .= "<td><a href=\"index.php?edit_table=$table_sanitized&delete=$row[$data_id]\">Видалити</a></td>";
                $result .= "</tr>";
            }

            $result .= "    </tbody>
                        </table>
                        ";
        }
    
        return $result;
    }
    public function addNote($table_name) {
        $table_sanitized = trim(filter_var($table_name, FILTER_SANITIZE_SPECIAL_CHARS));
        $result = "<h2>Додання запису до таблиці \"$table_sanitized\"</h2><br>";
        try {
            $pdo = $this->dbConnection->getConnection();
            $columns_data = $this->dbPropel->getColumnsNames($table_sanitized);
            $result .= "<form method=\"post\">";
            $id = 0;
            foreach($columns_data as $input) {
                if($id != 0) {
                    if (stripos($input['column_name'], 'date') !== false || stripos($input['column_name'], 'deadline') !== false) {
                        $result.=   "
                        <div class=\"form-group\">
                            <label for=\"input$id\">Поле \"{$input['column_name']}\"</label>
                            <input name=\"{$input['column_name']}\" type=\"date\" class=\"form-control\" placeholder=\"Введіть значення для поля '{$input['column_name']}'\">
                        </div>
                        ";
                    } else {
                        $result.=   "
                            <div class=\"form-group\">
                                <label for=\"input$id\">Поле \"{$input['column_name']}\"</label>
                                <input name=\"{$input['column_name']}\" type=\"text\" class=\"form-control\" placeholder=\"Введіть значення для поля '{$input['column_name']}'\">
                            </div>
                            ";
                    }
                }
                $id++;
            }
            $result.=   "
                            <button type=\"submit\" class=\"btn btn-primary\">Готово</button>
                        </form>
                        ";
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->dbPropel->dataNoteInsert($table_sanitized, $_POST);
            }
        } catch (PDOException $e) {
            echo "<br>Помилка виконання запиту: " . $e->getMessage();
        }
        return $result;
    }

    public function editTableNote($table_name, $note_id) {
        $note_id = trim(filter_var($note_id, FILTER_SANITIZE_SPECIAL_CHARS));
        $table_sanitized = trim(filter_var($table_name, FILTER_SANITIZE_SPECIAL_CHARS));
        $result = "<h2>Редагування запису №$note_id у таблиці \"$table_sanitized\"</h2><br>";
    
        try {
            $columns_data = $this->dbPropel->getColumnsNames($table_sanitized);
            $columns_content = $this->dbPropel->getColumnsContentById($table_sanitized, $note_id);
            
            $result .= "<form method=\"post\">";
            foreach ($columns_data as $input) {
                $column_name = $input['column_name'];        
                $foundColumns = array_filter($columns_content, function ($column) use ($column_name) {
                    return $column['column_name'] === $column_name;
                });
            
                foreach ($foundColumns as $index => $foundColumn) {
                    $value = isset($foundColumn['column_value']) ? $foundColumn['column_value'] : '';
            
                    if (strpos($column_name, 'Id') === false) {
                        $result .= "
                            <div class=\"form-group\">
                                <label for=\"{$column_name}\">Поле \"{$column_name}\"</label>
                                <input name=\"{$column_name}[$index]\" type=\"text\" value=\"$value\" class=\"form-control\" placeholder=\"Введіть значення для поля '{$column_name}'\">
                            </div>
                        ";
                    }
                }
            }
    
            $result .= "
                <button type=\"submit\" class=\"btn btn-primary\">Готово</button>
            </form>";
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->dbPropel->dataNoteUpdate($table_sanitized, $note_id, $_POST);
            }
        } catch (PDOException $e) {
            echo "<br>Помилка виконання запиту: " . $e->getMessage();
        }
    
        return $result;
    }
    
    public function deleteTableNote($table_name, $note_id) {
        $note_id = trim(filter_var($note_id, FILTER_SANITIZE_SPECIAL_CHARS));
        $table_sanitized = trim(filter_var($table_name, FILTER_SANITIZE_SPECIAL_CHARS));
        $result = "<h2>Видалення запису №$note_id з таблиці \"$table_sanitized\"</h2><br>";
        $this->dbPropel->dataNoteDelete($table_sanitized, $note_id);
        return $result;
    }
    public function dataTableFill($table_name) {
        $table_sanitized = trim(filter_var($table_name, FILTER_SANITIZE_SPECIAL_CHARS));
        $result = "<h2>Додання випадкових полів до таблиці \"$table_sanitized\"</h2><br>";

        $result .= "
                    <form method=\"post\">
                        <div class=\"form-group\">
                            <label for=\"input\">Введіть кількість нових випадкових полей для таблиці</label>
                            <input name=\"fillTable\" type=\"number\" min=\"1\" max=\"100000\" class=\"form-control\" placeholder=\"Введіть ціле значення від 0 до 100000  \">
                        </div>
                        <button type=\"submit\" class=\"btn btn-primary\">Створити</button>
                    </form>
                    ";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = $this->dbConnection->getConnection();
            $this->dbDefault->randomFillTable($pdo, $table_sanitized, $_POST);
        }
        return $result;
    }
    public function indexRequests() {
        echo "<h2>Індексні запити</h2><br>";
    
        $measureTime = function ($callback) {
            $start = microtime(true);
            $callback();
            $end = microtime(true);
            return ($end - $start) * 1000;
        };
    
        echo "# Btree - ТОП-5 найбільших заробітніх плат:<br>";
        $time1 = $measureTime(function () {
            echo $this->dbDefault->BtreeRequest(1);
        });
        echo "<b>Час виконання запиту: {$time1} мс</b><br><br>";
    
        echo "# Btree - ТОП-5 департаментів з найбільшою кількістю співробітників:<br>";
        $time2 = $measureTime(function () {
            echo $this->dbDefault->BtreeRequest(2);
        });
        echo "<b>Час виконання запиту: {$time2} мс</b><br><br>";

        echo "# Hash - Пошук кількості усіх співробітників з зарплатньою $450:<br>";
        $time3 = $measureTime(function () {
            echo $this->dbDefault->HashRequest(1);
        });
        echo "<b>Час виконання запиту: {$time3} мс</b><br><br>";
    
        echo "# Hash - Пошук кількості усіх співробітників з департамента №412:<br>";
        $time4 = $measureTime(function () {
            echo $this->dbDefault->HashRequest(2);
        });
        echo "<b>Час виконання запиту: {$time4} мс</b><br><br>";
    } 
}
?>

