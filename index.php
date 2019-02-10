<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Send Mails</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <!-- Brand  -->
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Send Mails</a>
        </div>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Configurations</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div class="container">
      <header class="text-center">
        <h1>Send Mail</h1>
        <p class="lead">Send mails to multiple adresses automaticaly</p>
      </header>
      <form class="main-form">
        <!-- Sender input start  -->
        <div class="inputs-group">
          <label>Sender:</label>
          <input type="text" class="form-control" placeholder="ex: bourbie@gmail.com">
        </div>
        <!-- Sender input end  -->

        <!-- Receivers input start  -->
        <div class="inputs-group">
          <label>Receivers:</label>
          <div class="row receivers-inputs">
            <div class="col-lg-5">
              <input type="text" class="form-control" placeholder="ex: bourbie@gmail.com">
              <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="you can use multiple adresses by use ';' as separations"></span>
            </div>
            <div class="col-lg-1 text-center" style="padding-top: 10px;">
              <span>Or</span>
            </div>
            <div class="col-lg-6">
              <input type="file" class="form-control" accept=".json">
              <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="load json file"></span>
            </div>
          </div>
        </div>
        <!-- Receivers input end  -->

        <!-- Subject input start  -->
        <div class="inputs-group">
          <label>Subject:</label>
          <input type="text" class="form-control" placeholder="Enter Subject">
        </div>
        <!-- Subject input end  -->

        <!-- Mail Body input start  -->
        <div class="inputs-group">
          <label>Body:</label>
          <div class="row receivers-inputs">
            <div class="col-lg-5">
              <textarea name="name" class="form-control autosize" cols="35" placeholder="Write a message..."></textarea>
              <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="you can write direct message as text or html format"></span>
            </div>
            <div class="col-lg-1 text-center" style="padding-top: 10px;">
              <span>Or</span>
            </div>
            <div class="col-lg-6">
              <input type="file" class="form-control" accept=".txt, .html, .htm">
              <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="load text/html file"></span>
            </div>
          </div>
        </div>
        <!-- Mail Body input end  -->

        <!-- Type input start  -->
        <div class="inputs-group">
          <label style="display:block">Type:</label>
          <input type="radio" id="html" value="Html" name="isHtml" checked> <label for="html" style="margin-right: 10px"> Html</label>
          <input type="radio" id="txt" value="Text" name="isHtml"> <label for="txt"> Text</label>
        </div>
        <!-- Type input end  -->

        <div class="row">
          <div class="col-lg-5 col-lg-offset-1">
            <div class="inputs-group">
              <input type="submit" value="Send" class="form-control btn btn-success" aria-label="...">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
          <div class="col-lg-5">
            <div class="inputs-group">
              <input type="reset" value="Cancel" class="form-control btn btn-danger" aria-label="...">
            </div><!-- /input-group -->
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
      </form>
    </div>
    <script type="text/javascript" src="js/jquery-1.12.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    </body>
</html>
