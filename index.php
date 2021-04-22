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
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Add Event <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
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
                                        <h1 class="h4 text-gray-900 mb-4">Add Event</h1>
                                    </div>
                                    <form id="event_submit" method="post">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Event Name</label>
                                            <input type="text" class="form-control" id="event_name" name="event_name" aria-describedby="emailHelp" placeholder="Enter Event Name">
                                            <label for="event_name" class="error text-danger"></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Event Date</label>
                                            <input class="form-control" type="date" id="event_date" name="event_date" id="example-date-input">
                                            <label for="event_date" class="error text-danger"></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Event Time</label>
                                            <input class="form-control" type="time" id="event_time" name="event_time" id="example-time-input">
                                            <label for="event_time" class="error text-danger"></label>
                                        </div>
                                        <button type="submit" id="send_form" class="btn btn-primary">Submit</button>
                                    </form>
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

    <script>
        if ($("#event_submit").length > 0) {
            $("#event_submit").validate({
                rules: {
                    event_name: {
                        required: true,
                        maxlength: 50
                    },

                    event_date: {
                        required: true,
                        date: true,
                    },
                    event_time: {
                        required: true,
                        time: true,
                    }
                },
                messages: {
                    event_name: {
                        required: "Please enter name",
                        maxlength: "Your last name maxlength should be 50 characters long."
                    },
                    event_date: {
                        required: "Please select date",
                    },
                    event_time: {
                        required: "Please select date",
                    },

                },

                submitHandler: function(form) {
                    $('#send_form').html('Sending..');
                    $.ajax({
                        url: 'backend_event.php',
                        type: "POST",
                        data: $('#event_submit').serialize(),
                        success: function(data) {
                            var result = $.trim(data);
                            var data = $.parseJSON(result);
                            $('#send_form').html('Submit');
                            swal({
                                title: data.title,
                                text: data.message,
                                icon: data.status,
                            })
                            $('#event_submit').trigger("reset");
                        },
                        error: function(response) {
                            swal({
                                title: "Ahh!",
                                text: "Some error occured!!",
                                icon: "error",
                            })
                            $('#send_form').html('Submit');
                        }
                    });
                }
            })
        }
    </script>
</body>

</html>