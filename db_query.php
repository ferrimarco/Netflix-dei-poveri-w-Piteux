<?php
function get_movies($user_input, $filter) {
    $movies = array();

    $mysqli = new mysqli('localhost','root','','db_film');
    if ($mysqli -> connect_errno) {
        echo "Failed: " . $mysqli -> connect_error;
        exit();
    }

    if ($user_input !== NULL) {
        $moviesQuery = 'SELECT * FROM movie WHERE '. $filter .' LIKE "%'.$user_input.'%"';
    } else if ($user_input === NULL) {
        $moviesQuery = 'SELECT * FROM movie';
    }

    $moviesResult = $mysqli -> query($moviesQuery);

    while ($moviesRow = $moviesResult -> fetch_assoc()) {
        $movies[] = $moviesRow;

        $last_movie = $movies[count($movies) - 1];
        $movieID = $last_movie['id'];

        $actorsQuery = 'SELECT actor.* FROM movie_actor 
        INNER JOIN actor ON actor.id = movie_actor.actor_id 
        WHERE movie_actor.movie_id = '.$movieID;

        $actorsResult = $mysqli -> query($actorsQuery);
        if (!$actorsResult) {
            die("Errore $movieID: " . $mysqli -> connect_error);
        } 

        while ($actorsRow = $actorsResult -> fetch_assoc()) {
            $movies[count($movies) - 1]['actors'][] = $actorsRow;
        }

        $directorsQuery = 'SELECT director.* FROM movie_director 
        INNER JOIN director ON director.id = movie_director.director_id 
        WHERE movie_director.movie_id = '.$movieID;

        $directorsResult = $mysqli -> query($directorsQuery);
        if (!$directorsResult) {
            die("Errore $movieID: " . $mysqli -> connect_error);
        }

        while ($directorsRow = $directorsResult -> fetch_assoc()) {
            $movies[count($movies) - 1]['directors'][] = $directorsRow;
        }

        $genresQuery = 'SELECT genre.* FROM movie_genre 
        INNER JOIN genre ON genre.id = movie_genre.genre_id 
        WHERE movie_genre.movie_id = '.$movieID;

        $genresResult = $mysqli -> query($genresQuery);
        if (!$genresResult) {
            die("Errore $movieID: " . $mysqli -> connect_error);
        }

        while ($genresRow = $genresResult -> fetch_assoc()) {
            $movies[count($movies) - 1]['genres'][] = $genresRow;
        }
    }


    $mysqli -> close();

    return $movies;
}


function get_actors($user_input, $filter) {
    $actors = array();

    $mysqli = new mysqli('localhost','root','','db_film');
    if ($mysqli -> connect_errno) {
        echo "Failed: " . $mysqli -> connect_error;
        exit();
    }

    if ($user_input !== NULL) {
        $query = 'SELECT * FROM actor WHERE '. $filter .' LIKE "%'.$user_input.'%"';
    } else if ($user_input === NULL) {
        $query = 'SELECT * FROM actor';
    }

    $result = $mysqli -> query($query);

    while ($row = $result -> fetch_assoc()) {
        $actors[] = $row;
    }


    $mysqli -> close();

    return $actors;
}


function get_directors($user_input, $filter) {
    $directors = array();

    $mysqli = new mysqli('localhost','root','','db_film');
    if ($mysqli -> connect_errno) {
        echo "Failed: " . $mysqli -> connect_error;
        exit();
    }

    
    if ($user_input !== NULL) {
        $query = 'SELECT * FROM director WHERE '. $filter .' LIKE "%'.$user_input.'%"';
    } else if ($user_input === NULL) {
        $query = 'SELECT * FROM director';
    }
    
    $result = $mysqli -> query($query);

    while ($row = $result -> fetch_assoc()) {
        $directors[] = $row;
    }


    $mysqli -> close();

    return $directors;
}


function get_genres($user_input, $filter) {
    $genres = array();

    $mysqli = new mysqli('localhost','root','','db_film');
    if ($mysqli -> connect_errno) {
        echo "Failed: " . $mysqli -> connect_error;
        exit();
    }

    if ($user_input !== NULL) {
        $query = 'SELECT * FROM genre WHERE '. $filter .' LIKE "%'.$user_input.'%"';
    } else if ($user_input === NULL) {
        $query = 'SELECT * FROM genre';
    }

    $result = $mysqli -> query($query);

    while ($row = $result -> fetch_assoc()) {
        $genres[] = $row;
    }


    $mysqli -> close();

    return $genres;
}
?>