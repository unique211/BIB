<article class="content">

    <div class="card card-block">

        <div id="notify" class="alert alert-success" style="display:none;">

            <a href="#" class="close" data-dismiss="alert">&times;</a>



            <div class="message"></div>

        </div>

        <div class="grid_3 grid_4">



            <h3>Top Selling Products</h3>

            <hr>



            <div class="row sameheight-container">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Total Sell</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $count = 0;
                            foreach ($products as $pro) {
                               ?>
                               <tr>
                                   <td><?php echo ($count+1); ?></td>
                                   <td><?php echo ($pro['product']); ?></td>
                                   <td><?php echo ($pro['cnt']); ?></td>
                               </tr>
                               <?php 
                               $count++;
                            }
                            ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</article>