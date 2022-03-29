<?php
// Include config file
require_once "Config.php";

// Define variables and initialize with empty values
$enquiry = $enquiry_type = $enquiry_trackno = $application_date  = $phone = $email = $comments = "";
$enquiry_err = $enquiry_type_err = $enquiry_trackno_err = $application_date_err = $phone_err = $email_err = $comments_err = "";



// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate enquiries
    if(empty(trim($_POST["enquiry"]))){
        $enquiry_err = "Please enter your first name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT enquiry_trackno FROM tblenquiries WHERE enquiry = :enquiry";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":enquiry", $param_uname, PDO::PARAM_STR);

            // Set parameters
            $param_enquiry = trim($_POST["enquiry"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $enquiry_err = "Please enter your enquiry.";
                } else{
                    $enquiry = trim($_POST["enquiry"]);
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

	//Validate enquiry_type
    if(empty(trim($_POST["enquiry_type"]))){
        $enquiry_type_err = "Please select the type of enquiry.";
    } else{
        $enquiry_type = trim($_POST["enquiry_type"]);

    }
//Validate enquiry_trackno
    if(empty(trim($_POST["enquiry_trackno"]))){
        $enquiry_trackno_err = "Please enter the tracking number.";

    } else{
        $enquiry_trackno = trim($_POST["enquiry_trackno"]);


    }

    //Validate contractor
        if(empty(trim($_POST["application_date"]))){
            $application_date_err = "Please enter the application_date.";

        } else{
            $application_date = trim($_POST["application_date"]);


        }

            //Validate email
                if(empty(trim($_POST["email"]))){
                    $email_err = "Please enter your email.";

                } else{
                    $email = trim($_POST["email"]);

                }

                //Validate comments
                if(empty(trim($_POST["comments"]))){
                    $comments_err = "Please comment.";

                } else{
                    $comments = trim($_POST["comments"]);

                }




    // Check input errors before inserting in database
    if(empty($enquiry_err) && empty($enquiry_type_err) && empty($enquiry_trackno_err)  && empty($application_date_err)
        && empty($phone_err) && empty($email_err) && empty($comments_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO tblenquiries (enquiry, phone, enquiry_type, enquiry_trackno, application_date, email, comments)
         VALUES (:enquiry, :phone, :enquiry_type, :enquiry_trackno, :application_date, :email, :comments)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters


              $stmt->bindParam(":enquiry", $param_enquiry, PDO::PARAM_STR);
              $stmt->bindParam(":enquiry_type", $param_enquiry_type, PDO::PARAM_STR);
              $stmt->bindParam(":enquiry_trackno", $param_enquiry_trackno, PDO::PARAM_STR);
              $stmt->bindParam(":application_date", $param_application_date, PDO::PARAM_STR);
              $stmt->bindParam(":phone", $param_phone, PDO::PARAM_STR);
              $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
              $stmt->bindParam(":comments", $param_comments, PDO::PARAM_STR);
            // Set parameters
            $param_enquiry = trim($_POST["enquiry"]);
            $param_enquiry_type = trim($_POST["enquiry_type"]);
            $param_enquiry_trackno = trim($_POST["enquiry_trackno"]);
            $param_application_date = trim($_POST["application_date"]);
            $param_phone = trim($_POST["phone"]);
            $param_email = trim($_POST["email"]);
            $param_comments = trim($_POST["comments"]);


            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Stay on this page
              header("location: tblenquiries2.php");

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
        <title>Dashboard - NCA User</title>
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

                                            <a class="nav-link" href="tblenquiries2.php">General enquiries</a>

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
                                        Services
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">

                                            <a class="nav-link" href="tblcontractorr2.php">Contractor details</a>
                                            <a class="nav-link" href="tblprojects2.php">Projects</a>
                                            <a class="nav-link" href="tblmafundi2.php">Accreditation</a>
                                            <a class="nav-link" href="tblenquiries2.php">General enquiries</a>
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
                        <h1 class="mt-4">General enquiries</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" target="votar">

    <div class=" row mb-3">
      <div class="col-md-6">
          <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($enquiry_err)) ? 'has-error' : ''; ?>>
            <input type="text" class="form-control" name="enquiry" id="generalEnquiry" placeholder="Enquiry" value="<?php echo $enquiry; ?>">
            <label for="generalenquries" class="required">enquiry</label>
            <span class="help-block"><?php echo $enquiry_err; ?></span>

        </div >
      </div>
      <div class="col-md-6">
          <div class="form-floating" <?php echo (!empty($enquiry_type_err)) ? 'has-error' : ''; ?>>
            <select name="enquiry_type" id="status" required="" value="<?php echo $enquiry_type; ?>">
                     <option value="0">Select category Type...</option>
                     <option value="Project">Project</option>
                     <option value="Contractor">Contractor</option>
                     <option value="Training">Training</option>
                     <option value="Supervisor">Site Supervisor</option>
                     <option value="Mafundi">Skilled Workers</option>
                     <option value="Others">Others</option>
          </select>
          </div>
      </div>
  </div>
<div class=" row mb-3">
  <div class="col-md-6">
    <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($enquiry_trackno_err)) ? 'has-error' : ''; ?>>
        <input type="text" class="form-control" name="enquiry_trackno" id="trackinno" aria-describedby="emailHelp" value="<?php echo $enquiry_trackno; ?>" placeholder="geComments"/>
        <label for="generalenquriesC" class="required">Tracking No. </label>
        <span class="help-block"><?php echo $enquiry_trackno_err; ?></span>

    </div>
  </div>
  <div class="col-md-6">
    <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>>
        <input type="text" name="phone" class="form-control" id="phonenum" aria-describedby="emailHelp" value="<?php echo $phone; ?>" placeholder="geComments"/>
        <label for="generalenquriesC" class="required">Phone Number</label>
        <span class="help-block"><?php echo $phone_err; ?></span>

    </div>
  </div>
</div>
<div class=" row mb-3">
    <div class="col-md-6">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>>
          <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?php echo $email; ?>" placeholder="geComments"/>
          <label for="generalenquriesC" class="required">Email </label>
          <span class="help-block"><?php echo $email_err; ?></span>

      </div>
    </div>
    <div class="col-md-6">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($comments_err)) ? 'has-error' : ''; ?>>
          <input type="text" name="comments" class="form-control" id="comments" aria-describedby="emailHelp" value="<?php echo $comments; ?>" placeholder="geComments"/>
          <label for="generalenquriesC" class="required">Comments*</label>
          <span class="help-block"><?php echo $comments_err; ?></span>

      </div>
    </div>
    <div class="col-md-3">
        <h6>Application Date</h6>
          <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($application_date_err)) ? 'has-error' : ''; ?>>
            <input type="date" name="application_date" class="form-control" id="application_date" value="<?php echo $application_date; ?>" required>
            <span class="help-block"><?php echo $application_date_err; ?></span>

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
