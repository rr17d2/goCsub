

<!DOCTYPE html>
<html>
<title>foodGO Employee</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">


<?php include('connect.php');?>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}
th, td {
  text-align: left;
  padding: 8px;
}
tr:nth-child(even) {
  background-color: #f2f2f2;
  color: black;
}
th {
    background-color: #4CAF50;
    color: white;
}
</style>

<body>

<!-- Header -->
<header class="w3-display-container w3-content w3-center" style="max-width:1500px">
  <img class="w3-image" src="./art2.jpg" alt="Me" width="1500" height="200">
  <div class="w3-display-middle w3-padding-large w3-border w3-wide w3-text-light-grey w3-center">
    <h1 class="w3-hide-medium w3-hide-small w3-xxxlarge">Employee Portal</h1>
    <h5 class="w3-hide-large" style="white-space:nowrap">j</h5>
    <!--<h3 class="w3-hide-medium w3-hide-small">PHOTOGRAPHER</h3>-->
    <img class="w3-image" src="./foodgo.png" alt="foodgo" width="300" height="300">
  </div>
  
  <!-- Navbar (placed at the bottom of the header image) -->
  <div class="w3-bar w3-light-grey w3-round w3-display-bottommiddle w3-hide-small" style="bottom:10px">
    <a href="#" class="w3-bar-item w3-button">Home</a>
    <a href="#Resturant's earnings" class="w3-bar-item w3-button">Resturant's earnings</a>
    <a href="#contact" class="w3-bar-item w3-button">Contact</a>
    <!--<a href="#peets" class="w3-bar-item w3-button">Peet's Coffee</a>
    <a href="#cafe" class="w3-bar-item w3-button">Runner Cafe</a>
    <a href="#panda" class="w3-bar-item w3-button">Panda Express</a>
    <a href="#which" class="w3-bar-item w3-button">Which Wich</a>-->
  </div>

</header>

<!-- Navbar on small screens -->
<div class="w3-center w3-light-grey w3-padding-16 w3-hide-large w3-hide-medium">
<div class="w3-bar w3-light-grey">
  <a href="#" class="w3-bar-item w3-button">Home</a>
  <a href="#Resturant's earnings" class="w3-bar-item w3-button">Resturant's earnings</a>
  <a href="#contact" class="w3-bar-item w3-button">Contact</a>
</div>
</div>
<!-- ////////////////////Page content////////////////////////////////////////////////////////// -->


<?php

  
  $result = pg_query($db_connection, "SELECT employeeid, employeefirstname, employeelastname FROM deliveryemployee");

        echo "
        <table>
                <tr>
                        <th>Employee ID</th>
                        <th>Employee First Name</th>
                        <th>Employee Last name</th>
                        <th>View Records</th>
                        <th>Delete</th>
                        
                </tr>";
        while ($row = pg_fetch_row($result)) {
          (string)$fname = $row[1] ;
          (string)$lname =  $row[2] ;
        echo "<tr>",
                 "<td>", $row[0], "</td>",
                 "<td>", $row[1], "</td>",
                 "<td>", $row[2], "</td>",
              "<td> <button class='btn btn-primary' data-toggle='modal' data-target='#exampleModal' onClick=\"getData({$row[0]}, '{$fname}', '{$lname}')\">View Records </button></td>",
              
              "<td> <button class='btn btn-danger' data-record-id='54', data-record-title='dwfwfqwfqwfqw' data-toggle='modal' data-target='#confirm-delete'> Delete </button></td>" ,


              "</tr>";    

        }
        echo "
        </table>"
?>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width:100%!important max-width:100%!important">
  <div class="modal-dialog" role="document" style="width:100%!important max-width:100%!important">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Details</button>
      </div>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="w3-content w3-padding-large w3-margin-top" id="Resturant's earnings">

  <!-- Images (Portfolio) -->
  <center>
	<!--Peet's Coffee-->

		<img class="img-valign  w3-animate-zoom" src="./peets.png" style ="width:180px" alt="peets coffee" /></a> 
	    
	<!--Runner Cafe-->
	    
		<img class="img-valign  w3-animate-zoom" src="./csub.png" style ="width:180px" alt="Runner Cafe" /></a> 
	
	<!--Panda Express-->
		
		    <img class="img-valign  w3-animate-zoom" src="./panda.png" style ="width:180px" alt="Runner Cafe" /></a>
		  
	<!--Which Wich-->
		
		<img class="img-valign  w3-animate-zoom" src="./which.png" style ="width:180px" alt="Which Wich"/></a>
			   
	    <!--Starbucks-->
	   
		<img class="img-valign w3-animate-zoom w3-grayscale-max" src="https://upload.wikimedia.org/wikipedia/en/thumb/3/35/Starbucks_Coffee_Logo.svg/768px-Starbucks_Coffee_Logo.svg.png" style="width:180px" alt="Starbucks"/></a>
	
	</center>


<!--////////////////////////////////////////////////////////////////////////////////////////////-->

  <!-- Contact -->

  <div class="w3-light-grey w3-padding-large w3-padding-32 w3-margin-top" id="contact">
    <h3 class="w3-center">Contact</h3>
    <hr><center>
    <p>Do not call us. 
    <br>It's your responsibility to be safe out there. 
  <br>Thank you for your hard work everyday. 
<br>Stay safe.</p></br></center>

    <form action="/action_page.php" target="_blank">
      <div class="w3-section">
        <label>Name</label>
        <input class="w3-input w3-border" type="text" required name="Name">
      </div>
      <div class="w3-section">
        <label>Email</label>
        <input class="w3-input w3-border" type="text" required name="Email">
      </div>
      <div class="w3-section">
        <label>Message</label>
        <input class="w3-input w3-border" required name="Message">
      </div>
      <button type="submit" class="w3-button w3-block w3-dark-grey">Send</button>
    </form><br>
    <p>Powered by <a href="https://www.cs.csubak.edu/~gordon" target="_blank" class="w3-hover-text-green">CSUB</a></p>

  </div>

<!-- ////////////////////////////////////End page content /////////////////////////////////////////-->
</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  function getData(empID, fname, lname){
    $(".modal-title").html(fname.toString() + " " + lname.toString());
    $.ajax({
      type: "POST",
      url: "/getrecord.php",
      data: 'empID=' + empID,
      success: function(data){
        $(".modal-body").html(data);
      }
    })
  }
</script>

<!-- delete button start -->
    <script data-require="jquery@*" data-semver="2.0.3" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script data-require="bootstrap@*" data-semver="3.1.1" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link data-require="bootstrap-css@3.1.1" data-semver="3.1.1" rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/style.css" />
    <!--<script src="script.js"></script>-->

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to delete <b><i class="title"></i></b> record, this procedure is irreversible.</p>
                    <p>Do you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-ok">Delete</button>
                </div>
            </div>
        </div>
    </div>
<!--delete button end  -->

<!-- delete button to delete employees -->
<script>
       $('#confirm-delete').on('click', '.btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
            // $.ajax({url: '/api/record/' + id, type: 'DELETE'})
            // $.post('/api/record/' + id).then()
            $modalDiv.addClass('loading');
            setTimeout(function() {
                $modalDiv.modal('hide').removeClass('loading');
            }, 1000)
        });
        $('#confirm-delete').on('show.bs.modal', function(e) {
            var data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            $('.btn-ok', this).data('recordId', data.recordId);
        });
</script>
</body>
</html>
