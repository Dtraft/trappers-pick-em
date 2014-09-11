<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon(s) in the root directory -->
        <!--<link rel="stylesheet" href="css/main.css">-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <!-- Add your site or application content here -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">Trapper's Pick em</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav navbar-right">
                        <?php if($this->data["page"] == "home"):?>
                            <li class="active"><a href="home">Home</a></li>
                            <li><a href="/picks/standings">Standings</a></li>
                            <li><a href="/picks/users">Users</a></li>
                        <?php elseif($this->data["page"] == "standings"): ?>
                            <li><a href="/picks">Home</a></li>
                            <li class="active"><a href="#">Standings</a></li>
                            <li><a href="/picks/users">Users</a></li>                            
                        <?php else:?>
                            <li><a href="/picks">Home</a></li>
                            <li><a href="standings">Standings</a></li>
                            <li class="active"><a href="#">Users</a></li>
                        <?php endif ?>
                        
                      </ul>
                    </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
        </nav>
        
        <div class="container-fluid">
