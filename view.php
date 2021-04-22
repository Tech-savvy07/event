<?php

require('database.inc.php');
require('functions.inc.php');
  $sql = "select * from event";
  $res = mysqli_query($con, $sql);

  while($row = mysqli_fetch_assoc($res)) {
    $data[]=$row;
  
}
// prx($data)
?>
  <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body class="bg-gradient-login">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Event Calendar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        </div>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Add Event </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="view.php">View Event</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="calendar.php">View Calendar</a>
            </li>
        </ul>
    </nav>
    <!-- Login Content -->
    <div class="d-flex justify-content-center">
        <div class="container-login m-4 col-lg-6">
            <div class="col-xl-10 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5 w-100">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Events</h1>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">S. no.</th>
                                                <th scope="col">Event Name</th>
                                                <th scope="col">Event Date</th>
                                                <th scope="col">Event Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  $i=1; $f=0;
                                            foreach ($data as $list) {?>
                                            <tr>
                                                <th scope="row"><?php echo $i?></th>
                                                <td><?php echo $data[$f]['event_name']?></td>
                                                <td><?php echo $data[$f]['event_date']?></td>
                                                <td><?php echo $data[$f]['event_time']?></td>
                                            </tr>
                                            <?php $i++;$f++;  } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>