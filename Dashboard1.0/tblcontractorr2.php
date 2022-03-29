<?php
// Include config file
require_once "Config.php";

// Define variables and initialize with empty values
$contractor_name = $bw_reg = $rw_reg = $ww_reg = $ees_reg = $mes_reg = $bw_category = $rw_category = $ww_category = $ees_category = $mes_category =
$bw_date = $rw_date = $ww_date = $ees_date = $mes_date = $phone = $email = $comments = $status = "";
$contractor_name_err = $bw_reg_err = $rw_reg_err = $ww_reg_err = $ees_reg_err = $mes_reg_err = $bw_category_err = $rw_category_err = $ww_category_err =
$ees_category_err = $mes_category_err = $bw_date_err = $rw_date_err = $ww_date_err = $ees_date_err = $mes_date_err = $phone_err = $email_err = $comments_err = $status_err = "";




// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate contractor_name
    if(empty(trim($_POST["contractor_name"]))){
        $contractor_name_err = "Please enter your contractor's name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT phone FROM tblcontractor WHERE contractor_name = :contractor_name";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":contractor_name", $param_uname, PDO::PARAM_STR);

            // Set parameters
            $param_contractor_name = trim($_POST["contractor_name"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $contractor_name_err = "Please enter the name of the contractor.";
                } else{
                    $contractor_name = trim($_POST["contractor_name"]);
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


//Validate bw_reg
    if(empty(trim($_POST["bw_reg"]))){
        $bw_reg_err = "Please enter the registration number.";

    } else{
        $bw_reg = trim($_POST["bw_reg"]);


    }
    //Validate rw_reg
        if(empty(trim($_POST["rw_reg"]))){
            $rw_reg_err = "Please enter the registration number.";

        } else{
            $rw_reg = trim($_POST["bw_reg"]);


        }
        //Validate ww_reg
            if(empty(trim($_POST["ww_reg"]))){
                $ww_reg_err = "Please enter the registration number.";

            } else{
                $ww_reg = trim($_POST["ww_reg"]);


            }
            //Validate ees_reg
                if(empty(trim($_POST["ees_reg"]))){
                    $ees_reg_err = "Please enter the registration number.";

                } else{
                    $ees_reg = trim($_POST["ees_reg"]);


                }
                //Validate mes_reg
                    if(empty(trim($_POST["mes_reg"]))){
                        $mes_reg_err = "Please enter the registration number.";

                    } else{
                        $mes_reg = trim($_POST["mes_reg"]);


                    }




    //Validate category
        if(empty(trim($_POST["bw_category"]))){
            $bw_category_err = "Please enter the bw_category.";

        } else{
            $bw_category = trim($_POST["bw_category"]);


        }
        //Validate category
            if(empty(trim($_POST["rw_category"]))){
                $rw_category_err = "Please enter the category.";

            } else{
                $rw_category = trim($_POST["rw_category"]);


            }
            //Validate category
                if(empty(trim($_POST["ww_category"]))){
                    $ww_category_err = "Please enter the category.";

                } else{
                    $ww_category = trim($_POST["ww_category"]);


                }
                //Validate category
                    if(empty(trim($_POST["ees_category"]))){
                        $ees_category_err = "Please enter the category.";

                    } else{
                        $ees_category = trim($_POST["ees_category"]);


                    }
                    //Validate category
                        if(empty(trim($_POST["mes_category"]))){
                            $mes_category_err = "Please enter the category.";

                        } else{
                            $mes_category = trim($_POST["mes_category"]);


                        }
        //Validate date
            if(empty(trim($_POST["bw_date"]))){
                $bw_date_err = "Please enter the expiry date.";

            } else{
                $bw_date = trim($_POST["bw_date"]);


            }
            //Validate date
                if(empty(trim($_POST["rw_date"]))){
                    $rw_date_err = "Please enter the expiry date.";

                } else{
                    $rw_date = trim($_POST["rw_date"]);


                }
                //Validate date
                    if(empty(trim($_POST["ww_date"]))){
                        $ww_date_err = "Please enter the expiry date.";

                    } else{
                        $ww_date = trim($_POST["ww_date"]);


                    }
                    //Validate date
                        if(empty(trim($_POST["ees_date"]))){
                            $ees_date_err = "Please enter the expiry date.";

                        } else{
                            $ees_date = trim($_POST["ees_date"]);


                        }
                        //Validate date
                            if(empty(trim($_POST["mes_date"]))){
                                $mes_date_err = "Please enter the expiry date.";

                            } else{
                                $mes_date = trim($_POST["mes_date"]);


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

                //Validate status
                    if(empty(trim($_POST["status"]))){
                        $status_err = "Please slect the status.";

                    } else{
                        $status = trim($_POST["status"]);

                    }


    // Check input errors before inserting in database
    if(empty($contractor_name_err) && empty($phone_err) && empty($email_err) && empty($comments_err) && empty($status_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO tblcontractor (contractor_name, phone, bw_reg,  rw_reg,  ww_reg,  ees_reg,  mes_reg, bw_category, rw_category, ww_category,
          ees_category, mes_category, bw_date, rw_date, ww_date, ees_date, mes_date, email, comments, status )
         VALUES (:contractor_name, :phone, :bw_reg,  :rw_reg,  :ww_reg,  :ees_reg,  :mes_reg, :bw_category, :rw_category, :ww_category, :ees_category,
           :mes_category, :bw_date, :rw_date, :ww_date, :ees_date, :mes_date, :email, :comments, :status)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters


              $stmt->bindParam(":contractor_name", $param_contractor_name, PDO::PARAM_STR);
              $stmt->bindParam(":bw_reg", $param_bw_reg, PDO::PARAM_STR);
              $stmt->bindParam(":rw_reg", $param_rw_reg, PDO::PARAM_STR);
              $stmt->bindParam(":ww_reg", $param_ww_reg, PDO::PARAM_STR);
              $stmt->bindParam(":ees_reg", $param_ees_reg, PDO::PARAM_STR);
              $stmt->bindParam(":mes_reg", $param_mes_reg, PDO::PARAM_STR);

              $stmt->bindParam(":bw_category", $param_bw_category, PDO::PARAM_STR);
              $stmt->bindParam(":rw_category", $param_rw_category, PDO::PARAM_STR);
              $stmt->bindParam(":ww_category", $param_ww_category, PDO::PARAM_STR);
              $stmt->bindParam(":ees_category", $param_ees_category, PDO::PARAM_STR);
              $stmt->bindParam(":mes_category", $param_mes_category, PDO::PARAM_STR);


              $stmt->bindParam(":bw_date", $param_bw_date, PDO::PARAM_STR);
              $stmt->bindParam(":rw_date", $param_rw_date, PDO::PARAM_STR);
              $stmt->bindParam(":ww_date", $param_ww_date, PDO::PARAM_STR);
              $stmt->bindParam(":ees_date", $param_ees_date, PDO::PARAM_STR);
              $stmt->bindParam(":mes_date", $param_mes_date, PDO::PARAM_STR);

              $stmt->bindParam(":phone", $param_phone, PDO::PARAM_STR);
              $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
              $stmt->bindParam(":comments", $param_comments, PDO::PARAM_STR);
              $stmt->bindParam(":status", $param_status, PDO::PARAM_STR);
            // Set parameters
            $param_contractor_name = trim($_POST["contractor_name"]);
            $param_bw_reg = trim($_POST["bw_reg"]);
            $param_rw_reg = trim($_POST["rw_reg"]);
            $param_ww_reg = trim($_POST["ww_reg"]);
            $param_ees_reg = trim($_POST["ees_reg"]);
            $param_mes_reg = trim($_POST["mes_reg"]);

            $param_bw_category = trim($_POST["bw_category"]);
            $param_rw_category = trim($_POST["rw_category"]);
            $param_ww_category = trim($_POST["ww_category"]);
            $param_ees_category = trim($_POST["ees_category"]);
            $param_mes_category = trim($_POST["mes_category"]);

            $param_bw_date = trim($_POST["bw_date"]);
            $param_rw_date = trim($_POST["rw_date"]);
            $param_ww_date = trim($_POST["ww_date"]);
            $param_ees_date = trim($_POST["ees_date"]);
            $param_mes_date = trim($_POST["mes_date"]);

            $param_phone = trim($_POST["phone"]);
            $param_email = trim($_POST["email"]);
            $param_comments = trim($_POST["comments"]);
            $param_status = trim($_POST["status"]);


            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Stay on this page
                header("location: tblcontractorr2.php");

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

                                            <a class="nav-link" href="tblcontractorr2.php">Enter Contractor Details</a>

                                        </nav>
                                    </div>

                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Huduma services
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                    <!-- side menu -->
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
                        <h1 class="mt-4">Contractors</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">


  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" target="votar">


<div class=" row mb-3">
  <div class="mb-3" <?php echo (!empty($contractor_name_err)) ? 'has-error' : ''; ?>>
    <label for="contractorName" class="form-label">Contractor Name*</label>
    <input type="text" name="contractor_name" class="form-control" id="contractorName" aria-describedby="emailHelp" value="<?php echo $contractor_name; ?>" required>
    <span class="help-block"><?php echo $contractor_name_err; ?></span>

  </div>
  <div class="col-md-3">
    <h6>Class</h6>
      <div class="form-floating mb-3 mb-md-0">
    <!--    <input type="text" class="form-control" id="bw" aria-describedby="emailHelp"> -->
        <label for="bw" class="form-label">Building works :</label>
      </div>
  </div>

  <div class="col-md-3">
    <h6>Registration. No*</h6>
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($bw_reg_err)) ? 'has-error' : ''; ?> >
        <input type="text" name="bw_reg" class="form-control" id="regNoBw" aria-describedby="emailHelp" value="<?php echo $bw_reg; ?>">
        <label for="regNoBw" class="form-label">Enter Reg.No</label>
        <span class="help-block"><?php echo $bw_reg_err; ?></span>

      </div>
  </div>

  <div class="col-md-3">
    <h6>bw_category</h6>
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($bw_category_err)) ? 'has-error' : ''; ?>>
        <select name="bw_category" id="bw_categoryBw" value="<?php echo $bw_category; ?>">
                <option value=" ">Category</option>
                <option value="NCA1">NCA1</option>
                <option value="NCA2">NCA2</option>
                <option value="NCA3">NCA3</option>
                <option value="NCA4">NCA4</option>
                <option value="NCA5">NCA5</option>
                <option value="NCA6">NCA6</option>
                <option value="NCA7">NCA7</option>
                <option value="NCA8">NCA8</option>
          </select>
      </div>
  </div>

  <div class="col-md-3">
    <h6>Expiry Date</h6>
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($bw_date_err)) ? 'has-error' : ''; ?>>
        <input type="date" name="bw_date" class="form-control" id="dateBw" value="<?php echo $bw_date; ?>">
        <span class="help-block"><?php echo $bw_date_err; ?></span>

      </div>
  </div>
</div>

<div class=" row mb-3">
  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0">
      <!--  <input type="text" class="form-control" id="rw" aria-describedby="emailHelp"> -->
        <label for="rw" class="form-label">Road works :</label>
      </div>
  </div>

  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($rw_reg_err)) ? 'has-error' : ''; ?>>
        <input type="text" name="rw_reg" class="form-control" id="regNoRw" aria-describedby="emailHelp" value="<?php echo $rw_reg; ?>">
        <label for="regNoRw" class="form-label">Enter Reg.No</label>
        <span class="help-block"><?php echo $rw_reg_err; ?></span>

      </div>
  </div>

  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($rw_category_err)) ? 'has-error' : ''; ?>>
        <select name="rw_category" id="bw_categoryRw" value="<?php echo $rw_category; ?>">
                <option value=" ">Category</option>
                <option value="NCA1">NCA1</option>
                <option value="NCA2">NCA2</option>
                <option value="NCA3">NCA3</option>
                <option value="NCA4">NCA4</option>
                <option value="NCA5">NCA5</option>
                <option value="NCA6">NCA6</option>
                <option value="NCA7">NCA7</option>
                <option value="NCA8">NCA8</option>
          </select>
      </div>
  </div>

  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($rw_date_err)) ? 'has-error' : ''; ?>>
        <input type="date" name="rw_date" class="form-control" id="dateRw" value="<?php echo $rw_date; ?>">
        <span class="help-block"><?php echo $rw_date_err; ?></span>

      </div>
  </div>
