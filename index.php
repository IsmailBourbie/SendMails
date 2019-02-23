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
          <label>Sender: *</label>
          <input id="sender" name="sender" type="text" class="form-control" placeholder="e.g: bourbie@gmail.com">
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
                <input type="radio" id="inline" value="inline" name="receiversRadio" checked> <label for="inline" style="margin-right: 10px"> Inline</label>
                <input type="radio" id="file" value="file" name="receiversRadio"> <label for="file"> File</label>
              </div>
              <div class="col-lg-8 inline">
                <input id="receivers_inline" name="receivers_inline" type="text" class="form-control" placeholder="e.g: bourbie@gmail.com">
                <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="you can use multiple adresses by use ';' as separations"></span>
              </div>
              <div class="col-lg-8 file" style="display : none">
                <input id="receivers_file" name="receivers" type="text" class="form-control" placeholder="e.g: TempName/file.json">
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
              <textarea id="body" name="body" class="form-control autosize" cols="35" placeholder="Write a message..."></textarea>
              <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="you can write direct message as txt format without any Configuration"></span>
            </div>
            <div class="col-lg-8 file" style="display : none">
              <input id="chooseHtmlFile" name="body_html" type="text" class="form-control" placeholder="e.g: TempName/file.html">
              <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="load text/html file"></span>
            </div>
          </div>
        </div>
        <!-- Mail Body input end  -->

        <!-- Attachment input start  -->
        <div class="inputs-group">
          <label style="display:block">Has Attachment:</label>
          <div class="row">
            <div class="col-lg-6">
              <input type="radio" id="no" value="no" name="hasAttachment" checked> <label for="no" style="margin-right: 10px"> No</label>
              <input type="radio" id="yes" value="yes" name="hasAttachment"> <label for="yes"> Yes</label>
            </div>
            <div class="col-lg-6" style="display: none">
              <input id="attachment_file" name="attachment_file" type="file" class="form-control">
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

        <!-- Modal -->
        <div class="modal fade" id="HtmlConfigModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">File configurations</h4>
              </div>
              <div class="modal-body">
                <!-- Images input start  -->
                <div class="inputs-group">
                  <label style="display:block">Has Images:</label>
                  <div class="row inputs-has-icons">
                    <div class="col-lg-3">
                      <input type="radio" id="no_img" value="no" name="hasImages" checked> <label for="no_img" style="margin-right: 10px"> No</label>
                      <input type="radio" id="yes_img" value="yes" name="hasImages"> <label for="yes_img"> Yes</label>
                    </div>
                    <div class="col-lg-9" style="display: none">
                      <input id="images_dir" name="images_dir" type="text" class="form-control" placeholder="Enter directory name:">
                      <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="All images in this directory are included"></span>
                    </div>
                  </div>
                </div>
                <!-- Images input end  -->

                  <!-- Images input start  -->
                  <div class="inputs-group">
                    <label style="display:block">Has Replaced Text:</label>
                    <div class="row inputs-has-icons">
                      <div class="col-lg-3">
                        <input type="radio" id="no_replace" value="no" name="hasReplaced" checked> <label for="no_replace" style="margin-right: 10px"> No</label>
                        <input type="radio" id="yes_replace" value="yes" name="hasReplaced"> <label for="yes_replace"> Yes</label>
                      </div>
                      <div class="col-lg-9" style="display: none">
                        <div class="row">
                          <div class="col-lg-5">
                            <input id="replaced_txt_key" name="replaced_txt_key" type="text" class="form-control" placeholder="Enter key name">
                          </div>
                          <div class="col-lg-2 text-center">
                            <span>By</span>
                          </div>
                          <div class="col-lg-5">
                            <input id="replaced_txt_val" name="replaced_txt_val" type="text" class="form-control" placeholder="Enter values name">
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Replaced input end  -->

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <script type="text/javascript" src="js/jquery-1.12.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    </body>
</html>
