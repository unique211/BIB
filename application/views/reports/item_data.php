<article class="content">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!--Sweetalert -->
    <link href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css" rel="stylesheet">

    <div class="card card-block">


        <?php //print_r($item_data);

        // foreach ($items as $row) {
        //     print_r($row->item_name);
        // }
        ?>
        <div class="table-responsive">
            <table id="itemstable" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Qty') ?></th>
                        <th><?php echo $this->lang->line('Code') ?></th>
                        <th><?php echo $this->lang->line('Category') ?></th>
                        <th><?php echo $this->lang->line('Price') ?></th>
                        <th><?php echo $this->lang->line('Product Barcode') ?></th>
                        <th><?php echo $this->lang->line('Item Name') ?></th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($item_data as $row) {
                        $name = $row['product_name'] . ' ' . $row['clr'] . ' ' . $row['sz'] . ' ' . $row['mtr'];
                        $qty = isset($row['qty']) ? $row['qty'] : 0;
                        $item_name = $row['item_name'];
                        $code = $row['product_code'];
                        $product_price = $row['product_price'];
                        $cat = $row['cat'];
                        $img = $row['barcode_img'];

                        $img  = ($img != '') ? '<img class="img"  src="' . base_url() . 'assets/product_barcode/' . $img . '" width=300 height=40 />' : "-";


                        echo "<tr>
                    <td>$i</td>
                    <td>$name</td>
                    <td>$qty</td>
                    <td>$code</td>
                    <td>$cat</td>
                    <td>$ $product_price </td>
                    <td>$img</td>
                    <td>$item_name</td>";


                        $i++;
                    }
                    $totalstock = $instock + $outstock;
                    ?>
                </tbody>

                <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Qty') ?></th>
                        <th><?php echo $this->lang->line('Code') ?></th>
                        <th><?php echo $this->lang->line('Category') ?></th>
                        <th><?php echo $this->lang->line('Price') ?></th>
                        <th><?php echo $this->lang->line('Product Barcode') ?></th>
                        <th><?php echo $this->lang->line('Item Name') ?></th>

                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <input type="hidden" id="dashurl" value="products/prd_stats">
</article>

<!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->


<script type="text/javascript">
    var table;

    $(document).ready(function() {
        var groupColumn = 7;
        var table = $('#itemstable').DataTable({
            // "processing": true,
            // "serverSide": true,
            dom: 'Bfrtip',
            buttons: [
                //# 'copyHtml5', 'excelHtml5', 'pdfHtml5', 'csvHtml5'
                // {
                //     extend: 'excel',
                //     title: 'Item Details',
                //     exportOptions: {
                //         columns: [0, 1, 2, 3, 4, 5, 6, 7]
                //     }

                // },
                // {
                //     extend: 'pdf',
                //     title: 'Item Details',
                //     exportOptions: {
                //         columns: [0, 1, 2, 3, 4, 5, 6, 7],
                //         stripHtml: false,
                //     },
                //     customize: function(win) {
                //         $(win.document.body)
                //             .css('font-size', '10pt')
                //             .prepend(
                //                 '<img src="" style="position:absolute; top:0; left:0;" />'
                //             );

                //         $(win.document.body).find('table')
                //             .addClass('compact')
                //             .css('font-size', 'inherit');
                //     }

                // },
                {
                    extend: 'print',
                    title: 'Item Details',

                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7],
                        stripHtml: false,
                    },
                    // customize: function ( win ) {
                    //     $(win.document.body)
                    //         .css( 'font-size', '11px' );

                    //     $(win.document.body).find( 'table' )
                    //         .css( 'font-size', '11px' );
                    //         $(win.document.body).find('h1').css('font-size', '14pt')
                    //         .css('text-align', 'center');

                    //     $(win.document.body).find( 'table' )
                    //         .removeClass( 'table-striped' ).removeClass( 'dataTable' );
                    // }

                }
            ],
            'columnDefs': [{
                'searchable': false,
                'targets': [0, 2, 6]
            }, {
                'targets': [6],
                /* column index */
                'orderable': false,
                /* true or false */
            }, {
                "visible": false,
                "targets": groupColumn
            }],
            "order": [
                [0, 'asc']
            ],
            'drawCallback': function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;

                api.column(groupColumn, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                            '<tr class="group"><td colspan="7">' + group + '</td></tr>'
                        );

                        last = group;
                    }
                });
            }


        });
        // Order by the grouping
        $('#itemstable tbody').on('click', 'tr.group', function() {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === 0 && currentOrder[1] === 'asc') {
                table.order([0, 'desc']).draw();
            } else {
                table.order([0, 'asc']).draw();
            }
        });



    });
</script>