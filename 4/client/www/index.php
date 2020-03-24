<?php
session_start();
?>
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
                <div class="col-12">
                    <p></p>
                    <p>
                        <a target="_blank" href="https://www.youtube.com/watch?v=75CCxIBs4Ak">
                            https://www.youtube.com/watch?v=75CCxIBs4Ak
                        </a>
                    </p>
                </div>
                <div class="col-6">
                    <p></p>
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

                          //Socket API
                          $sock  =  socket_create(AF_INET, SOCK_STREAM, 0);
                                    socket_connect($sock, $host, $port);
                                    socket_write($sock, $msg, strlen($msg));
                          $reply =  socket_read($sock, 1924);
                          //Socket API

                          $reply = trim($reply);


                          if (!isset($_SESSION['dialog'])) {
                              $_SESSION['dialog']['data'] = array();
                              $_SESSION['dialog']['counter'] = 0;
                          }

                          $countNumber = $_SESSION['dialog']['counter'];

                          $_SESSION['dialog']['data'][$countNumber]['client'] = $_POST['inputMessage'];
                          $_SESSION['dialog']['data'][$countNumber]['server'] = $reply;

                          $_SESSION['dialog']['counter'] = $_SESSION['dialog']['counter'] + 1;
                      }
                      // unset($_SESSION['dialog']);
                      ?>
                      <p></p>
                      <button type="submit" class="btn btn-primary" name="buttonSwnd">Send</button>
                    </form>
                    <p></p>
                    <?php if (false): ?>
                    <span class="h3">PHP Debug</span>
                    <p></p>
                    <div class="alert alert-secondary" role="alert">
                        <pre>
<?php
var_dump($_POST);
echo "<hr>";
var_dump($_SESSION);
?>
                        </pre>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-6">
                    <p></p>
                    <span class="h1">Dialog</span>
                    <p></p>
                    <?php foreach ($_SESSION['dialog']['data'] as $value): ?>
                        <div class="alert alert-primary text-left" role="alert">
                            <?php echo $value['client']; ?>
                        </div>
                        <div class="alert alert-dark text-right" role="alert">
                          <?php echo $value['server']; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </body>
</html>
