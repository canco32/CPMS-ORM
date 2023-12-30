<?php

class PostgreSQLConnection {

    private $host = "localhost";
    private $port = 5432;
    private $database = "postgres";
    private $username = "postgres";
    private $password = "1";

    private $connection;

    public function __construct() {
        try {
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->database}";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Помилка підключення: " . $e->getMessage();
        }
    }

    public function disconnect() {
        $this->connection = null;
    }

    public function getConnection() {
        return $this->connection;
    }
}


class DataBaseActions {
    private $Employees;
    private $Department;
    private $Tasks;
    private $Project;

    public function __construct() {
        $this->Employees = new Employees();
        $this->Department = new Department();
        $this->Tasks = new Tasks();
        $this->Project = new Project();
    }

    public function dataNoteInsert($table_name, $data) {
        switch($table_name) {
            case "employees":
                try {
                    $this->Employees->setEmployeeName($data['EmployeeName']);
                    $this->Employees->setEmployeePosition($data['EmployeePosition']);
                    $this->Employees->setEmployeeDepartment($data['EmployeeDepartment']);
                    $this->Employees->setEmployeeSalary($data['EmployeeSalary']);
                    $this->Employees->save();
                    echo "Запис успішно додано.";
                } catch (Exception $e) {
                    echo "Помилка при додаванні запису: " . $e->getMessage();
                }
                break;
            case "tasks":
                try {
                    $this->Tasks->setTaskName($data['TaskName']);
                    $this->Tasks->setTaskProject($data['TaskProject']);
                    $this->Tasks->setTaskEmployee($data['TaskEmployee']);
                    $this->Tasks->setTaskDate($data['TaskDate']);
                    $this->Tasks->setTaskDeadline($data['TaskDeadline']);
                    $this->Tasks->save();
                    echo "Запис успішно додано.";
                } catch (Exception $e) {
                    echo "Помилка при додаванні запису: " . $e->getMessage();
                }
                break;
            case "department":
                try {
                    $this->Department->setDepartmentName($data['DepartmentName']);
                    $this->Department->save();
                    echo "Запис успішно додано.";
                } catch (Exception $e) {
                    echo "Помилка при додаванні запису: " . $e->getMessage();
                }
                break;
            case "project":
                try {
                    $this->Project->setProjectName($data['ProjectName']);
                    $this->Project->setProjectDepartment($data['ProjectDepartment']);
                    $this->Project->save();
                    echo "Запис успішно додано.";
                } catch (Exception $e) {
                    echo "Помилка при додаванні запису: " . $e->getMessage();
                }
                break;
            default:
                echo "Сталася невідома помилка, спробуйте ще раз!";
                break;
        }
    }

    public function dataNoteDelete($table_name, $id) {
        try {
            $modelClass = "\\Base\\{$table_name}Query";
            $record = $modelClass::create()->findPk($id);
    
            if ($record !== null) {
                $record->delete();
                echo "Запис успішно видалено.";
            } else {
                echo "Запис з вказаним ID не знайдено.";
            }
        } catch (Exception $e) {
            echo "Помилка при видаленні запису: " . $e->getMessage();
        }
    }    

    public function dataNoteUpdate($table_name, $id, $data) {
        try {
            $modelClass = "\\Base\\{$table_name}Query";
            $record = $modelClass::create()->findPk($id);
    
            if ($record !== null) {
                foreach ($data as $column => $value) {
                    $setterMethod = 'set' . ucfirst($column);
                    if (method_exists($record, $setterMethod)) {
                        $record->$setterMethod(reset($value));
                    }
                }
                $record->save();
                echo "Запис успішно оновлений.";
            } else {
                echo "Запис з вказаним ID не знайдена.";
            }
        } catch (Exception $e) {
            echo "Помилка при оновленні запису: " . $e->getMessage();
        }
    }

    public function getAllTables() {
        $databaseMap = Propel\Runtime\Propel::getDatabaseMap();
        $tables = $databaseMap->getTables();
        return $tables;
    }

    public function countRows($table_name) {
        $queryClass = "\\Base\\{$table_name}Query";
        $rowCount = $queryClass::create()->count();
        return $rowCount;
    }

