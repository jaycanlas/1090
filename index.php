<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Required Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Required jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Required Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Piso Sale <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Hourly Sale</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Promo</a>
                </li>
            </ul>
        </div>
    </nav><div class="container">
        <form action="submit.php" method="post">
            <div class="form-group">
                <label for="Article">Article:</label>
                <input type="text" id="Article" name="Article" class="form-control">
            </div>
            <div class="form-group">
                <label for="Description">Description:</label>
                <input type="text" id="Description" name="Description" class="form-control">
            </div>
            <div class="form-group">
                <label for="TranTime">TranTime:</label>
                <input type="time" id="TranTime" name="TranTime" class="form-control">
            </div>
            <div class="form-group">
                <label for="Amount">Amount:</label>
                <input type="number" id="Amount" name="Amount" class="form-control">
            </div>
            <div class="form-group">
                <label for="Quantity">Quantity:</label>
                <input type="number" id="Quantity" name="Quantity" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Article</th>
                    <th>Description</th>
                    <th>Hour</th>
                    <th>Amount</th>
                    <th>Quantity</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $serverName = "DESKTOP-R49M057\SQLEXPRESS";
                $database = "mb52";
                $uid = "";
                $pass ="";

                $connectionInfo = [
                    "Database" => $database,
                "Uid" => $uid,
                    "PWD" => $pass,
                ];

                $conn = sqlsrv_connect($serverName, $connectionInfo);
                if(!$conn)
                    die(print_r(sqlsrv_errors(), true));

                $tsql = "SELECT * FROM ARTICLE_DB";

                $stmt = sqlsrv_query($conn, $tsql);
                if($stmt === false){
                    echo 'Error';
                }
                while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
                    echo '<tr>';
                    echo '<td>' . $obj['Article'] . '</td>';
                    echo '<td>' . $obj['Description'] . '</td>';
                    echo '<td>' . $obj['TranTime'] . '</td>';
                    echo '<td>' . $obj['Amount'] . '</td>';
                    echo '<td>' . $obj['Quantity'] . '</td>';
                    echo '<td><form action="delete.php" method="post">
                            <input type="hidden" name="ID" value="' . $obj['ID'] . '">
                            <button type="submit" class="btn btn-danger">Delete</button>
                         </form></td>';
                    echo '</tr>';
                }
                sqlsrv_free_stmt($stmt);
                sqlsrv_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>