<?php include "./includes/header-start.php" ?>
<?php include "./includes/header-end.php" ?>

<?php
function fetchReports()
{

    include "./includes/db.php";

    $sql = "SELECT * FROM reported_users  ru 
            LEFT JOIN 
            user u 
            ON 
            ru.user_id = u.id";

    $stmt = $conn->query($sql);

    $stmt->execute();

    if ($stmt->rowCount() >= 1) {

        return $stmt->fetchAll();
    } else {

        return false;
    }
}

?>

<?php if (fetchReports() != false) :

    $reports = fetchReports();

?>

    <div class="heading">
        <h1>Reported users</h1>



    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>User name</th>
                    <th>Date reported</th>
                    <th>Report</th>
                </tr>
            </thead>


            <?php foreach ($reports as $report) : ?>

                <tr>
                    <td><?php echo $report->name ?></td>
                    <td><?php echo $report->date_reported ?></td>
                    <td><?php echo $report->report ?></td>
                </tr>

            <?php endforeach ?>

        </table>
    </div>

<?php else : ?>
    <div class="note error">
        <span class="material-symbols-outlined">
            warning
        </span>
        You have no products
    </div>
<?php endif ?>

<?php include "./includes/footer-start.php" ?>
<?php include "./includes/footer-end.php" ?>