    public function getColumnsNames($table_name, $limit = null) {
        $tableMapClass = "\\Map\\{$table_name}TableMap";
        $tableMap = $tableMapClass::getTableMap();
        
        $columns_names = [];
        
        foreach ($tableMap->getFieldNames() as $column) {
            $columns_names[] = [
                'column_name' => $column,
                'data_type'   => $tableMap->getColumn($column)->getType()
            ];
        }
        
        if ($limit !== null) {
            $columns_names = array_slice($columns_names, 0, $limit);
        }
        
        return $columns_names;
    }    
    
    public function getNecessaryTable($table_name, $note_id = null, $primary_key = null) {
        $tableClass = "\\Base\\{$table_name}Query";
        $query = $tableClass::create();
    
        if ($note_id !== null && $primary_key !== null) {
            $query->filterBy($primary_key, $note_id);
        }
    
        $table_content = $query->find();
    
        return $table_content->toArray();
    }

    public function getRecordById($table_name, $note_id) {
        $queryClass = "\\{$table_name}Query";
        $record = $queryClass::create()->findPk($note_id);
    
        return $record;
    }

    public function getColumnsContentById($table_name, $note_id) {
        $record = $this->getRecordById($table_name, $note_id);
    
        $columns_content = [];
        
        if ($record !== null) {
            foreach ($record->toArray() as $column_name => $column_value) {
                $columns_content[] = [
                    'column_name' => $column_name,
                    'column_value' => $column_value,
                ];
            }
        }
    
        return $columns_content;
    } 
}

class DataBaseActionsPDO {

    private $dbConnection;

