<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script> 
<table id="example" class="display" cellspacing="0" width="100%">
       <!-- <thead>
            <tr>
                <th>Order ID</th>
		        <th>Restaurant Name</th>
		        <th>Restaurant Location</th>
		        <th>Destination</th>
		        <th>Tip</th>
		        <th>Quantity</th>
		        <th>Total Price</th>
		        <th>Date</th>
            </tr>
        </thead> -->
        <thead>
            <tr>
                <th>Order ID</th>
		        <th>Restaurant Name</th>
		      	<th>Tip</th>
		      	<th>Service</th>
		       	<th>Total Price</th>
		        
            </tr>
        </thead> 
        <!--<tfoot>
            <tr>
                <th>Order ID</th>
		        <th>Restaurant Name</th>
		        <th>Restaurant Location</th>
		        <th>Destination</th>
		        <th>Tip</th>
		        <th>Quantity</th>
		        <th>Total Price</th>
		        <th>Date</th>
            </tr>
        </tfoot>
        <tbody> -->
<?php 
	include('connect.php');
	if(!empty($_POST["empID"])){
		$emppid = $_POST['empID'];
		/*$query = "SELECT 
						
		
						OI.orderid, 
						OI.tip, 
						OI.destination, 
						IC.totalprice, 
						IC.quantity,
						r.restaurantname,
						r.restaurantlocation,
						ISIN.timeupdate
					FROM 
						orderinformation as OI 
					INNER JOIN 
						isin as ISIN ON ( ISIN.orderid = OI.orderid ) 
					INNER JOIN 
						itemcart as IC ON (IC.orderid = OI.orderid ) 
					INNER JOIN 
						restaurants as r ON (r.restaurantid = IC.restaurantid) 
					WHERE 
						OI.employeeid=".$emppid." ";*/
		$query = "SELECT
						OI.orderid,
						OI.tip,
						e.servicecharge,
						r.restaurantname,
						IC.totalprice
					FROM 
						orderinformation as OI
					INNER JOIN
						itemcart as IC ON (IC.orderid = OI.orderid)
					INNER JOIN
						restaurants as r ON (r.restaurantid = IC.restaurantid)
					INNER JOIN
						deliveryemployee as e ON (OI.employeeid = e.employeeid)
					WHERE
						OI.employeeid = ".$emppid." ";
		$result = pg_query($db_connection, $query);
		
		if(!empty($result)){
			while ($record =  pg_fetch_assoc($result) ) {
				/*echo "<tr>
						<td>{$record['orderid']}</td>
						<td>{$record['restaurantname']}</td>
						<td>{$record['restaurantlocation']}</td>
						<td>{$record['destination']}</td>
						<td>{$record['tip']}</td>
						<td>{$record['quantity']}</td>
						<td>{$record['totalprice']}</td>
						<td>{$record['timeupdate']}</td>
					<tr>"; */
					echo "<tr>
							<td>{$record['orderid']}</td>
							<td>{$record['restaurantname']}</td>
							<td>{$record['tip']}</td>
							<td>{$record['servicecharge']}</td>
							<td>{$record['totalprice']}</td>
						<tr>";
			}
		}
		else{
			echo pg_last_error($db_connection);
		}
	}

?>
 </tbody>
    </table>