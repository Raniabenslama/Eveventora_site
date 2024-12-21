<?php include 'connection.php' ?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql2 = "UPDATE mails SET is_seen = 1 WHERE id = '$id'";
    $result = mysqli_query($conn, $sql2);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Email Inbox</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/mail.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <style type="text/css">
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            background-color: #f9f9f9;
        }

        /* Top Header */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #EEE9F0;
            border-bottom: 1px solid #ddd;
        }

        .top-header .logo {
            font-size: 24px;
            font-weight: bold;
            color: #3F3A35;
        }

        .top-header .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .top-header .profile img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .top-header .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .top-header .profile-dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            z-index: 1;
            min-width: 120px;
        }

        .top-header .profile-dropdown:hover .profile-dropdown-content {
            display: block;
        }

        .top-header .profile-dropdown-content a {
            color: black;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        .top-header .profile-dropdown-content a:hover {
            background-color: #EEE9F0;
        }

        /* Sidebar */
        .sidebar {
            background-color: #EEE9F0;
            width: 220px;
            padding: 20px 10px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            border-right: 1px solid #ddd;
            position: fixed;
            top: 50px;
            bottom: 0;
            overflow-y: auto;
        }

        .sidebar a {
            text-decoration: none;
            color: #000;
            padding: 12px 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            background-color:#D7BBE2;
        }

        .sidebar a:hover {
            background-color: rgb(191, 150, 207);
        }

        .sidebar a.active {
            background-color:#8E44AD;
            color: white;
        }

        .sidebar a span {
            margin-left: 10px;
        }

        /* Main Content */
        .main {
            margin-left: 240px;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .header form {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header form input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .header form button {
            padding: 8px 15px;
            background-color:#D7BBE2;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .header form button:hover {
            background-color: rgb(191, 150, 207);
        }
       

        .container {
            margin-left: 240px;
            padding: 20px;
        }

        .table-responsive {
            margin-top: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table tr:hover {
            background-color: #f9f9f9;
        }

        table .fa-trash {
            color: #e74c3c;
            cursor: pointer;
            font-size: 16px;
        }

        table .fa-trash:hover {
            color: #c0392b;
        }

        .compose-btn {
            display: inline-block;
            padding: 12px 20px;
            background-color: #4caf50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin: 10px 0;
        }

        .compose-btn:hover {
            background-color: #45a049;
        }

        /* Scrollbar styling */
        * {
            scrollbar-width: thin;
            scrollbar-color: #aaa #f3f4f6;
        }

        *::-webkit-scrollbar {
            width: 8px;
        }

        *::-webkit-scrollbar-track {
            background: #f3f4f6;
        }

        *::-webkit-scrollbar-thumb {
            background-color: #aaa;
            border-radius: 10px;
            border: 2px solid #f3f4f6;
        }
    </style>
</head>
<body>
   <!-- Top Header -->
   <div class="top-header">
        <div class="logo">Eventora</div>
        <div class="profile">
            <div class="profile-dropdown">
                <img src="photo.png" alt="Profile Icon">
                <div class="profile-dropdown-content">
                    <a href="profile.php">My Profile</a>
                   
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
    
        <a href="../views/eventCreator.php">Events</a>
        <a href="../views/profile.php">Profile</a>
        <a href="sent.php" class="active">Emails</a>
    </div>

    <div class="container">
        <div class="row">
            <!-- BEGIN INBOX -->
            <div class="col-md-12">
                <div class="grid email">
                    <div class="grid-body">
                        <div class="row">
                            <!-- BEGIN INBOX MENU -->
                            <?php include('sidebar.php') ?>
                            <!-- END INBOX MENU -->

                            <!-- BEGIN INBOX CONTENT -->
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label style="margin-right: 8px;">
                                            <div class="icheckbox_square-blue" style="position: relative;">
                                                <input type="checkbox" id="check-all" class="icheck" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0;">
                                                <ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0;"></ins>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="padding"></div>

                                <?php if (isset($_GET['id'])) {
                                    $mailId = $_GET['id'];
                                ?>

                                <div class="table-responsive">
                                    <table class="table" id="chat-table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo 'inbox.php' ?>" style="font-size:20px"><i class="fa fa-chevron-circle-left"></i></a> &nbsp;
                                                    <a href="<?php echo 'action.php?inboxMailId='. $mailId ?>" style="font-size:20px; color: red;"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="subject">
                                                    <?php
                                                    $sql = "SELECT * FROM mails WHERE id = '$mailId'";
                                                    $result = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_array($result);
                                                    echo '<b>' . $row['subject'] . '</b>
                                                    <i class="fa fa-angle-left"></i> ' . $row['mail_from'] . ' <i class="fa fa-angle-right"></i>';
                                                    echo '<span style="margin-left:170px">' . date('M-d-Y H:i:A', strtotime($row['date_time'])) . '</span>';
                                                    echo '<br><br>' . $row['body'] . '<br>';
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="fa fa-arrow-circle-left"></i> <a href="">Reply</a> &nbsp; 
                                                    <i class="fa fa-arrow-circle-right"></i> <a href="">Forward</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <?php } else { ?>

                                <div class="table-responsive">
                                    <table class="table" id="chat-table">
                                        <tbody>
                                            <?php
                                            $loginUserEmail = 'chelbihoucem205@gmail.com';
                                            $sql = "SELECT * FROM mails";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_array($result)) {
                                                if ($row['mail_to'] === $loginUserEmail) {
                                                    $subject = $row['subject'];
                                                    $dateTime = $row['date_time'];
                                                    $seen = $row['is_seen'];
                                                    $mailId = $row['id'];
                                            ?>
                                            <tr <?php if ($seen == 1) { ?> style="background-color:#F6F6F4" <?php } ?>>
                                                <td class="subject">
                                                    <a href="<?php echo 'inbox.php?id=' . $row['id']; ?>"> 
                                                        <?php echo $subject; ?> 
                                                    </a>
                                                </td>
                                                <td>
                                                    <a style="color:red" href="<?php echo 'action.php?inboxMailId='. $mailId ?>">
                                                     <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                                <td class="time">
                                                    <?php echo date('d-m-Y H:i:A', strtotime($dateTime)); ?>
                                                </td>
                                            </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>

                                <?php } ?>
                            </div>
                            <!-- END INBOX CONTENT -->

                            <!-- BEGIN COMPOSE MESSAGE -->
                            <?php include('compose.php') ?>
                            <!-- END COMPOSE MESSAGE -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END INBOX -->
        </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>
</html>
