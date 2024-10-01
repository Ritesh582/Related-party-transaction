<?php
$pagename = 'create_new_table.php';
include('includes/config.php');
include "includes/session_check.php";
$showmsg = message($_GET['msg']);
include "includes/header.php";
include "includes/bank_recon_leftmenu.php";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tableName = isset($_POST['table_name']) ? trim($_POST['table_name']) : '';
    $columns = [];
    $csvFileName = '';

    // Handle CSV file upload
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {
        $csvFileName = $_FILES['csv_file']['name']; // Capture the name of the uploaded CSV file
        $csvFile = fopen($_FILES['csv_file']['tmp_name'], 'r');
        if ($csvFile) {
            // Read the header line (first row only)
            $header = fgetcsv($csvFile);
            if ($header) {
                foreach ($header as $columnName) {
                    $columns[] = [
                        'name' => trim($columnName),
                        'type' => 'VARCHAR(255)' // Default data type
                    ];
                }
            }
            fclose($csvFile);
        }
    }

    if (!empty($tableName) && !empty($columns)) {
        // Start creating the SQL query for table creation
        $sql = "CREATE TABLE `$tableName` (
                    id INT AUTO_INCREMENT PRIMARY KEY";

        // Add columns from CSV file
        foreach ($columns as $column) {
            $columnName = trim($column['name']);
            $columnType = $column['type'];

            if (!empty($columnName) && !empty($columnType)) {
                $sql .= ", `$columnName` $columnType";
            }
        }

        // Add additional columns after CSV columns
        $sql .= ",amount_status VARCHAR(50),
                  count_status VARCHAR(50),
                  system_number VARCHAR(50),
                 comp_code VARCHAR(255),
                 dept_code VARCHAR(255),
                 added_by VARCHAR(255),
                 added_date DATE,
                 updated_by VARCHAR(255),
                 updated_date DATE
                );";

        // Execute the SQL query to create the table
        if ($Db->query($sql)) {
            echo "Table '$tableName' created successfully!";

            // Fetch the last serial number used
            $serialSql = "SELECT MAX(CAST(SUBSTRING(system_number, LENGTH('".$_SESSION['comp_code_tmp'].$_SESSION['dept_code_tmp']."') + 1) AS UNSIGNED)) AS last_serial
                          FROM tbl_created
                          WHERE LEFT(system_number, LENGTH('".$_SESSION['comp_code_tmp'].$_SESSION['dept_code_tmp']."')) = '".$_SESSION['comp_code_tmp'].$_SESSION['dept_code_tmp']."'";
            $result = $Db->query($serialSql);
            $lastSerial = 0;
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $lastSerial = isset($row['last_serial']);
            }
            $serialNumber = $lastSerial + 1; // Increment the serial number

          //  $processName = isset($_POST['process_name']) ? trim($_POST['process_name']) : '';
            $systemNumber = str_pad($serialNumber, 4, '0', STR_PAD_LEFT);

            // Insert the table_name, file_name, and process_name into the tbl_created table
            $insertSql = "INSERT INTO tbl_created (table_name, file_name, system_number, comp_code, dept_code, added_by, added_date) 
                          VALUES ('$tableName', '$csvFileName',  '$systemNumber', '".$_SESSION['comp_code_tmp']."','".$_SESSION['dept_code_tmp']."','".$_SESSION['user_id_tmp']."', CURDATE())";

            if ($Db->query($insertSql)) {
                echo "Table name '$tableName' and file name '$csvFileName' saved successfully in tbl_created!";
                header("Location: ".$pagename."?msg=tbladd&selected_table=".urlencode($tableName));
                exit;
            } else {
                echo "Error saving table name and file name in tbl_created: " . $Db->error;
            }
        } else {
            echo "Error creating table '$tableName': " . $Db->error;
        }
    } else {
        echo "Please provide a table name and a valid CSV file.";
    }
}
?>

<div id="page-wrapper" class="gray-bg">
<?php include "includes/sub-header.php"; ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Bulk Upload</h2>
        <ol class="breadcrumb">
            <li><a href="bank_recon_dashboard.php">Home</a></li>
            <li class="active"><strong>Bulk Upload</strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Bulk Upload File</h5>
                    
                    <div class="ibox-tools">
                    
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a></li>
                            <li><a href="#">Config option 2</a></li>
                        </ul>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                </div>

                <div class="ibox-content">
                <?php
            
                 if($showmsg != ""){$class = 'success';if($_GET['msg'] == 'ndel'){$class = 'info';}echo "<p class='".$class."'>".$showmsg."<span>X</span></p>";}?>
                    <table align="center" border="0">
                        <tr>
                            <td colspan="4"><strong><font size="4">Instruction for File Upload</font></strong></td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>1. Excel File should be in .csv format only.</strong></td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>2. Column Names Required in the sequence of csv file.</strong></td>
                        </tr>
                        <tr>
                            <td colspan="4"><strong>3. Write your Header in Horizontal in csv file.</strong></td>
                            <i class="fa fa-info-circle icon" data-toggle="modal" data-target="#infoModal3"></i>
                        </tr>
                        <tr>
                            <td colspan="4" align="center"><font color="#FF0000" size="2">Column name cannot be empty</font></td>
                        </tr>
                        <tr>
                            <td colspan="4" align="center"><font color="#FF0000" size="2"><?php if($err_msg!='')echo $err_msg;?></font></td>
                        </tr>
                    </table>
                    <br><br>

                    <div class="form-container">
                        <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($pagename, ENT_QUOTES, 'UTF-8'); ?>" class="form-horizontal">
                            <div class="form-group">
                                <label for="table_name" class="col-sm-4 control-label">Table Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="table_name" name="table_name" class="form-control text-center" required>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="process_name" class="col-sm-4 control-label">Enter Process name:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="process_name" name="process_name" class="form-control text-center" required>
                                </div>
                            </div> -->
                    
                            <div class="form-group">
                                <label for="csv_file" class="col-sm-4 control-label">Upload CSV File:</label>
                                <div class="col-sm-10">
                                    <input type="file" id="csv_file" name="csv_file" class="form-control" accept=".csv" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-5">
                                    <input type="submit" value="Create Table" class="btn btn-success btn-block">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>
</div>
<div class="modal fade" id="infoModal3" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel3" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel3">important Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              1: Donot leave space between two word use _  this .<br>
              2: Eg tbl data not like this .<br>
              3: Your table should be tbl_data like this.<br>
              4: Same for the header also and for header dont use capital letter use small latter
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
.form-horizontal .control-label {
    text-align: left;
}
.form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}
.form-group {
    margin-bottom: 15px;
    text-align: center;
}
.btn {
    margin-top: 10px;
}
.icon{
float:right;
font-size:25px;
}
</style>
