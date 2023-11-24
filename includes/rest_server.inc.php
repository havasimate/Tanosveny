<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function connectToDatabase()
{
    return new PDO('mysql:host=localhost;dbname=tanosveny', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

function executeQuery(PDO $dbh, $sql, $params = array())
{
    $sth = $dbh->prepare($sql);
    $sth->execute($params);
    return $sth;
}

function getAllNpRecords()
{
    try {
        $dbh = connectToDatabase();
        $sql = "SELECT * FROM np";
        $sth = executeQuery($dbh, $sql);

        $result = '<table class="table table-bordered"><tr><th>ID</th><th>Név</th><th>Műveletek</th></tr>';

        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $result .= '<tr>';
            foreach ($row as $column) {
                $result .= '<td class="border px-3">' . $column . '</td>';
            }

            $result .= '<td class="border px-3">
                <button class="btn btn-info updateButton" data-id="' . $row['id'] . '">Módosítás</button>
                <button class="btn btn-danger deleteButton" data-id="' . $row['id'] . '">Törlés</button>
            </td>';

            $result .= '</tr>';
        }

        $result .= '</table>';
        return $result;
    } catch (Exception $e) {
        return 'Hiba történt: ' . $e->getMessage();
    }
}

function insertNpRecord($nev)
{
    if (is_null($nev) || strlen($nev) > 42 || strlen($nev) < 1) {
        http_response_code(400);
        return "A név nem lehet üres és nem lehet hosszabb 42 karakternél!";
    } else {
        try {
            $dbh = connectToDatabase();
            $sql = 'INSERT INTO np VALUES (NULL, :nev)';
            $params = array(':nev' => $nev);
            executeQuery($dbh, $sql, $params);

            $newid = $dbh->lastInsertId();
            return '1 beszúrt sor: ' . $newid;
        } catch (Exception $e) {
            return 'Hiba történt: ' . $e->getMessage();
        }
    }
}

function updateNpRecord($id, $nev)
{
    if (is_null($id) || is_null($nev) || strlen($id) < 1 || strlen($nev) < 1 || strlen($nev) > 42) {
        http_response_code(400);
        return "Az id és/vagy a név nem lehet üres. A név nem lehet hosszabb 42 karakternél!";
    } else {
        try {
            $dbh = connectToDatabase();
            $modositando = 'id=id';
            $params = array(':id' => $id);

            if ($nev != "") {
                $modositando .= ', nev = :nev';
                $params[':nev'] = $nev;
            }

            $sql = "UPDATE np SET $modositando WHERE id=:id";
            $sth = executeQuery($dbh, $sql, $params);

            return $sth->rowCount() . ' módosított sor. Azonosítója: ' . $id;
        } catch (Exception $e) {
            return 'Hiba történt: ' . $e->getMessage();
        }
    }
}

function deleteNpRecord($id)
{
    if (is_null($id) || strlen($id) < 1) {
        http_response_code(400);
        return "Az id nem lehet üres";
    } else {
        try {
            $dbh = connectToDatabase();
            $sql = 'DELETE FROM np WHERE id=:id';
            $params = array(':id' => $id);
            $sth = executeQuery($dbh, $sql, $params);

            return $sth->rowCount() . ' sor törölve. Azonosítója: ' . $id;
        } catch (Exception $e) {
            return 'Hiba történt: ' . $e->getMessage();
        }
    }
}

$eredmeny = '';

try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            $eredmeny = getAllNpRecords();
            break;
        case 'POST':
            $eredmeny = insertNpRecord($_POST['nev']);
            break;
        case 'PUT':
            parse_str(file_get_contents('php://input'), $data);
            $eredmeny = updateNpRecord($data['id'], $data['nev']);
            break;
        case 'DELETE':
            parse_str(file_get_contents('php://input'), $data);
            $eredmeny = deleteNpRecord($data['id']);
            break;
    }
} catch (Exception $e) {
    $eredmeny = 'Hiba történt: ' . $e->getMessage();
}

echo $eredmeny;
