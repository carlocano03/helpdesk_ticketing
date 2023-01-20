<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/img/main-icon.png" rel="icon">
    <title>Ticket Details</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        #table_body td,
        th {
            border: 0.5px solid black;
            padding: 5px;
            font-size: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <table cellspacing="0" id="table_top" width="100%">
        <tr>
            <th><img src="./assets/img/logoTW.png" /></th>
        </tr>
        <tr>
            <th>TICKET INFORMATION</th>
        </tr>
    </table>
    <table cellspacing="0" id="table_body" width="100%">
        <tr>
            <th>Ticket No</th>
            <th>Priority Level</th>
            <th>Concern Person</th>
            <th>Concern Department</th>
            <th>Date Request</th>
        </tr>
        <tbody>
            <tr>
                <td><?= isset($ticket->ticket_no) ? $ticket->ticket_no : '' ?></td>
                <td><?= isset($ticket->concern_level) ? $ticket->concern_level : '' ?></td>
                <td><?= isset($ticket->concern_person) ? $ticket->concern_person : '' ?></td>
                <td><?= isset($ticket->concern_department) ? $ticket->concern_department : '' ?></td>
                <?php
                    $date = isset($ticket->date_added) ? $ticket->date_added : '';
                    $dateConverted = date('D M j, Y h:i a', strtotime($date))
                ?>
                <td><?= $dateConverted;?></td>
            </tr>
        </tbody>
    </table>
    <table cellspacing="0" id="table_top" width="100%">
        <tr>
            <th>TICKET CONCERN</th>
        </tr>
    </table>
    <table cellspacing="0" id="table_body" width="100%">
        <tr>
            <th>Concern</th>
            <th>Solutions</th>
        </tr>
        <tbody>
            <?php foreach($ticketConcern as $row): ?>
                <tr>
                    <td><?= $row->concern;?></td>
                    <td><?= $row->solutions;?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div style="text-align: center;">
        <h2>TICKET TRAIL</h2>
    </div>
    <table cellspacing="0" id="table_body" width="100%">
        <tr>
            <th>Remarks</th>
            <th>Ticket Status</th>
            <th>Transaction Date</th>
        </tr>
        <tbody>
            <?php foreach($ticketTrail as $row): ?>
                <tr>
                    <td><?= $row->remarks;?></td>
                    <td><?= $row->ticket_status;?></td>
                    <td><?= date('D M j, Y h:i a',strtotime($row->date_added));?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>