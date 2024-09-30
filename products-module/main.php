<div id="search-result">
  <h3>Product Details</h3>
  <div id="subcontent">
    <table id="data-list">
      <tr>
        <th>#</th>
        <th>Product Name</th>
        <th>Description</th>
        <th>QOH</th>
      </tr>
      <?php
      $count = 1;
      $products = $product->list_product();
      if ($products !== false) {
        foreach ($products as $value) {
          extract($value);
          ?>
          <tr>
            <td><?php echo $count; ?></td>
            <td><a href="index.php?page=products&action=profile&id=<?php echo $prod_id; ?>"><?php echo $prod_name; ?></a></td>
            <td><?php echo $product->get_prod_type_name($product->get_prod_type($prod_id)); ?></td>
            <td><?php echo $inventory->get_product_receive_inv($prod_id) - $inventory->get_product_release_inv($prod_id); ?></td>
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
			<form method="POST" action="reports/xlsx-products-report.php">
				<button><a><i class="fa fa-download"></i> Excel</a></button>
			</form><form method="POST" action="reports/pdf-products-report.php">
				<span><button><a><i class="fa fa-download"></i> PDF</a></button></span>
			</form>
		</div>
  </div>
</div>
