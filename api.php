<?php
    require_once("db_query.php");

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if ($_SERVER['PATH_INFO'] == '/movies') {

            if (isset($_GET['title'])) {
                $user_input = $_GET['title'];
                $filter = 'title';
            } else if (isset($_GET['synopsis'])) {
                $user_input = $_GET['synopsis'];
                $filter = 'synopsis';
            } else if (isset($_GET['duration'])) {
                $user_input = $_GET['duration'];
                $filter = 'duration';
            } else if (isset($_GET['released_year'])) {
                $user_input = $_GET['released_year'];
                $filter = 'released_year';
            } else {
                $user_input = NULL;
                $filter = NULL;
            }

            $movies = get_movies($user_input, $filter);


            http_response_code(200);
            header("Content-Type: application/json");
            echo json_encode([
                "status" => 200,
                "message" => "OK",
                "payload" => $movies
            ]);
        } else if ($_SERVER['PATH_INFO'] == '/actors') {

            if (isset($_GET['last_name'])) {
                $user_input = $_GET['last_name'];
                $filter = 'last_name';
            } else if (isset($_GET['name'])) {
                $user_input = $_GET['name'];
                $filter = 'name';
            } else {
                $user_input = NULL;
                $filter = NULL;
            }

            $actors = get_actors($user_input, $filter);

            
            http_response_code(200);
            header("Content-Type: application/json");
            echo json_encode([
                "status" => 200,
                "message" => "OK",
                "payload" => $actors
            ]);
        } else if ($_SERVER['PATH_INFO'] == '/directors') {

            if (isset($_GET['last_name'])) {
                $user_input = $_GET['last_name'];
                $filter = 'last_name';
            } else if (isset($_GET['name'])) {
                $user_input = $_GET['name'];
                $filter = 'name';
            } else {
                $user_input = NULL;
                $filter = NULL;
            }
            $directors = get_directors($user_input, $filter);


            http_response_code(200);
            header("Content-Type: application/json");
            echo json_encode([
                "status" => 200,
                "message" => "OK",
                "payload" => $directors
            ]);
        } else if ($_SERVER['PATH_INFO'] == '/genres') {

            if (isset($_GET['name'])) {
                $user_input = $_GET['name'];
                $filter = 'name';
            } else {
                $user_input = NULL;
                $filter = NULL;
            }

            $genres = get_genres($user_input, $filter);
            

            http_response_code(200);
            header("Content-Type: application/json");
            echo json_encode([
                "status" => 200,
                "message" => "OK",
                "payload" => $genres
            ]);
        }  
    } else {
        http_response_code(405);
        header("Content-Type: application/json");
        echo json_encode([
            "status" => 405,
            "message" => "Method not allowed",
            "payload" => []
        ]);
    }

    exit;
?>