</div>

<div class=" row mb-3">
  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0">
      <!--  <input type="text" class="form-control" id="ww" aria-describedby="emailHelp"> -->
        <label for="ww" class="form-label">Water works :</label>
      </div>
  </div>

  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($ww_reg_err)) ? 'has-error' : ''; ?>>
        <input type="text" name="ww_reg" class="form-control" id="regNoww" aria-describedby="emailHelp" value="<?php echo $ww_reg; ?>">
        <label for="regNoww" class="form-label">Enter Reg.No</label>
        <span class="help-block"><?php echo $ww_reg_err; ?></span>

      </div>
  </div>

  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($ww_category_err)) ? 'has-error' : ''; ?>>
        <select name="ww_category" id="bw_categoryww" value="<?php echo $ww_category; ?>">
                <option value=" ">Category</option>
                <option value="NCA1">NCA1</option>
                <option value="NCA2">NCA2</option>
                <option value="NCA3">NCA3</option>
                <option value="NCA4">NCA4</option>
                <option value="NCA5">NCA5</option>
                <option value="NCA6">NCA6</option>
                <option value="NCA7">NCA7</option>
                <option value="NCA8">NCA8</option>
          </select>
      </div>
  </div>

  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($ww_date_err)) ? 'has-error' : ''; ?>>
        <input type="date" name="ww_date" class="form-control" id="dateww" value="<?php echo $ww_date; ?>">
        <span class="help-block"><?php echo $ww_date_err; ?></span>

      </div>
  </div>
