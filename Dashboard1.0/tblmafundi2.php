<?php
// Include config file
require_once "Config.php";

// Define variables and initialize with empty values
$first_name = $trade_type = $last_name = $fundi_type = $id_number = $phone = $town = $comments = $status = "";
$first_name_err = $trade_type_err = $last_name_err = $fundi_type_err = $id_number_err = $phone_err = $town_err = $comments_err = $status_err = "";



// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate first_name
    if(empty(trim($_POST["first_name"]))){
        $first_name_err = "Please enter your first name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT last_name FROM tblmafundi WHERE first_name = :first_name";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":first_name", $param_uname, PDO::PARAM_STR);

            // Set parameters
            $param_first_name = trim($_POST["first_name"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $first_name_err = "Please enter the first name of the contractor.";
                } else{
                    $first_name = trim($_POST["first_name"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }




    // Validate phone number
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter your phone number.";
    } elseif(strlen(trim($_POST["phone"]))==!10){
        $phone_err = "phone must have 10 characters.";
    } else{
        $phone = trim($_POST["phone"]);
    }

	//Validate trade_type
    if(empty(trim($_POST["trade_type"]))){
        $trade_type_err = "Please select a project trade_type.";
    } else{
        $trade_type = trim($_POST["trade_type"]);

    }
//Validate last_name
    if(empty(trim($_POST["last_name"]))){
        $last_name_err = "Please enter your last name.";

    } else{
        $last_name = trim($_POST["last_name"]);


    }

    //Validate contractor
        if(empty(trim($_POST["fundi_type"]))){
            $fundi_type_err = "Please enter the fundi_type.";

        } else{
            $fundi_type = trim($_POST["fundi_type"]);


        }
        //Validate date
            if(empty(trim($_POST["id_number"]))){
                $id_number_err = "Please enter your ID number.";

            } else{
                $id_number = trim($_POST["id_number"]);


            }
            //Validate town
                if(empty(trim($_POST["town"]))){
                    $town_err = "Please enter your town.";

                } else{
                    $town = trim($_POST["town"]);

                }

                //Validate comments
                if(empty(trim($_POST["comments"]))){
                    $comments_err = "Please comment.";

                } else{
                    $comments = trim($_POST["comments"]);

                }

                //Validate status
                    if(empty(trim($_POST["status"]))){
                        $status_err = "Please slect the status.";

                    } else{
                        $status = trim($_POST["status"]);

                    }


    // Check input errors before inserting in database
    if(empty($first_name_err) && empty($trade_type_err) && empty($last_name_err)  && empty($fundi_type_err)  && empty($id_number_err)
        && empty($phone_err) && empty($town_err) && empty($comments_err) && empty($status_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO tblmafundi (first_name, phone, trade_type, last_name, fundi_type, id_number, town, comments, status )
         VALUES (:first_name, :phone, :trade_type, :last_name, :fundi_type, :id_number, :town, :comments, :status)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters


              $stmt->bindParam(":first_name", $param_first_name, PDO::PARAM_STR);
              $stmt->bindParam(":trade_type", $param_trade_type, PDO::PARAM_STR);
              $stmt->bindParam(":last_name", $param_last_name, PDO::PARAM_STR);
              $stmt->bindParam(":fundi_type", $param_fundi_type, PDO::PARAM_STR);
              $stmt->bindParam(":id_number", $param_id_number, PDO::PARAM_STR);
              $stmt->bindParam(":phone", $param_phone, PDO::PARAM_STR);
              $stmt->bindParam(":town", $param_town, PDO::PARAM_STR);
              $stmt->bindParam(":comments", $param_comments, PDO::PARAM_STR);
              $stmt->bindParam(":status", $param_status, PDO::PARAM_STR);
            // Set parameters
            $param_first_name = trim($_POST["first_name"]);
            $param_trade_type = trim($_POST["trade_type"]);
            $param_last_name = trim($_POST["last_name"]);
            $param_fundi_type = trim($_POST["fundi_type"]);
            $param_id_number = trim($_POST["id_number"]);
            $param_phone = trim($_POST["phone"]);
            $param_town = trim($_POST["town"]);
            $param_comments = trim($_POST["comments"]);
            $param_status = trim($_POST["status"]);


            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Stay on this page
              header("location: tblmafundi2.php");

            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Contractor Details</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html"><img src="assets/img/ncalogo.jpg" style="width:170px; margin-top:40px;" ></img></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav"></br></br>
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="user.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                User
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Account
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="tbluser2.php">Add new account</a>


                                        </nav>
                                    </div>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">

                                            <a class="nav-link" href="tblprojects2.php">Enter  Details</a>

                                        </nav>
                                    </div>

                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Huduma services
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
			<!-- side menu-->
			<div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Service
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">

                                            <a class="nav-link" href="tblcontractorr2.php">Contractor details</a>
                                            <a class="nav-link" href="tblprojects2.php">Projects</a>
                                            <a class="nav-link" href="tblmafundi2.php">Accreditation</a>
                                            <a class="nav-link" href="tblenquiries2.php">General Enquiries</a>
                                            <!--<a class="nav-link" href="reports.html">Reports</a> -->

					</nav>
				    </div>
			       </nav>
			</div>
			<!-- side menu-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Reports
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>




                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        User
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Site Supervisor and Skilled workers</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" target="votar">



<div class=" row mb-3">
 <!--- <div class="mb-3">
    <label for="projectname" class="form-label">Project Name *</label>
    <input type="text" minlength="5" class="form-control" id="projectname" aria-describedby="emailHelp" required>
  </div>
   -->

  <!--- -->
  <div class="col-md-3">
    <!-- <h6>Class</h6> -->
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>>
        <input type="text" minlength="5" name="first_name" class="form-control" id="fname" aria-describedby="emailHelp" value="<?php echo $first_name; ?>" required>
        <label for="fname" class="form-label">Enter First Name *</label>
        <span class="help-block"><?php echo $first_name_err; ?></span>

      </div>

  </div>

  <div class="col-md-3">
    <!-- <h6>Registration. No</h6> -->
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>>
        <input type="text" minlength="5" name="last_name" class="form-control" id="projectid" aria-describedby="emailHelp" value="<?php echo $last_name; ?>" required>
        <label for="lname" class="form-label">Enter Last Name *</label>
        <span class="help-block"><?php echo $last_name_err; ?></span>

      </div>
  </div>

  <div class="col-md-3">
    <!-- <h6>Registration. No</h6> -->
      <div class="form-floating mb-3 mb-md-0"  <?php echo (!empty($id_number_err)) ? 'has-error' : ''; ?>>
        <input type="number" minlength="5" name="id_number" class="form-control" id="id_number" aria-describedby="emailHelp" value="<?php echo $id_number; ?>" required>
        <label for="idnumber" class="form-label" >ID Number *</label>
        <span class="help-block"><?php echo $id_number_err; ?></span>

      </div>
  </div>

  <div class="col-md-3">
  <!-- <h6>Commencement Date</h6> -->
      <div class="form-floating mb-3 mb-md-0"  <?php echo (!empty($trade_type_err)) ? 'has-error' : ''; ?>>
        <select name="trade_type" id="trade_type" value="<?php echo $trade_type; ?>" required>
                <option value="0">Select Trade...</option>
                <option value="Stone Mason">Stone Mason</option>
				<option value="Plumber">Building works</option>
                <option value="carpenter">Carpenter</option>
                <option value="Plumber">Plumber</option>
                <option value="Electrician">Electrician</option>
				<option value="Plumber">Plumber</option>
				<option value="Painter">Painter</option>
				<option value="Plant Operator">Plant Operator</option>
          </select>
      </div>
  </div>
</div>
  <div class="mb-3">
    <!-- <label for="contacts" class="form-label">Contacts and comments</label> -->
  </div>
  <div class=" row mb-3">
  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>>
        <input type="number" name="phone" maxlength="10" class="form-control" id="phone" aria-describedby="emailHelp" value="<?php echo $phone; ?>" required>
        <label for="phone" class="form-label" >Phone Number *</label>
        <span class="help-block"><?php echo $phone_err; ?></span>

      </div>
  </div>
  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($town_err)) ? 'has-error' : ''; ?>>
        <input type="text" name="town" minlength="3" class="form-control" id="town" aria-describedby="emailHelp" value="<?php echo $town; ?>" required>
        <label for="town" class="form-label">Enter Town *</label>
        <span class="help-block"><?php echo $town_err; ?></span>

      </div>
  </div>
  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($comments_err)) ? 'has-error' : ''; ?>>
        <input type="text" name="comments" minlength="2" class="form-control" id="comments" aria-describedby="emailHelp" value="<?php echo $comments; ?>" required>
        <label for="comments" class="form-label">Comments *</label>
        <span class="help-block"><?php echo $comments_err; ?></span>

      </div>
  </div>
  <div class="col-md-3">
   <!-- <h6>Category</h6> select-->
   <div class="form-floating mb-3 mb-md-0"  <?php echo (!empty($fundi_type_err)) ? 'has-error' : ''; ?>>
        <select name="fundi_type" id="status" value="<?php echo $fundi; ?>" required>
                <option value="0">Select Fundi Type..</option>
                <option value="Site Supervisor">Site Supervisor</option>
				        <option value="Skilled Worker">Skilled Worker</option>

          </select>

      </div>
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($status_err)) ? 'has-error' : ''; ?>>
        <select name="status" id="status" value="<?php echo $status; ?>" required>
                <option value="0">Select Status...</option>
                <option value="Commercial">Complete</option>
                <option value="Residential">Incomplete</option>
                <option value="Complete">Awaiting Payment</option>
				<option value="Complete">Collected</option>
          </select>
      </div>
	  <div>

	  </div>

  </div>

</div>
<button type="submit" class="btn btn-primary">Save</button>
</form>
                        </div>


                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; National Construction Authority 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
