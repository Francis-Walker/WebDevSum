<?php
$ticketType = 'Remove Dependent';
$depID = 1;
$memID = 1;
include('includes/dbFunctions.php')
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Submit <?php echo $ticketType ?></title>


</head>
<body>
<h1>Submit Ticket</h1>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>




<?php
$ticketType = 'Remove Dependent';
$depID = 1;
$memID = 1;
?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitRemoveTicketModal">
    Remove Dependent
</button>

<!-- Modal -->
<div class="modal fade" id="submitRemoveTicketModal" tabindex="-1" role="dialog" aria-labelledby="submitRemoveTicketModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitRemoveTicketModalLabel"><?php echo $ticketType ?> Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="ticketSubmit" method="post">

                    <label>
                        <?php echo $depID ?> from <?php echo $memID ?>'s plan?
                    </label>
                    <br>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input onclick="submitRemoveTicket()"  type="submit" class="btn btn-primary">
                </form>



            </div>

        </div>
    </div>
</div>



<script>
    function submitRemoveTicket() {

        <?php submitTicket($ticketType, $depID,'working',null);?>

        alert('Ticket submitted');
    }
</script>

</body>
</html>