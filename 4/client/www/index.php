<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Socket Programming using PHP</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="clo-6">
                    <p></p>
                    <p>
                        <a target="_blank" href="https://www.youtube.com/watch?v=75CCxIBs4Ak">
                            https://www.youtube.com/watch?v=75CCxIBs4Ak
                        </a>
                    </p>
                    <span class="h1">Socket Programming using PHP</span>
                    <p></p>
                    <form method="post">
                      <div class="form-group">
                        <label>Message</label>
                        <input type="text" class="form-control" name="inputMessage">
                      </div>


                      <p></p>

                      <?php
                      $host = '0.0.0.0';
                      $port = 8202;

                      if (isset($_POST['buttonSwnd'])) {
                          $msg = $_REQUEST['inputMessage'];
                          $sock = socket_create(AF_INET, SOCK_STREAM, 0);

                          socket_connect($sock, $host, $port);
                          socket_write($sock, $msg, strlen($msg));

                          $reply = socket_read($sock, 1924);
                          $reply = trim($reply);
                          $reply =  $_POST['textareaResponse'] . "\nServer say:\t" . $reply;
                      }
                      ?>

                      <label>Response</label>
                      <textarea name="textareaResponse" class="form-control" rows="4"><?php echo $reply; ?></textarea>
                      <p></p>
                      <button type="submit" class="btn btn-primary" name="buttonSwnd">Send</button>
                    </form>
                    <p></p>
                    <span class="h3">PHP Debug</span>
                    <p></p>
                    <div class="alert alert-secondary" role="alert">
                        <pre>
<?php var_dump($_POST); ?>
                        </pre>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
