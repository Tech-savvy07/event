<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .calendar {
            width: 700px;
        }

        .calendar,
        .calendar table {
            border: 0;
            margin: 0;
        }

        .calendar,
        .calendar table,
        .calendar td {
            text-align: center;
        }

        .calendar .year {
            font-family: Verdana;
            font-size: 18pt;
            color: #ff9900;
        }

        .calendar .month {
            width: 25%;
            vertical-align: top;
        }

        .calendar .month table {
            font-size: 8pt;
            font-family: Verdana;
        }

        .calendar .month th {
            text-align: center;
            font-size: 12pt;
            font-family: Arial;
            color: #666699;
        }

        .calendar .month td {
            font-size: 8pt;
            font-family: Verdana;
        }

        .calendar .month .days td {
            color: #666666;
            font-weight: bold;
        }

        .calendar .month .sat {
            color: #0000cc;
        }

        .calendar .month .sun {
            color: #cc0000;
        }

        .calendar .month .today {
            background: #ff0000;
            color: #ffffff;
        }

        .calendar .month .prev_event {
            background: pink;
            color: blue;
        }

        .calendar .month .next_event {
            background: orange;
            color: yellow;
        }
    </style>
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
    <?php

    require('database.inc.php');

    $sql = 'SELECT event_date FROM event order by event_date';
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not get data: ' . mysqli_error($con));
    }



    $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $current_month = date('n');
    $current_year = date('Y');
    $current_day = date('d');
    $month = 0;

    $arr_m = array();
    $arr_d = array();
    while ($row = mysqli_fetch_assoc($retval)) {
        $event_date = $row['event_date'];
        $dateValue = strtotime($event_date);

        $j = 0;
        $yr = date("Y", $dateValue) . " ";
        $mon = date("m", $dateValue) . " ";
        $date = date("d", $dateValue) . " <br/>";
        // echo "<pre>";
        if (strcmp($yr, $current_year) >= 0) {
            array_push($arr_m, $mon);
            array_push($arr_d, $date);
        }
    }
    $ptr_mth = 0;
    $ptr_day = 0;
    echo '<table class="calendar">';
    echo '<th colspan="4" class="year">' . $current_year . '</th>';

    // Table of months

    for ($row = 1; $row <= 3; $row++) {
        echo '<tr>';
        for ($column = 1; $column <= 4; $column++) {
            echo '<td class="month">';

            $month++;

            // Month Cell

            $first_day_in_month = date('w', mktime(0, 0, 0, $month, 1, $current_year));
            $month_days = date('t', mktime(0, 0, 0, $month, 1, $current_year));

            // in PHP, Sunday is the first day in the week with number zero (0)
            // to make our calendar works we will change this to (7)
            // echo $month;
            if ($first_day_in_month == 0) {
                $first_day_in_month = 7;
            }
            echo '<table>';
            echo '<th colspan="7">' . $months[$month - 1] . '</th>';
            echo '<tr class="days"><td>Mo</td><td>Tu</td><td>We</td><td>Th</td><td>Fr</td>';
            echo '<td class="sat">Sa</td><td class="sun">Su</td></tr>';
            echo '<tr>';

            for ($i = 1; $i < $first_day_in_month; $i++) {
                echo '<td> </td>';
            }
            for ($day = 1; $day <= $month_days; $day++) {
                if ($ptr_mth < sizeof($arr_m) && $arr_m[$ptr_mth] == $month && $arr_d[$ptr_day] == $day) {
                    if ($arr_m[$ptr_mth] >= $current_month && $arr_d[$ptr_day] > $current_day) {
                        $class = 'prev_event';
                    } else {
                        $class = 'next_event';
                    }
                    $ptr_day++;
                    $ptr_mth++;
                } else {
                    $class = (($day == $current_day) && ($month == $current_month)) ? 'today' : 'day';
                }

                $pos = ($day + $first_day_in_month - 1) % 7;

                $class .= ($pos == 6) ? ' sat' : '';
                $class .= ($pos == 0) ? ' sun' : '';
                echo '<td class="' . $class . '">' . $day . '</td>';
                if ($pos == 0) echo '</tr><tr>';
            }

            echo '</tr>';
            echo '</table>';

            echo '</td>';
        }
        echo '</tr>';
    }

    echo '</table>';
    ?>
    <!-- Login Content -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

</body>

</html>