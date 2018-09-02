<?php 

if( !getModel("categoryModel") )die("Something Went Wrong");

$cats = getCats();

?>

<div class="sidebar row">
	<div class="row full">
		
		<form action="<?php echo DOMAIN."/home/" ?>" method="post">

			<div class="row full">
				Search : <input type="text" name="sq"><br>
			</div>

			<div class="row">
				Category : <select name="cid" id="cat" onchange="getSubcats()">
					<option value="-1">None</option>
					<?php 
					foreach ($cats as $cat) {
						# code...
						echo "<option value=\"{$cat['id']}\">{$cat['name']}</option>";
					}

					?>
				</select>
			</div>

			<?php
			if( !isCurUserBuyer() ){

			?>
			<div class="row">
				<input type="checkbox" name="sp">Suspended
			</div>

			<?php 
			}
			?>

			<div class="row">
				<input type="submit" value="Search">
			</div>
			
		</form>
		
	</div>
</div>
