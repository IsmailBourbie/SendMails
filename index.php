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
      <form class="main-form" autocomplete="off" method="post" action="app/index.php">
        <!-- Sender input start  -->
        <div class="inputs-group">
          <div class="row">
            <div class="col-lg-6">
              <label>Sender's email: *</label>
              <input id="sender_email" name="sender_email" type="email" class="form-control" placeholder="e.g: bourbie@gmail.com" >
            </div>
            <div class="col-lg-6">
              <label>Sender's name: *</label>
              <input id="sender_name" name="sender_name" type="text" class="form-control" placeholder="e.g: BOURBIE Ismail" >
            </div>
          </div>        
        </div>
        <!-- Sender input end  -->

        <!-- Subject input start  -->
        <div class="inputs-group">
          <label>Subject:</label>
          <input id="subject" name="subject" type="text" class="form-control" placeholder="Enter Subject">
        </div>
        <!-- Subject input end  -->

        <!-- Receivers input start  -->
        <div class="inputs-group">
          <label>Receivers: *</label>
            <div class="row  inputs-has-icons">
              <div class="col-lg-4 inputType">
                <input type="radio" id="inline" value="inline" name="receiversType" checked> <label for="inline" style="margin-right: 10px"> Inline</label>
                <input type="radio" id="file" value="file" name="receiversType"> <label for="file"> File</label>
              </div>
              <div class="col-lg-8 inline">
                <input id="receivers_inline" name="receivers_inline" type="email" class="form-control" placeholder="e.g: bourbie@gmail.com"  multiple>
                <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="you can use multiple adresses by using <,> as separations"></span>
              </div>
              <div class="col-lg-8 file" style="display : none">
                <input id="receivers_file" name="receivers" type="text" class="form-control tempName" placeholder="e.g: TempName/file.json">
              </div>
            </div>
        </div>
        <!-- Receivers input end  -->

        <!-- Mail Body input start  -->
        <div class="inputs-group">
          <div class="body-title">
            <label>Body: *</label>
            <a id="showHtmlModal" href="#" data-toggle="modal" data-target="#HtmlConfigModal" style="display: none"><!-- Button trigger modal -->
              Configuration
            </a>
          </div>
          <div class="row  inputs-has-icons">
            <div class="col-lg-4 inputType">
              <input type="radio" id="inlineText" value="inline" name="bodyType" checked> <label for="inlineText" style="margin-right: 10px"> Text</label>
              <input type="radio" id="htmlFile" value="file" name="bodyType"> <label for="htmlFile"> File</label>
            </div>
            <div class="col-lg-8 inline">
              <textarea id="body_inline" name="body" class="form-control autosize" cols="35" placeholder="Write a message..." ></textarea>
              <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="you can write direct message as txt format without any Configuration"></span>
            </div>
            <div class="col-lg-8 file" style="display : none">
              <input id="body_file" name="body_file" type="text" class="form-control tempName" placeholder="e.g: TempName/file.html">
            </div>
          </div>
        </div>
        <!-- Mail Body input end  -->

        <!-- Attachment input start  -->
        <div class="inputs-group">
          <label style="display:block">Has Attachment:</label>
          <div class="row inputs-has-icons">
            <div class="col-lg-4 hasSomething">
              <input type="radio" id="no" value="false" name="hasAttachment" checked> <label for="no" style="margin-right: 10px"> No</label>
              <input type="radio" id="yes" value="true" name="hasAttachment"> <label for="yes"> Yes</label>
            </div>
            <div class="col-lg-8" style="display: none">
              <input id="attachment_file" name="attachment_file" type="text" class="form-control tempName" placeholder="e.g: TempName/file.pdf">
              <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Use <,> to separate between files"></span>
            </div>
          </div>
        </div>
        <!-- Attachment input end  -->

        <!-- Form Buttons start  -->
        <div class="row" style="margin-top: 50px">
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
        <!-- Form Buttons end  -->
      </form>
      <!-- Modal -->
      <div class="modal fade" id="HtmlConfigModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop=static data-keyboard=false>
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="reset" class="close" data-dismiss="modal" aria-label="Close" value="&times;">
              <h4 class="modal-title" id="myModalLabel">File configurations</h4>
            </div>
            <form id="configForm" action="" method="post" autocomplete="off">
              <div class="modal-body">
              <!-- Images input start  -->
              <div class="inputs-group">
                <label style="display:block">Has Images:</label>
                <div class="row inputs-has-icons">
                  <div class="col-lg-3 hasSomething">
                    <input type="radio" id="no_img" value="false" name="hasImages" checked> <label for="no_img" style="margin-right: 10px"> No</label>
                    <input type="radio" id="yes_img" value="true" name="hasImages"> <label for="yes_img"> Yes</label>
                  </div>
                  <div class="col-lg-9" style="display: none">
                    <input id="images_temp" name="images_temp" type="text" class="form-control tempName" placeholder="Enter directory name:">
                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="All images in this directory are included"></span>
                  </div>
                </div>
              </div>
              <!-- Images input end  -->

                <!-- Replaced input start  -->
                <div class="inputs-group">
                  <label style="display:block">Has Replaced Text:</label>
                  <div class="row inputs-has-icons">
                    <div class="col-lg-3 hasSomething">
                      <input type="radio" id="no_replace" value="false" name="hasReplaced" checked> <label for="no_replace" style="margin-right: 10px"> No</label>
                      <input type="radio" id="yes_replace" value="true" name="hasReplaced"> <label for="yes_replace"> Yes</label>
                    </div>
                    <div class="col-lg-9" style="display: none">
                      <input id="replaced_txt" name="replaced_txt" type="text" class="form-control" placeholder="Enter the keys:">
                      <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="you can use <,> to separate between keys"></span>
                    </div>
                  </div>
                </div>
                <!-- Replaced input end  -->
              </div>
              <div class="modal-footer">
                <input type="reset" class="btn btn-default" value="Close">
                <input type="submit" class="btn btn-primary" value="Save changes">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="js/jquery-1.12.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    </body>
</html>