</div>

<div class=" row mb-3">
  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0">
      <!--  <input type="text" class="form-control" id="ees" aria-describedby="emailHelp"> -->
        <label for="ees" class="form-label">Electrical Engineering Services :</label>
      </div>
  </div>

  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($ees_reg_err)) ? 'has-error' : ''; ?>>
        <input type="text" name="ees_reg" class="form-control" id="regNoEes" aria-describedby="emailHelp" value="<?php echo $ees_reg; ?>">
        <label for="regNoEes" class="form-label">Enter Reg.No</label>
        <span class="help-block"><?php echo $ees_reg_err; ?></span>

      </div>
  </div>

  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($ees_category_err)) ? 'has-error' : ''; ?>>
        <select name="ees_category" id="ees_category" value="<?php echo $ees_category; ?>">
                <option value=" ">Category</option>
                <option value="NCA1">NCA1</option>
                <option value="NCA2">NCA2</option>
                <option value="NCA3">NCA3</option>
                <option value="NCA4">NCA4</option>
                <option value="NCA5">NCA5</option>
                <option value="NCA6">NCA6</option>
                <option value="NCA7">NCA7</option>
                <option value="NCA8">NCA8</option>
          </select>
      </div>
  </div>

  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($ees_date_err)) ? 'has-error' : ''; ?>>
        <input type="date" name="ees_date" class="form-control" id="dateEes" value="<?php echo $ees_date; ?>">
        <span class="help-block"><?php echo $ees_date_err; ?></span>

      </div>
  </div>