    public function __construct(PostgreSQLConnection $dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function randomFillTable($pdo, $table_name, $form_data) {
        $faker = new Faker\Generator();
        $faker->addProvider(new Faker\Provider\uk_UA\Person($faker));
        $faker->addProvider(new Faker\Provider\uk_UA\Company($faker));
        $limit = $form_data['fillTable'];
        $startTime = microtime(true);
        $columns_data = $this->getColumnsNames($pdo, $table_name);
        $primary_key_name = $columns_data[0]['column_name'];
        $sql = "INSERT INTO \"$table_name\" (";
    
        foreach ($columns_data as $column) {
            $column_name = $column['column_name'];
            if ($column_name !== $primary_key_name) {
                $sql .= "$column_name, ";
            }
        }
    
        $sql = rtrim($sql, ", ") . ") VALUES ";
    
        for ($i = 0; $i < $limit; $i++) {
            $sql .= "(";
            foreach ($columns_data as $column) {
                $column_name = $column['column_name'];
                if($column_name !== $primary_key_name) {
                    switch($column_name) {
                        case "employee_department":
                            $sql .= "(SELECT department_id FROM \"department\" ORDER BY RANDOM() LIMIT 1), ";
                            break;
                        case "department_name":
                            $fake_department = $faker->company();
                            $sql .= "('$fake_department'),";
                            break;
                        case "employee_name":
                            $fake_name = $faker->name();
                            if (strpos($fake_name, "'") !== false) {
                                $fake_name = str_replace("'", "`", $fake_name);
                            }
                            $sql .= "('$fake_name'),";
                            break;
                        case "employee_position":
                            $fake_position = $faker->jobTitle();
                            $sql .= "('$fake_position'),";
                            break;
                        case "task_employee":
                            $sql .= "(SELECT employee_id FROM \"employees\" ORDER BY RANDOM() LIMIT 1), ";
                            break;
                        case "task_project":
                            $sql .= "(SELECT project_id FROM \"project\" ORDER BY RANDOM() LIMIT 1), ";
                            break;
                        case "project_department":
                            $sql .= "(SELECT department_id FROM \"department\" ORDER BY RANDOM() LIMIT 1), ";
                            break;
                        case "task_date":
                            $sql .= "
                                    (SELECT
                                    date_trunc('day', CURRENT_DATE - INTERVAL '1 month') +
                                    random() * (CURRENT_DATE - date_trunc('day', CURRENT_DATE - INTERVAL '1 month')) AS random_date
                                    ), 
                                    ";
                            break;
                        case "task_deadline":
                                $sql .= "
                                        (SELECT
                                        CURRENT_DATE +
                                        random() * INTERVAL '6 months' AS random_date
                                        )
                                        ";
                                break;
                        case "employee_salary":
                            $sql .= "('$' || floor(random() * (10000 - 300 + 1) + 300)::int), ";
                            break;
                        default: 
                            $sql .= $this->generateRandomSqlValue($column) . ", ";
                            break;
                    }
                }
            }
            $sql = rtrim($sql, ", ") . "), ";
        }
    
        $sql = rtrim($sql, ", ") . ";";
    
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    
        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000;
        echo "Запит виконано за " . number_format($executionTime, 2, '.', ' ') . " мс";
    }
    

    private function generateRandomSqlValue($column) {
        switch ($column['data_type']) {
            case 'integer':
                return 'floor(random() * 100)';
            case 'character varying':
                return "(SELECT left(md5(random()::text), 10))"; 
            default:
                return 'NULL';
        }
    }

    private function getColumnsNames(PDO $pdo, $table_name, $limit = NULL) {
        if($limit == NULL) {
            $sql = "SELECT column_name, data_type FROM information_schema.columns WHERE table_name = '$table_name' ORDER BY ordinal_position";
        } else {
            $sql = "SELECT column_name, data_type FROM information_schema.columns WHERE table_name = '$table_name' ORDER BY ordinal_position LIMIT $limit";
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    
        $columns_names = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $columns_names;
    }

    public function dataTableDelete($table_name) {
        $table_sanitized = trim(filter_var($table_name, FILTER_SANITIZE_SPECIAL_CHARS));
        $result = "<h2>Видалення таблиці \"$table_sanitized\"</h2><br>";

        try {
            $pdo = $this->dbConnection->getConnection();
            if ($this->checkForeignKey($table_sanitized)) {
                $result .= "<p>Таблиця містить зовнішній ключ. Видаліть зовнішній ключ перед видаленням таблиці.</p>";
            } else {
                $sql = $this->generateDeleteTableSQL($table_sanitized);
                $pdo->exec($sql);

                $result .= "<p>Таблиця \"$table_sanitized\" успішно видалено.</p>";
            }
        } catch (PDOException $e) {
            $result .= "<br>Помилка виконання запиту: " . $e->getMessage();
        }

        return $result;
    }

    public function cascadeTruncate($table_name) {
        $table_sanitized = trim(filter_var($table_name, FILTER_SANITIZE_SPECIAL_CHARS));
        $result = "<h2>Каскадне очищення таблиці \"$table_sanitized\"</h2><br>";

        try {
            $pdo = $this->dbConnection->getConnection();
            $sql = $this->generateTruncateTableSQL($table_sanitized);
            $pdo->exec($sql);
            $result .= "<p>Таблиця \"$table_sanitized\" та усі залежні від неї таблиці каскадно очищені.</p>";
        } catch (PDOException $e) {
            $result .= "<br>Помилка каскадного видалення: " . $e->getMessage();
        }

        return $result;
    }

    public function BtreeRequest($num) {
        $pdo = $this->dbConnection->getConnection();
        $result = "";
        switch($num) {
            case 1:
                # Btree - ТОП-5 найбільших заробітніх плат
                try {
                    $sqlCreateIndex = "CREATE INDEX IF NOT EXISTS idx_employee_salary_btree ON employees (employee_salary DESC);";
                    $pdo->exec($sqlCreateIndex);
                
                    $sqlTopSalaries = "SELECT employee_id, employee_name, employee_salary 
                                      FROM employees
                                      ORDER BY employee_salary DESC
                                      LIMIT 5;";
                                      
                    $stmt = $pdo->query($sqlTopSalaries);
                    $result_request = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $i = 1;
                    foreach ($result_request as $row) {
                        $result .= "#{$i} - (№{$row['employee_id']}) {$row['employee_name']}, {$row['employee_salary']} <br>";
                        $i++;
                    }
                } catch (PDOException $e) {
                    $result = "<br>Помилка (# Btree - ТОП-5 найбільших заробітніх плат): " . $e->getMessage();
                }
                
                break;
            case 2:
                # Btree - ТОП-5 департаментів з найбільшою кількістю співробітників
                try {
                    $sqlCreateIndex = "CREATE INDEX IF NOT EXISTS idx_employee_department_btree ON employees (employee_department);";
                    $pdo->exec($sqlCreateIndex);

                    $sqlTopDepartments = "SELECT employee_department, COUNT(*) as employee_count
                                          FROM employees
                                          GROUP BY employee_department
                                          ORDER BY employee_count DESC
                                          LIMIT 5;";
                    $stmt = $pdo->query($sqlTopDepartments);
                    $result_request = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $i = 1;
                    foreach ($result_request as $row) {
                        $result .= "#{$i} - Департамент №{$row['employee_department']} - кількість співробітників: {$row['employee_count']} <br>";
                        $i++;
                    }
                } catch (PDOException $e) {
                    $result = "<br>Помилка (ТОП-5 департаментів): " . $e->getMessage();
                }                
                break;
            default:
                $result = "<br>Помилка виконання Btree запиту";
                break;
        }
        
        return $result;
    }

    public function HashRequest($num) {
        $pdo = $this->dbConnection->getConnection();
        switch($num) {
            case 1:
                # Hash  - Пошук кількості усіх співробітників з зарплатньою $450
                try {
                    $sqlCreateIndex = "CREATE INDEX IF NOT EXISTS idx_salary_hash ON employees USING HASH (employee_salary);";
                    $pdo->exec($sqlCreateIndex);

                    $targetSalary = '$450';
                    $sqlEmployeeCount = "SELECT COUNT(*) as employee_count
                                        FROM employees
                                        WHERE employee_salary = :targetSalary;";
                                        
                    $stmt = $pdo->prepare($sqlEmployeeCount);
                    $stmt->bindParam(':targetSalary', $targetSalary, PDO::PARAM_INT);
                    $stmt->execute();
                    
                    $result = "Співробітників - ". $stmt->fetch(PDO::FETCH_ASSOC)['employee_count'] . "<br>";
                } catch (PDOException $e) {
                    $result = "<br>Помилка (Пошук кількості співробітників із зарплатою $450): " . $e->getMessage();
                }
                break;
            case 2:
                # Hash  - Пошук кількості усіх співробітників з департамента №412
                try {
                    $sqlCreateIndex = "CREATE INDEX IF NOT EXISTS idx_department_hash ON employees USING HASH (employee_department);";
                    $pdo->exec($sqlCreateIndex);
                
                    $targetDepartment = 412;
                    $sqlEmployeeCount = "SELECT COUNT(*) as employee_count
                                        FROM employees
                                        WHERE employee_department = :targetDepartment;";
                                        
                    $stmt = $pdo->prepare($sqlEmployeeCount);
                    $stmt->bindParam(':targetDepartment', $targetDepartment, PDO::PARAM_INT);
                    $stmt->execute();
                    
                    $result = "Співробітників - ". $stmt->fetch(PDO::FETCH_ASSOC)['employee_count'] . "<br>";
                } catch (PDOException $e) {
                    $result = "<br>Помилка (Пошук кількості співробітників з департамента №412): " . $e->getMessage();
                }
                break;
            default:
                $result = "<br>Помилка виконання Hash запиту";
                break;
        }
        return $result;
    }

    private function checkForeignKey($table_name) {
        $pdo = $this->dbConnection->getConnection();
        $sql = "SELECT COUNT(*) FROM information_schema.table_constraints 
                WHERE constraint_type = 'FOREIGN KEY' AND table_name = :table_name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':table_name', $table_name, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        return $count > 0;
    }

    private function generateDeleteTableSQL($table_name) {
        return "DROP TABLE IF EXISTS \"$table_name\"";
    } 

    private function generateTruncateTableSQL($table_name) {
        return "TRUNCATE \"$table_name\" RESTART IDENTITY CASCADE";
    }
} 

?>