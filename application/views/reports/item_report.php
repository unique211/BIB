<?php



?>
<article class="content">

  <div class="card card-block">

    <div id="notify" class="alert alert-success" style="display:none;">

      <a href="#" class="close" data-dismiss="alert">&times;</a>
      <div class="message"></div>

    </div>

    <div class="grid_3 grid_4">

      <h3>Item Report</h3>

      <hr>

      <div class="row sameheight-container">

        <div class="col-md-12">

          <form method="post" action="<?php echo base_url(); ?>reports/item_report">

            <div class="form-group row">

              <label class="col-sm-3 col-form-label" for="show"><b>Select Product Catagory</b></label>

              <div class="col-sm-4">

                <select name="product_cat" id="product_cat" class="form-control select-box">

                  <?php

                  foreach ($product_catagory as $row) {

                    $id = $row['id'];
                    $name = $row['title'];

                    if ($cid == $id) {
                      echo "<option selected value=" . $id . ">$name</option>";
                    } else {


                      echo "<option value=" . $id . ">$name</option>";
                    }
                  }

                  ?>

                </select>

              </div>

            </div>
            <div class="form-group row">

              <label class="col-sm-3 col-form-label" for="show"><b>Select Item</b></label>

              <div class="col-sm-4">

                <select name="item" id="item" class="form-control select-box">

                  <?php

                  foreach ($item as $row) {

                    $id = $row['item_id'];
                    $name = $row['item_name'];
                    echo "<option value='0'>All</option>";
                    if ($item_id == $id) {
                      echo "<option selected value=" . $id . ">$name</option>";
                    } else {


                      echo "<option value=" . $id . ">$name</option>";
                    }
                  }

                  ?>

                </select>

              </div>

            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label"></label>
              <div class="col-sm-4">
                <button type="submit" class="btn btn-success ">View</button>
              </div>
            </div>
          </form>
          <br>
        </div>
      </div>
    </div>

  </div>
</article>
<script>
  function items(pid) {
    $.ajax({

      url: baseurl + 'reports/item_cat',

      type: 'POST',

      data: {
        pcat: pid
      },

      dataType: 'json',

      success: function(data) {
        var html = '<option value="0">All</option>';
        $.each(data, function(key, value) {
          html += '<option value="' + value.item_id + '">' + value.item_name + '</option>';
          console.log(value.item_id);
        });
        $("#item").html(html);
        console.log(data);
      }
    });
  }
  $('#product_cat').change(function() {
    var pid = $('#product_cat').val();
    items(pid);
    console.log(pid);

  });
 var item = '<?php echo $item?>';
 console.log('items '+(item));
  if(item==''){
    var pid = $('#product_cat').val();
    items(pid);
    console.log('pid'+pid);
  }
 
</script>