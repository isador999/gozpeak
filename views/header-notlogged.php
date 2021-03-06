<?php
session_start();
?>

<nav role="navigation" class="navbar navbar-default navbar-inverse">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-offset-1 col-lg-2 col-md-offset-4 col-sm-offset-4 col-sm-4">
        <a href="<?php echo $baseUrl.'/index.php?page=home'; ?>" title="GoZpeak!"><img src="views/images/gozpeak_small.png" alt="GoZpeak" /></a>
      </div>
    <!-- <div class="navbar-header row col-xs-5 visible-xs">
      <a href="index.php?page=home"><img src="views/images/gozpeak_small.png" alt="GoZpeak" title="GoZpeak!" /></a>
    </div> -->

    <!-- <div class="pull-left col-xs-12 visible-xs" style="padding-top: 0.25%;">
      <form class="navbar-form" role="search">
        <div class="input-group">
          <input type="text" class="input form-control" placeholder="<?php #echo $headband[$_SESSION['language']]['search']['text']; ?>" title="<?php #echo $headband[$_SESSION['language']]['search']['title']; ?>" name="q" disabled>
            <div class="input-group-btn">
              <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
          </div>
        </form>
      </div>


    <div class="pull-left col-md-offset-2 col-sm-offset-2 visible-md visible-sm" style="padding-top: 0.25%;">
      <form class="navbar-form" role="search">
        <div class="input-group">
          <input type="text" class="input form-control" placeholder="<?php #echo $headband[$_SESSION['language']]['search']['text']; ?>" title="<?php #echo $headband[$_SESSION['language']]['search']['title']; ?>" name="q" disabled>
            <div class="input-group-btn">
              <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
          </div>
        </form>
      </div>


    <div class="pull-right col-lg-6 visible-lg" style="padding-top: 0.25%;">
      <form class="navbar-form" role="search">
        <div class="input-group">
          <input type="text" class="input form-control" placeholder="<?php #echo $headband[$_SESSION['language']]['search']['text']; ?>" title="<?php #echo $headband[$_SESSION['language']]['search']['title']; ?>" name="q" disabled>
            <div class="input-group-btn">
              <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
          </div>
        </form>
      </div> -->


    <!-- NAV TABS BUTTONS -->
      <div class="col-lg-offset-1 col-lg-8 col-md-12 col-sm-12 col-xs-6">
        <ul class="nav nav-tabs">
          <li class="col-lg-3 col-md-4 col-sm-3 col-xs-7 text-right btn navbar-btn"><a title="<?php echo $headband[$_SESSION['language']]['registration']['title']; ?>" data-toggle="modal" data-target="#modalInscription"><span class="glyphicon glyphicon-user"> <?php echo $headband[$_SESSION['language']]['registration']['text']; ?></span></a> </li>
          <li class="col-lg-4 col-md-4 col-sm-4 col-xs-8 text-right btn navbar-btn"><a title="<?php echo $headband[$_SESSION['language']]['connection']['title']; ?>" data-toggle="modal" data-target="#modalConnection"><span class="glyphicon glyphicon-log-in"> <?php echo $headband[$_SESSION['language']]['connection']['text']; ?></span></a> </li>
          <li class="col-lg-5 col-md-4 col-sm-5 col-xs-10 text-right btn navbar-btn"><a title="<?php echo $headband[$_SESSION['language']]['event']['title']; ?>" data-toggle="modal" data-target="#modalSelectQueryNotLogged"><span class="glyphicon glyphicon-calendar"> <?php echo $headband[$_SESSION['language']]['event']['text']; ?> </span></a> </li>
        </ul>
      </div>
      <!-- <div class="nav navbar-nav pull-right col-xs-5 pull-left row visible-xs">
        <ul class="nav" style="padding-top:1%;">
          <li class="col-xs-offset-1 pull-left btn navbar-btn"><a title="<?php #echo $headband[$_SESSION['language']]['registration']['title']; ?>" data-toggle="modal" data-target="#modalInscription"><span class="glyphicon glyphicon-user"> <?php #echo $headband[$_SESSION['language']]['registration']['text']; ?></span></a></li>
          <li class="col-xs-offset-1 pull-left btn navbar-btn"><a title="<?php #echo $headband[$_SESSION['language']]['connection']['title']; ?>" data-toggle="modal" data-target="#modalConnection"><span class="glyphicon glyphicon-log-in"> <?php #echo $headband[$_SESSION['language']]['connection']['text']; ?></span></a></li>
          <li class="col-xs-offset-1 pull-left btn navbar-btn"><a title="<?php #echo $headband[$_SESSION['language']]['event']['title']; ?>" data-toggle="modal" data-target="#modalSelectQueryNotLogged"><span class="glyphicon glyphicon-calendar"> <?php #echo $headband[$_SESSION['language']]['event']['text']; ?> </span></a></li>
        </ul>
      </div> -->
    </div>
  </div>
</nav>
