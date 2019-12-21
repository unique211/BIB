<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<article class="content">
    <div class="card card-block">
        <?php if ($sales_radio == "1") { ?>
        <h3>By Salesperson</h3>
        <table id="myTable1" class="table " style="width:100%;">
            <thead>
                <tr>

                    <th style="white-space:nowrap;text-align:left;padding:10px;">&nbsp;</th>
                    <th style="white-space:nowrap;text-align:left;padding:10px;">Name</th>
                    <th style="white-space:nowrap;text-align:left;padding:10px;">Total Collected</th>
                    <th style="white-space:nowrap;text-align:left;padding:10px;">Net Sales</th>
                    <th style="white-space:nowrap;text-align:left;padding:10px;">Avg. Sale</th>
                    <th style="white-space:nowrap;text-align:left;padding:10px;">Sale Count</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    //     print_r($show_details);
                    foreach ($show_details as $value) {
                        $collected = $value['totalcollected'];
                        $sales_cnt = $value['salescount'];
                        $avg = floatval($collected) / floatval($sales_cnt);
                        ?>
                <tr id="tr_<?php echo $value['id']; ?>">
                    <td><button id="<?php echo $value['id']; ?>" class="expand">+</button></td>
                    <td><?php echo $value['name']; ?></td>
                    <td><?php echo '$' . $value['totalcollected']; ?></td>
                    <td><?php echo '$' . $value['totalcollected']; ?></td>
                    <td><?php echo '$' . round($avg, 2); ?></td>
                    <td><?php echo $value['salescount']; ?></td>
                </tr>
                <tr id="details_<?php echo $value['id']; ?>" class="hide" style="display:none"></tr>

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

            url: baseurl + "reports/getByPersonData",

            data: {

                eid: id,
                sid: sid,
            },

            dataType: "JSON",



            success: function(data) {
                html = "<table><tr><th>Invoice No.</th><th>Invoice Date</th><th>Amount</th></tr>";
                $.each(data, function(key, item) {
                    html += "<tr><td>" + item.id + "</td><td>" + item.invoicedate + "</td><td>" + item.total + "</td></tr>";
                    console.log(item.id + ' ' + item.invoicedate + ' ' + item.total);
                });

                html += "</table>";
                // console.log(html);
                $("#" + eid).html("<td colspan='6'>" + html + "</td>");
                $("#" + eid).toggle();
            }
        });

        //alert(id);
    });
</script>