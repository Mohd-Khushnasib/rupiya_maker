<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">

<head>

    <?php require APPPATH . 'views/Auth/CssLinks.php'; ?>

    <style>
    h4,
    h5 {

        font-family: verdana;

    }
    </style>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
</head>

<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- BEGIN: Topbar-->
    <?php require 'Topbar.php'; ?>

    <?php require 'Sidebar.php'; ?>

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <!--extra added here-->
            <div class="row mb-2">
                <div class="col-12">
                    <h5><a href="<?php echo base_url($this->data->controller);?>/Dashboard"><?php echo $this->data->title;?></a> /
                        <span>All Insurance Accounts</span></h5>
                </div>
            </div>
            <!--extra added here-->
            <div class="content-body">

                <!-- Stats -->
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form-center">

                                </h4>
                            </div>
                            <div class="card-content collapse show" style="margin-top:-40px;">
                                <div class="card-body">

                                    <!--table start here -->
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="insurance_account">
                                            <thead>
                                                <tr role="row">
                                                    <th>Sr No</th>
                                                    <th>Membership No</th>
                                                    <th>Policy Date</th>
                                                    <th>Policy Tenure</th>
                                                    <th>Policy Renewal</th>
                                                    <th>Coverage</th>
                                                    <th>( % ) Discount</th>
                                                    <th>Premium Amount</th>
                                                    <th>Policy Year</th>
                                                    <th>Remaining Policy Year</th>
                                                    <th>Upload Policy Documents</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if (empty($insuranceaccount)) {
                                                        echo '<tr><td colspan="11" class="text-center">Data Not Found</td></tr>';
                                                    } else {
                                                        $srno             = 1;
                                                        $total_pre_amount = 0;
                                                        foreach ($insuranceaccount as $item) {
                                                            $user_data = $this->db->get_where('tbl_user', ['id' => $item->user_id])->row();

                                                            $total_pre_amount += (float) $item->pre_amount;
                                                        ?>
                                                <tr role="row">
                                                    <td><?php echo $srno;?></td>
                                                    <td><?php echo $user_data->mship_no;?></td>
                                                    <td><?php echo date('d/m/Y', strtotime($item->issue_date));?></td>
                                                    <td><?php echo $item->indemnity_tenure;?></td>
                                                    <td><?php echo date('d/m/Y', strtotime($item->renewal_date));?></td>
                                                    <td><?php echo $item->coverage;?></td>
                                                    <td><?php echo $item->percentage_discount;?></td>
                                                    <td class="pre_amount"><?php echo $item->pre_amount;?></td>
                                                    <td><?php echo $item->policy_year;?></td>
                                                    <td><?php echo $item->remaining_policy_year;?></td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm"
                                                            href="<?php echo base_url('uploads/category/' . $item->category)?>"
                                                            target="_blank">Policy</a>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $srno++;
                                                        }
                                                    }
                                                ?>
                                            </tbody>

                                            <!-- Footer row for Total Premium Amount -->
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th id="total_pre_amount">
                                                        <?php echo number_format($total_pre_amount, 2);?></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>

                                    </div>
                                    <!--table end here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Footer-->
    <?php require APPPATH . 'views/Auth/Footer.php'; ?>
<?php require APPPATH . 'views/Auth/JsLinks.php'; ?>


    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Buttons Extension -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <!-- Libraries for Export Functionality -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <script>
    $(document).ready(function() {
        var table = $('#insurance_account').DataTable({
            "bInfo": false,
            "autoWidth": true,
            "responsive": true,
            "pageLength": 20,
            "lengthMenu": [5, 10, 15, 20],
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    titleAttr: 'Download as Excel',
                    exportOptions: {
                        columns: ':visible' // Include only visible columns
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Export to PDF',
                    titleAttr: 'Download as PDF',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ],
            "paging": true,
            "drawCallback": function() {
                updateTotalPremiumAmount();
            }
        });

        function updateTotalPremiumAmount() {
            var total_pre_amount = 0;

            // Loop through visible rows only
            $('#insurance_account tbody tr:visible').each(function() {
                total_pre_amount += parseFloat($(this).find('.pre_amount').text()) || 0;
            });

            // Update total in the footer
            $('#total_pre_amount').text(total_pre_amount.toFixed(2));
        }

        // Initialize total calculation on page load
        updateTotalPremiumAmount();
    });
    </script>

</body>
<!-- END: Body-->

</html>