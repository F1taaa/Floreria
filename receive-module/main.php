<h3>Receiving List</h3>
<div id="subcontent">
  <table id="data-list">
    <tr>
      <th>#</th>
      <th>Date Received</th>
      <th>Supplier / Product</th>
      <th>Product Status</th>
      <th>Receive Status</th>
    </tr>
    <?php
    $count = 1;
    if ($receive->list_receive() != false) {
      foreach ($receive->list_receive() as $value) {
        extract($value);
    ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><a href="index.php?page=receive&action=receive&id=<?php echo $rec_id; ?>"><?php echo $rec_date_added; ?></a></td>
          <td><?php echo $rec_supplier . ' - ' . $rec_description; ?></td>
          <td><?php echo $rec_stats; ?></td>
          <td>
            <?php
            if ($rec_saved == 0) {
              echo "Pending Transaction";
            } else {
              echo "Product Received";
            }
            ?>
          </td>
        </tr>
    <?php
        $count++;
      }
    } else {
      echo "<tr><td colspan='5'>No Record Found.</td></tr>";
    }
    ?>
  </table>
  <div class="download-button">	
			<form method="POST" action="reports/xlsx-receive-report.php">
				<button><a><i class="fa fa-download"></i> Excel</a></button>
			</form><form method="POST" action="reports/pdf-receive-report.php">
				<span><button><a><i class="fa fa-download"></i> PDF</a></button></span>
			</form>
		</div>
</div>
