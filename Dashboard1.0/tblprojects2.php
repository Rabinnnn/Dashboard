<?php
// Include config file
require_once "Config.php";

// Define variables and initialize with empty values
$project_name = $project_id = $developer_name = $contractor_reg = $start_date = $phone = $email = $comment = $project_type = "";
$project_name_err = $project_id_err = $developer_name_err = $contractor_reg_err = $start_date_err = $phone_err = $email_err = $comment_err = $project_type_err = "";



// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate project_name
    if(empty(trim($_POST["project_name"]))){
        $project_name_err = "Please enter your project's name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT project_id FROM tblprojects WHERE project_name = :project_name";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":project_name", $param_uname, PDO::PARAM_STR);

            // Set parameters
            $param_project_name = trim($_POST["project_name"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $project_name_err = "Please enter the name you signed up with.";
                } else{
                    $project_name = trim($_POST["project_name"]);
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

	//Validate project_id
    if(empty(trim($_POST["project_id"]))){
        $project_id_err = "Please enter your vehicle's project_id Number.";
    } else{
        $project_id = trim($_POST["project_id"]);

    }
//Validate developer_name
    if(empty(trim($_POST["developer_name"]))){
        $developer_name_err = "Please enter a free developer_name.";

    } else{
        $developer_name = trim($_POST["developer_name"]);


    }

    //Validate contractor
        if(empty(trim($_POST["contractor_reg"]))){
            $contractor_reg_err = "Please enter the contractor's name.";

        } else{
            $contractor_reg = trim($_POST["contractor_reg"]);


        }
        //Validate date
            if(empty(trim($_POST["start_date"]))){
                $start_date_err = "Please enter the commencement date.";

            } else{
                $start_date = trim($_POST["start_date"]);


            }
            //Validate email
                if(empty(trim($_POST["email"]))){
                    $email_err = "Please enter your email.";

                } else{
                    $email = trim($_POST["email"]);

                }

                //Validate comment
                $comment = trim($_POST["comment"]);

                //Validate project_type
                    if(empty(trim($_POST["project_type"]))){
                        $project_type_err = "Please choose a project_type.";

                    } else{
                        $project_type = trim($_POST["project_type"]);

                    }


    // Check input errors before inserting in database
    if(empty($project_name_err) && empty($project_id_err) && empty($developer_name_err)  && empty($contractor_reg_err)  && empty($start_date_err)
        && empty($phone_err) && empty($email_err) && empty($comment_err) && empty($project_type_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO tblprojects (project_name, phone, project_id, developer_name, contractor_reg, start_date, email, comment, project_type )
         VALUES (:project_name, :phone, :project_id, :developer_name, :contractor_reg, :start_date, :email, :comment, :project_type)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters


              $stmt->bindParam(":project_name", $param_project_name, PDO::PARAM_STR);
              $stmt->bindParam(":project_id", $param_project_id, PDO::PARAM_STR);
              $stmt->bindParam(":developer_name", $param_developer_name, PDO::PARAM_STR);
              $stmt->bindParam(":contractor_reg", $param_contractor_reg, PDO::PARAM_STR);
              $stmt->bindParam(":start_date", $param_start_date, PDO::PARAM_STR);
              $stmt->bindParam(":phone", $param_phone, PDO::PARAM_STR);
              $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
              $stmt->bindParam(":comment", $param_comment, PDO::PARAM_STR);
              $stmt->bindParam(":project_type", $param_project_type, PDO::PARAM_STR);
            // Set parameters
            $param_project_name = trim($_POST["project_name"]);
            $param_project_id = trim($_POST["project_id"]);
            $param_developer_name = trim($_POST["developer_name"]);
            $param_contractor_reg = trim($_POST["contractor_reg"]);
            $param_start_date = trim($_POST["start_date"]);
            $param_phone = trim($_POST["phone"]);
            $param_email = trim($_POST["email"]);
            $param_comment = trim($_POST["comment"]);
            $param_project_type = trim($_POST["project_type"]);


            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Stay on this page
                header("location: tblprojects2.php");

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

                                            <a class="nav-link" href="tblprojects2.php">Enter Project Details</a>

                                        </nav>
                                    </div>

                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Huduma services
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Reports
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <!-- side menu -->
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Account
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="tblcontractorr2.php">Contractor details</a>
                                            <a class="nav-link" href="tblprojects2.php">Projects</a>
                                            <a class="nav-link" href="tblmafundi2.php">Accreditation</a>
                                            <a class="nav-link" href="tblenquiries2.php">General Enquiries</a>
                                            <!-- <a class="nav-link" href="reports.html">Reports</a> -->
					</nav>
				     </div>
				</nav>
			      </div>
                            <!-- side menu -->
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
                        <h1 class="mt-4">Enter Project Details</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" target="votar">

  <!--  <div class=" row mb-3">

      <div class="mb-3">
        <label for="inputcontractorname" class="form-label">Contractor Name</label>
        <input type="text" class="form-control" id="inputcontractorname" aria-describedby="emailHelp">
      </div>
      <div class="col-md-3">
          <div class="form-floating mb-3 mb-md-0">
            <label for="inputbw" class="form-label">Class</label>
          </div >
      </div>

      <div class="col-md-3">
          <div class="form-floating">
            <label for="inputbw" class="form-label">Registration No.</label>
          </div>
      </div>

      <div class="col-md-3">
          <div class="form-floating">
            <label for="inputbw" class="form-label">Category</label>
          </div>
      </div>

      <div class="col-md-3">
          <div class="form-floating">
            <label for="inputbw" class="form-label">Expiry Date</label>
          </div>
      </div>
  </div></br></br> -->

<div class=" row mb-3">
  <div class="mb-3" <?php echo (!empty($project_name_err)) ? 'has-error' : ''; ?>">
    <label for="projectname" class="form-label">Project Name *</label>
    <input type="text" minlength="5" class="form-control" name="project_name" id="projectname" aria-describedby="emailHelp" value="<?php echo $project_name; ?>" required>
    <span class="help-block"><?php echo $project_name_err; ?></span>
  </div>
  <!--- -->

  <!--- -->
  <div class="col-md-3">
    <!-- <h6>Class</h6> -->
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($developer_name_err)) ? 'has-error' : ''; ?>">
        <input type="text" minlength="5" class="form-control" name="developer_name" id="bw" aria-describedby="emailHelp" value="<?php echo $developer_name; ?>" required>
        <label for="developername" class="form-label">Enter Developer Name *</label>
        <span class="help-block"><?php echo $developer_name_err; ?></span>
      </div>

  </div>

  <div class="col-md-3">
    <!-- <h6>Registration. No</h6> -->
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($project_id_err)) ? 'has-error' : ''; ?>>
        <input type="text" minlength="5" class="form-control" name="project_id" id="projectid" aria-describedby="emailHelp" value="<?php echo $project_id; ?>" required>
        <label for="projectid" class="form-label">Enter Project ID *</label>
        <span class="help-block"><?php echo $project_id_err; ?></span>
      </div>
  </div>

  <div class="col-md-3">
    <!-- <h6>Registration. No</h6> -->
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($contractor_reg_err)) ? 'has-error' : ''; ?>>
        <input type="text" minlength="5" class="form-control" name="contractor_reg" id="contractor" aria-describedby="emailHelp" value="<?php echo $contractor_reg; ?>" required>
        <label for="contractor" class="form-label" >Contractor Name *</label>
        <span class="help-block"><?php echo $contractor_reg_err; ?></span>
      </div>
  </div>

  <div class="col-md-3">
  <!-- <h6>Commencement Date</h6> -->
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($start_date_err)) ? 'has-error' : ''; ?>>
        <input type="date" class="form-control" id="dateMes" name="start_date"value="<?php echo $start_date; ?>" required>
		<label for="commencedate" class="form-label" >Commencement date *</label>
    <span class="help-block"><?php echo $start_date_err; ?></span>
      </div>
  </div>
