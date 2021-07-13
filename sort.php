<?php
include( "header.php" );
?><div class="container">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mt-5">
            <div class="card-header">
                <h4>Movies Sorting</h4>
            </div>
            <div class="card-body">
                <div>
                <h4>Sort by movie release date</h4>
                <form action="" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <select name="sort_date" class="form-control">
                                    <option value="">--Select Option--</option>
                                    <option value="a-z" <?php if(isset($_GET['sort_date']) && $_GET['sort_date'] == "a-z"){ echo "selected"; } ?> > 1-30 (Movie Release Date Ascending Order)</option>
                                    <option value="z-a" <?php if(isset($_GET['sort_date']) && $_GET['sort_date'] == "z-a"){ echo "selected"; } ?> > 30-1 (Movie Release Date Descending Order)</option>
                                </select>
                                <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">
                                    Sort
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">Image</th>
                                <th width="10%">Movie Name</th>
                                <th width="10%">Description</th>
                                <th width="10%">Movie Length</th>
                                <th width="15%">Release Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                
                                $sort_option2 = "";
                                if(isset($_GET['sort_date']))
                                {
                                    if($_GET['sort_date'] == "a-z")
                                    {
                                        $sort_option = "ASC";
                                    }
                                    elseif($_GET['sort_date'] == "z-a")
                                    {
                                        $sort_option2 = "DESC";
                                    }
                                }

                                $query = "SELECT DISTINCT relationship.*,movies.*, category.* from category,relationship,movies where relationship.movie_id = movies.id && relationship.cat_id =category.id ORDER BY released $sort_option2";
                                $query_run = mysqli_query($con, $query);

                                if(mysqli_num_rows($query_run) > 0)
                                {
                                    foreach($query_run as $row)
                                    {
                                        ?>
                                        <tr>
                                            <td><img src="<?php echo SITE_MOVIE_IMAGE.$row['featured_image'];?>" width="100" height="100"/></td>
                                            <td><?= $row['title']; ?></td>
                                            <td><?= $row['description']; ?></td>
                                            <td><?= $row['movie_length']; ?></td>
                                            <td><?= $row['released']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                        <tr>
                                            <td colspan="3">No Record Found</td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

<?php
include( "footer.php" );
?>
