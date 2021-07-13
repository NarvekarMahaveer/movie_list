<?php 
include('top.php');


$sql="SELECT distinct(relationship.movie_id), category.type, category.value, movies.title, movies.description, movies.featured_image, movies.movie_length, movies.released from relationship,movies,category where relationship.movie_id = movies.id and relationship.cat_id = category.id";
$res=mysqli_query($con,$sql);

?>
  <div class="card">
            <div class="card-body">
              <h1 class="grid_title">Movies Master</h1>
			  <div class="row grid_box">
				
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="10%">S.No #</th>
                            <th width="15%">Movie Title</th>
                            <th width="25%">Description</th>
							<th width="10%">Movie Length</th>
							<th width="15%">Image</th>
							<th width="15%">Release On</th>
							<th width="15%"> Category Type</th>
							<th width="15%"> Category Value</th>
                            
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(mysqli_num_rows($res)>0){
						$i=1;
						while($row=mysqli_fetch_assoc($res)){
						?>
						<tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row['title']?></td>
							<td><?php echo $row['description']?> </td>
							<td><?php echo $row['movie_length']?> </td>
							<td><a target="_blank" href="<?php echo SITE_MOVIE_IMAGE.$row['featured_image']?>"><img src="<?php echo SITE_MOVIE_IMAGE.$row['featured_image']?>"/></a></td>
							<td>
							<?php 
							$dateStr=strtotime($row['released']);
							echo date('d-m-Y',$dateStr);
							?>
							</td>
							<td><?php echo $row['type']?> </td>
							<td><?php echo $row['value']?> </td>
                        </tr>
                        <?php 
						$i++;
						} } else { ?>
						<tr>
							<td colspan="5">No data found</td>
						</tr>
						<?php } ?>
                      </tbody>
                    </table>
                  </div>
				</div>
              </div>
            </div>
          </div>
        
<?php include('footer.php');?>