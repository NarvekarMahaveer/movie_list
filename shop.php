<?php
include( "header.php" );
?>
    
    <div class="container">
        <div class="row">
        

            <!-- Brand List  -->
            <div class="col-md-3">
                <form action="" method="GET">
                    <div class="card shadow mt-3">
                        <div class="card-header">
                            <h5>Filter 
                                <button type="submit" class="btn btn-primary btn-sm float-end">Search</button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Movies Genre</h6>
                            <hr>
                            <?php
                                $brand_query = "SELECT DISTINCT(category.id), relationship.*, category.type, category.value from category,relationship,movies where relationship.movie_id = movies.id && relationship.cat_id =category.id and category.type='Genre'";
                                $brand_query_run  = mysqli_query($con, $brand_query);

                                if(mysqli_num_rows($brand_query_run) > 0)
                                {
                                    foreach($brand_query_run as $brandlist)
                                    {
                                        $checked = [];
                                        if(isset($_GET['movie']))
                                        {
                                            $checked = $_GET['movie'];
                                        }
                                        ?>
                                            <div>
                                                <input type="checkbox" name="movie[]" value="<?= $brandlist['id']; ?>" 
                                                    <?php if(in_array($brandlist['id'], $checked)){ echo "checked"; } ?>
                                                 />
                                                <?= $brandlist['value']; ?>
                                            </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "No movie Found";
                                }
                            ?>
                        </div>
                    </div>
                </form>
                <form action="" method="GET">
                    <div class="card shadow mt-3">
                        <div class="card-header">
                            <h5>Filter 
                                <button type="submit" class="btn btn-primary btn-sm float-end">Search</button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Movies Language</h6>
                            <hr>
                            <?php
                                $brand_query = "SELECT DISTINCT(category.id), relationship.*, category.type, category.value from category,relationship,movies where relationship.movie_id = movies.id && relationship.cat_id =category.id and category.type='Language'";
                                $brand_query_run  = mysqli_query($con, $brand_query);

                                if(mysqli_num_rows($brand_query_run) > 0)
                                {
                                    foreach($brand_query_run as $brandlist)
                                    {
                                        $checked = [];
                                        if(isset($_GET['movie']))
                                        {
                                            $checked = $_GET['movie'];
                                        }
                                        ?>
                                            <div>
                                                <input type="checkbox" name="movie[]" value="<?= $brandlist['id']; ?>" 
                                                    <?php if(in_array($brandlist['id'], $checked)){ echo "checked"; } ?>
                                                 />
                                                <?= $brandlist['value']; ?>
                                            </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "No movie Found";
                                }
                            ?>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Brand Items - Products -->
            <div class="col-md-9 mt-3">
                <div class="card ">
                    <div class="card-body row">
                        <?php
                            if(isset($_GET['movie']))
                            {
                                $branchecked = [];
                                $branchecked = $_GET['movie'];
                                foreach($branchecked as $rowbrand)
                                {
                                    //echo $rowbrand;
                                    $products = "SELECT DISTINCT category.type, category.value, movies.title, movies.description, movies.featured_image, movies.movie_length, movies.released from relationship,movies,category where relationship.movie_id = movies.id IN ($rowbrand) and relationship.cat_id = category.id";
                                    $products_run = mysqli_query($con, $products);
                                    if(mysqli_num_rows($products_run) > 0)
                                    {
                                        foreach($products_run as $proditems) :
                                            ?>
                                                <div class="col-md-4 mt-3">
                                                    <div class="border p-2">
                                                    
                                                    
                                                    <div class="product-img"> <a href="javascript:void(0)"> <img src="<?php echo SITE_MOVIE_IMAGE.$proditems['featured_image']?>" id="myBtn" alt=""> </a> </div>
                                                    <h4>Movie: <?= $proditems['title']; ?></h4>
                                                    <h6>Description: <?= $proditems['description']; ?></h6>
                                                    <h6>Length: <?= $proditems['movie_length']; ?></h6>
                                                    <h6>Release: <?= $proditems['released']; ?></h6>  
                                                </div>
                                                </div>
                                            <?php
                                        endforeach;
                                    }
                                }
                            }
                            else
                            {
                                $products = "SELECT DISTINCT relationship.*, category.type, category.value, movies.title, movies.description, movies.featured_image, movies.movie_length, movies.released from relationship,movies,category where relationship.movie_id = movies.id and relationship.cat_id = category.id";
                                $products_run = mysqli_query($con, $products);
                                if(mysqli_num_rows($products_run) > 0)
                                {
                                    foreach($products_run as $proditems) :
                                        ?>
                                            <div class="col-md-4 mt-3">
                                                <div class="border p-2">
                                                <div class="product-img"> <a href="javascript:void(0)"> <img src="<?php echo SITE_MOVIE_IMAGE.$proditems['featured_image']?>" id="myBtn" alt=""> </a> </div>
                                                    <h4>Movie: <?= $proditems['title']; ?></h4>
                                                    <h6>Description: <?= $proditems['description']; ?></h6>
                                                    <h6>Length: <?= $proditems['movie_length']; ?></h6>
                                                    <h6>Release: <?= $proditems['released']; ?></h6>
                                                </div>
                                            </div>
                                        <?php
                                    endforeach;
                                }
                                else
                                {
                                    echo "No Items Found";
                                }
                            }
                        ?>
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
