<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="grid_3 grid_4">
              <div class="header-block">
             

                <h3 class="title">
                   Packing List Request History
                </h3>
                <br>
            </div>

            <table class="table table-hover table-striped">
                
                <thead>
                    <th>#</th>
                    <th>Requested at</th>
                    <th>Approved at</th>
                    <th>Recieved  at</th>
                    
                </thead>
                <tbody>
                    <tr data-toggle="modal"  data-target="#task1_model">
                        <td>1</td>
                        <td>2019-05-15 00:10:45</td>
                        <td>2019-05-15 00:10:45</td>
                        <td>2019-05-15 00:10:45</td>   
                    </tr>
                   
                </tbody>

            </table>

        </div>
           <div id="task1_model" class="modal fade" role="dialog">
                    <div style="margin-left: 10%;margin-top: 10%;width: 1100px">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                                </button>
                                <h3 class="modal-title" id="task_title">Product Details </h3>
                            </div>

                            <div>
                               <table class="table table-hover">
                                 <thead>
                                   <th>#</th>
                                   <th>Product Name </th>
                                   <th>Requested Quantity</th>
                                   <th>Requasted At</th>
                                   <th>Approved Quantity</th>
                                   <th>Approved At</th>
                                   <th>Recieved At</th>
                                   <th>Action</th>
                                 </thead>
                                 <tbody>
                                  <tr>
                                   <td>1</td>
                                   <td>Queen Pillow 1</td>
                                   <td>23</td>
                                   <td>2019-05-15 00:10:45</td>
                                   <td>10</td>
                                   <td>2019-05-15 00:10:45</td>
                                   <td>2019-05-15 00:10:45</td>
                                   <td></td>
                                 </tr>
                                  <tr>
                                   <td>2</td>
                                   <td>Queen Pillow 2</td>
                                   <td>20</td>
                                   <td>2019-05-15 00:10:45</td>
                                   <td>15</td>
                                   <td>2019-05-15 00:10:45</td>
                                   <td>-</td>
                                   <td><a href="" class="btn btn-success btn-sm rounded" data-id="" data-stat="0">Confirm</a></td>
                                 </tr>
                                 <tr>
                                   <td>3</td>
                                   <td>Queen Pillow 3</td>
                                   <td>20</td>
                                   <td>2019-05-15 00:10:45</td>
                                   <td><input type="number" class="form-control" min="0" value="0" /></td>
                                   <td>-</td>
                                   <td>-</td>
                                   <td><a href="" class="btn btn-primary btn-sm rounded" data-id="" data-stat="0">Approve</a></td>
                                 </tr>
                                 </tbody>
                                  
                               </table>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</article>
