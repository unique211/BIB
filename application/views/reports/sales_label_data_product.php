<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<article class="content">
    <div class="card card-block">
        <?php if ($sales_radio == "2") { ?>
        <h3>By Product</h3>
        <table id="myTable1" class="table" style="width:100%;">
            <thead>
                <tr>
                    <th style="white-space:nowrap;text-align:left;padding:10px;">&nbsp;</th>
                    <th style="white-space:nowrap;text-align:left;padding:10px;">Name</th>
                    <th style="white-space:nowrap;text-align:left;padding:10px;">Total Sale</th>
                    <th style="white-space:nowrap;text-align:left;padding:10px;">Net Sales</th>
                    <th style="white-space:nowrap;text-align:left;padding:10px;">Avg. Sale</th>
                    <th style="white-space:nowrap;text-align:left;padding:10px;">Sale Count</th>
                </tr>
            </thead>
           
            <tbody>
                <?php
                    foreach ($show_details as $value) {
                        $collected = $value['totalsale'];
                        $sales_cnt = $value['salescount'];
                        $avg = floatval($collected) / floatval($sales_cnt);
                        ?>
                 <tr id="tr_<?php echo $value['pid']; ?>">
                    <td><button id="<?php echo $value['pid']; ?>" class="expand">+</button></td>
                    <td><?php echo $value['product_name']; ?></td>
                    <td><?php echo '$'.$value['totalsale']; ?></td>
                    <td><?php echo '$'.$value['totalsale']; ?></td>
                    <td><?php echo '$'.round($avg, 2); ?></td>
                    <td><?php echo $value['salescount']; ?></td>
                </tr>
                <tr id="details_<?php echo $value['pid']; ?>" class="hide" style="display:none"></tr>
                <?php } ?>

            </tbody>
        </table>
        <?php  } ?>
      
        <?php ?>
    </div>

</article>

<script>
   $(".expand").click(function() {
        var id = $(this).attr('id');
        var eid = "details_" + id;
        var sid = '<?php echo $show_id; ?>';
        var html = '';
        console.log(id + ' ' + sid + ' ' + baseurl);
        $(".hide").each(function(index) {
            if (eid != $(this).attr('id'))
                $(this).css('display', 'none');
        });
        $.ajax({

            type: "POST",

            url: baseurl + "reports/getPerProdcut",

            data: {

                pid: id,
                sid: sid,
            },

            dataType: "JSON",



            success: function(data) {
                console.log(data);
                html = "<table><tr><th>Invoice No.</th><th>Invoice Date</th><th>Qty</th><th>Amount</th></tr>";
                $.each(data, function(key, item) {
                    html += "<tr><td>" + item.invoice_number + "</td><td>" + item.billDt + "</td><td>" + item.qty + "</td><td>" + item.subtotal + "</td></tr>";
                   
                });

                html += "</table>";
                console.log(html);
                $("#" + eid).html("<td colspan='6'>" + html + "</td>");
                $("#" + eid).toggle();
            }
        });

        //alert(id);
    });
   
   
</script>