</div>

<div class=" row mb-3">
  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0">
      <!--  <input type="text" class="form-control" id="mes" aria-describedby="emailHelp"> -->
        <label for="mes" class="form-label">Mechanical Engineering Services :</label>
      </div>
  </div>

  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($mes_reg_err)) ? 'has-error' : ''; ?>>
        <input type="text" name="mes_reg" class="form-control" id="inputcontractorname" aria-describedby="emailHelp" value="<?php echo $mes_reg; ?>">
        <label for="regNoMes" class="form-label">Input Reg.No</label>
        <span class="help-block"><?php echo $mes_reg_err; ?></span>

      </div>
  </div>

  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($mes_category_err)) ? 'has-error' : ''; ?>>
        <select name="mes_category" id="bw_categoryMes" value="<?php echo $mes_category; ?>">
                <option value=" ">Category</option>
                <option value="NCA1">NCA1</option>
                <option value="NCA2">NCA2</option>
                <option value="NCA3">NCA3</option>
                <option value="NCA4">NCA4</option>
                <option value="NCA5">NCA5</option>
                <option value="NCA6">NCA6</option>
                <option value="NCA7">NCA7</option>
                <option value="NCA8">NCA8</option>
          </select>
      </div>
  </div>

  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0"  <?php echo (!empty($mes_date_err)) ? 'has-error' : ''; ?>>
        <input type="date" name="mes_date" class="form-control" id="dateMes" value="<?php echo $mes_date; ?>">
        <span class="help-block"><?php echo $mes_date_err; ?></span>

      </div>
  </div>
</div>
<div class="mb-3">
</br>  <label for="contacts" class="form-label">Contacts and comments</label>
  </div>
  <div class=" row mb-3">
  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>>
        <input type="text" name="phone" class="form-control" id="phone" aria-describedby="emailHelp" value="<?php echo $phone; ?>" required>
        <label for="phone" class="form-label">Phone Number*</label>
        <span class="help-block"><?php echo $phone_err; ?></span>

      </div>
  </div>
  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?php echo $email; ?>">
        <label for="email" class="form-label">Email Address</label>
        <span class="help-block"><?php echo $email_err; ?></span>

      </div>
  </div>
  <div class="col-md-3">
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($comments_err)) ? 'has-error' : ''; ?>>
        <input type="text" name="comments" class="form-control" id="comments" aria-describedby="emailHelp" value="<?php echo $comments; ?>" required>
        <label for="comments" class="form-label">Comments*</label>
        <span class="help-block"><?php echo $comments_err; ?></span>

      </div>
      <div class="col-md-3">
   <!-- <h6>bw_category</h6> select-->
      <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($status_err)) ? 'has-error' : ''; ?>>
        <select name="status" id="status" value="<?php echo $status; ?>">
                <option value="0">Select Status...</option>
                <option value="Processing">Processing</option>
                <option value="Payment">Payment</option>
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
