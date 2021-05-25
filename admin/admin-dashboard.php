<?php
require_once 'assets/php/admin-header.php';
require_once 'assets/php/adminDb.php';
$count = new Admin();
?>
<div class="col-lg-12">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4 mt-2 text-center text-white">
        <div class="col">
            <div class="card bg-primary">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?php echo $count->totalCount('users'); ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-success">
                <div class="card-header">Verified Users</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?php echo $count->verifyUnverifyUsers(1); ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card bg-danger">
                <div class="card-header">Unverified Users</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?php echo $count->verifyUnverifyUsers(0); ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card bg-info">
                <div class="card-header">Website Hits</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?php $data = $count->visitors();
                        echo $data['hits']; ?>
                    </h1>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="col-lg-12">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 g-4 mt-2 text-center text-white">
        <div class="col">
            <div class="card bg-danger">
                <div class="card-header">Total Notes</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?php echo $count->totalCount('notes'); ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-success">
                <div class="card-header">Total Feedback</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?php echo $count->totalCount('feedback'); ?>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card bg-info">
                <div class="card-header">Total Notification</div>
                <div class="card-body">
                    <h1 class="display-4">
                        <?php echo $count->totalCount('notification'); ?>
                    </h1>
                </div>
            </div>
        </div>


    </div>
</div>

<div class="col-lg-12">
    <div class="row row-cols-2 g-4 my-2 text-center text-white">
        <div class="col">
            <div class="card bg-success">
                <div class="card-header">Male/Female User's Percentage</div>
                <div class="card-body bg-white">
                    <div id="chatOne" style="width:99%; height: 400px;"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-info">
                <div class="card-header">Verified/Unverified Users Persentage</div>
                <div class="card-body bg-white">
                    <div id="chattwo" style="width:99%; height: 400px;"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Footer Area  -->
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    $(document).ready(function() {
        $('#open-nav').click(function() {
            // e.preventDefault();
            $(".admin-nav").toggleClass('animate');
        })
        //Check Noticiation
        checkNotification();

        function checkNotification() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: 'checkNotification'
                },
                success: function(response) {
                    $("#checkNotificationIcon").html(response);
                }
            });
        }


        // For Verifyid/Unverified users Percentage Start
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(colChart);

        function colChart() {
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows([
                <?php
                $verified = $count->verfiedPer();
                foreach ($verified as $row) {
                    if ($row['verified'] == 0) {
                        $row['verified'] = 'Unverified';
                    } else {
                        $row['verified'] = 'Verified';
                    }
                    echo '["' . $row['verified'] . '", ' . $row['number'] . '],';
                }
                ?>
            ]);
            var options = {
                'width': 500,
                'height': 400
            };
            var chart = new google.visualization.PieChart(document.getElementById('chattwo'));
            chart.draw(data, options);
        }
        // For Verifyid/Unverified users Percentage End

    });
</script>

<!-- For Male Female Percentage Start -->
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(colChart);

    function colChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            <?php
            $gender = $count->genderPer();
            foreach ($gender as $row) {
                echo '["' . $row['gender'] . '", ' . $row['number'] . '],';
            }
            ?>
        ]);
        var options = {
            'width': 500,
            'height': 400,
        };
        var chart = new google.visualization.PieChart(document.getElementById('chatOne'));
        chart.draw(data, options);
    }
</script>
<!-- // For Male Female Percentage End -->

</body>

</html>