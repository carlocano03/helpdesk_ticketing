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
            <th><img src="./assets/img/logoTW.png" width="300"/></th>
        </tr>
        <tr>
            <th>EMPLOYEE INFORMATION</th>
        </tr>
    </table>
    <table cellspacing="0" id="table_body" width="100%">
        <tr>
            <th>Request by</th>
            <th>Email</th>
            <th>Position</th>
            <th>Department</th>
            <th>Branch</th>
            <th>Area</th>
        </tr>
        <tbody>
            <tr>
                <td><?= isset($ticket->request_by) ? $ticket->request_by : '' ?></td>
                <td><?= isset($requestBy->email) ? $requestBy->email : '' ?></td>
                <td><?= isset($requestBy->position) ? $requestBy->position : '' ?></td>
                <td><?= isset($requestBy->department) ? $requestBy->department : '' ?></td>
                <td><?= isset($requestBy->branch_store) ? $requestBy->branch_store : '' ?></td>
                <td><?= isset($requestBy->area_name) ? $requestBy->area_name : '' ?></td>
            </tr>
        </tbody>
    </table>
    <table cellspacing="0" id="table_top" width="100%">
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
            <th>Days Count</th>
        </tr>
        <tbody>
            <tr>
                <td><?= isset($ticket->ticket_no) ? $ticket->ticket_no : '' ?></td>
                <td><?= isset($ticket->concern_level) ? $ticket->concern_level : '' ?></td>
                <td><?= isset($ticket->concern_person) ? $ticket->concern_person : '' ?></td>
                <td><?= isset($ticket->concern_department) ? $ticket->concern_department : '' ?></td>
                <?php
                    $date_accomplished = '';
                    $date = isset($ticket->date_added) ? $ticket->date_added : '';
                    $dateConverted = date('D M j, Y h:i a', strtotime($date));

                    if ($ticket->service_start != NULL) {
                        if ($ticket->date_accomplished != NULL) {
                            $date_accomplished = date('M j, Y H:i:s a', strtotime($ticket->date_accomplished));
                            $start_date = date('Y-m-d', strtotime($ticket->service_start));
                            $end_date = date('Y-m-d', strtotime($ticket->date_accomplished));
                            $days = 0;
                            for ($date = $start_date; $date <= $end_date; $date = date('Y-m-d', strtotime($date . ' +1 day'))) {
                                if (!in_array(date('w', strtotime($date)), array(0, 6))) {
                                    $days++;
                                }
                            }
                        } else {
                            $date_accomplished = '';
                            $start_date = date('Y-m-d', strtotime($ticket->service_start));
                            $end_date = date('Y-m-d');
                            $days = 0;
                            for ($date = $start_date; $date <= $end_date; $date = date('Y-m-d', strtotime($date . ' +1 day'))) {
                                if (!in_array(date('w', strtotime($date)), array(0, 6))) {
                                    $days++;
                                }
                            }
                        }
                    } else {
                        $days = '';
                    }

                    if ($days == '1') {
                        $countDays = $days. ' day';
                    } else {
                        $countDays = $days. ' days';
                    }
                ?>
                <td><?= $dateConverted;?></td>
                <td><?= $countDays;?></td>
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
    <br>
    <div>
        <b>Remarks: </b> <?= isset($ticket->remarks) ? $ticket->remarks : '' ?><br>
        <b>Feedback: </b><?= isset($ticket->feedback) ? $ticket->feedback : '' ?>
    </div>
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
    <div style="text-align: center; margin-top:10px; font-size: 13px; color:dimgray;">
        This is computer generated reports. <?= date('F j, Y');?>
    </div>
</body>

</html>