</div>
  <div class="mb-3">
    <!-- <label for="contacts" class="form-label">Contacts and comments</label> -->
  </div>
  <div class=" row mb-3">
  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>>
        <input type="number" maxlength="10" class="form-control" name="phone" id="phone" aria-describedby="emailHelp" value="<?php echo $phone; ?>" required>
        <label for="phone" class="form-label" >phone Number *</label>
        <span class="help-block"><?php echo $phone_err; ?></span>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0"  <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>>
        <input type="email" minlength="10" class="form-control" name="email" id="email" aria-describedby="emailHelp" value="<?php echo $email; ?>" required>
        <label for="email" class="form-label">Email Address *</label>
        <span class="help-block"><?php echo $email_err; ?></span>
      </div>
  </div>
  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($comment_err)) ? 'has-error' : ''; ?>>
        <input type="text" minlength="2" class="form-control" name="comment" id="comments" aria-describedby="emailHelp" value="<?php echo $comment; ?>" required>
        <label for="comments" class="form-label">Comments *</label>
          <span class="help-block"><?php echo $comment_err; ?></span>
      </div>
  </div>
  <div class="col-md-3">
   <!-- <h6>Category</h6> select-->
      <div class="form-floating mb-3 mb-md-0"  <?php echo (!empty($project_type_err)) ? 'has-error' : ''; ?>>
        <select name="project_type" id="status" value="<?php echo $project_type; ?>" required>
                <option value="0">Select Project Type...</option>
                <option value="Commercial">Commercial</option>
                <option value="Residential">Residential</option>
                <option value="Complete">Complete</option>
          </select>
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
