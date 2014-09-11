<?php
require 'vendor/autoload.php';

date_default_timezone_set ('America/New_York');

$remote = "mongodb://localhost";

//Instantiate app
$app = new \Slim\Slim(array(
    'templates.path' => 'views',
    'debug' => true
));


$app->get('/', function () use ($app) {
    //set time zone
    date_default_timezone_set ('America/New_York');
    
    $today = time();
    //Season start date
    $seasonStartDate = strtotime("2014-09-02");
    $datediff = $today - $seasonStartDate;
    $week = floor($datediff/(60*60*24*7)) + 1;
    
    $app->redirect("week/" . $week);
});

$app->get('/week/:week', function ($week) use ($app, $remote) {
    //configure database connection
    $m = new Mongo($remote);
    $db = $m->picks;
    
    //get all games this week
    $week = intval($week);
    $games = $db->games;
    $cursor = $games->find(array( "week" => $week));
    $cursor->sort(array("dateTime" => 1));
    // iterate through the results
    $gamesThisWeek = array();
    while ($cursor->hasNext()) {
        $game = $cursor->getNext();
        //print_r($game);
        array_push($gamesThisWeek, $game);
    }
    
    //get all users
    $cursor = $db->users->find();
    $users = array();
    while ($cursor->hasNext()) {
        array_push($users, $cursor->getNext());
    }
    
    $app->render('home.php', array(
        "page" => "home",
        "week" => $week,
        "games" => $gamesThisWeek,
        "users" => $users
    ));
});

$app->post('/save/:week', function($week) use ($app, $remote){
    //configure database connection
    $dbhost = 'localhost';
    $dbname = 'picks';
    $m = new Mongo($remote);
    $db = $m->picks;
    $games = $db->games;
    
    //data from form
    $postData = $app->request->post();
    $user = $postData["user"];
    $picks = array_slice($postData, 1);
    
    foreach($picks as $key=>$value){
        print_r($key);
        $games->update(array(
            "_id" => new MongoId($key)
        ), array(
            '$set' => array(
                "picks." . $user => $value
            )
        ));
    }
    
    
    //print_r($picks);
    $app->redirect("/picks/week/" . $week);    
});

$app->get('/standings', function () use ($app) {
    $app->render('standings.php', array(
        "page" => "standings"
    ));
});

$app->get('/users', function () use ($app, $remote) {
    $dbhost = 'localhost';
    $dbname = 'picks';
    $m = new Mongo($remote);
    $db = $m->picks;
    $users = $db->users;
    $cursor = $users->find();
    
    $usersForView = array();
    while($cursor->hasNext()){
        array_push($usersForView, $cursor->getNext());
    }
    
    $app->render('users.php', array(
        "page" => "users",
        "users" => $usersForView
    ));
});

$app->post('/users/new', function() use ($app, $remote){
    //configure database connection
    $dbhost = 'localhost';
    $dbname = 'picks';
    $m = new Mongo($remote);
    $db = $m->picks;
    $users = $db->users;
    
    //data from form
    $postData = $app->request->post();
    $user = $postData["user"];
    $users->insert(array("name" => $user));    
    
    //print_r($picks);
    $app->redirect("/picks/users");    
});


$app->run();

?>