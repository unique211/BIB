<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="grid_3 grid_4">

             <div class="header-block">
             

                <h3 class="title">
                   
                   Test Show
                   
                    
                   
                </h3>
                 <p>
                    <b><a href="#" class="btn btn-primary btn-sm rounded">
                        <?php echo $this->lang->line('Show') ?> 1
                                </a>  
                               </b>
                </p>
            
            </div>

            <br>

            <form method="post"  class="form-horizontal">
                <hr>

                  <div class="table-responsive">
                                        <table id="approveTeamLeadertable" class="display" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                            <th>#</th>
                                            <th><?php echo $this->lang->line('Team Leader') ?></th>
                                            <th><?php echo $this->lang->line('Applied Date') ?></th>
                                            <th><?php echo $this->lang->line('Actions') ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td>1</td>
                                                <td style="color:purple">Team Leader 1</td>
                                                <td>6/05/2019</td>
                                                <td><a href="" class="btn btn-success btn-sm rounded" data-id="" data-stat="0"> <i style="font-size: 20px" class="ficon icon-thumbsup"></i></a> <a href="" class="btn btn-danger btn-sm rounded"  data-id="'" data-stat="0"> <i style="font-size: 20px" class="ficon icon-thumbsdown"></i></a></td>
                                                <tr>
                                                     <tr>
                                                <td>1</td>
                                                <td style="color:purple">Team Leader 2</td>
                                                <td>5/05/2019</td>
                                                <td><a href="" class="btn btn-success btn-sm rounded" data-id="" data-stat="0"> <i style="font-size: 20px" class="ficon icon-thumbsup"></i></a> <a href="" class="btn btn-danger btn-sm rounded"  data-id="'" data-stat="0"> <i style="font-size: 20px" class="ficon icon-thumbsdown"></i></a></td>
                                                <tr>
                                            </tbody>
                                        </table>
                                    </div> 
            </form>
        </div>
    </div>
</article>
<script type="text/javascript">

     $(document).ready(function () {

          $('#approveTeamLeadertable').DataTable({});

      });
</script>