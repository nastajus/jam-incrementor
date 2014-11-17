<!-- header -->
<html>
    <head>
        <title>Incrementor Game</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    </head>
    <body>
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Incrementor Game</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url();?>home">Home</a></li>
                        <li><a href="<?php echo base_url();?>about">About</a></li>
                        <li><a href="<?php echo base_url();?>faq">FAQ</a></li>
                        <li><a href="<?php echo base_url();?>contact">Contact</a></li>
                        <li><a href="<?php echo base_url();?>register">Register</a></li>
                    </ul>
                    <form class="navbar-form navbar-right" role="form" method="POST" action="login">
                        <div class="form-group">
                            <input type="text" placeholder="Username" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" name="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Sign in</button>
                    </form>
                </div><!--/.navbar-collapse -->
            </div>
        </nav>
        <div class="container">
