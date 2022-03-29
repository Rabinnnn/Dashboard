<?php
// Include config file
require_once "Config.php";

// Define variables and initialize with empty values
$first_name = $region = $last_name = $payroll_no = $password = $confirm_password = $email =  "";
$first_name_err = $region_err = $last_name_err = $payroll_no_err = $password_err = $confirm_password_err = $email_err =  "";



// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate first_name
    if(empty(trim($_POST["first_name"]))){
        $first_name_err = "Please enter your first name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT last_name FROM tbluser WHERE first_name = :first_name";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":first_name", $param_uname, PDO::PARAM_STR);

            // Set parameters
            $param_first_name = trim($_POST["first_name"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $first_name_err = "Please enter your first name.";
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




    // Validate password number
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } elseif(strlen(trim($_POST["password"]))==!8){
        $password_err = "password must be at least 8 characters long.";
    } else{
        $password = trim($_POST["password"]);
    }

	//Validate region
    if(empty(trim($_POST["region"]))){
        $region_err = "Please select a region.";
    } else{
        $region = trim($_POST["region"]);

    }
//Validate last_name
    if(empty(trim($_POST["last_name"]))){
        $last_name_err = "Please enter your last name.";

    } else{
        $last_name = trim($_POST["last_name"]);


    }

        //Validate payroll_no
            if(empty(trim($_POST["payroll_no"]))){
                $payroll_no_err = "Please enter your payroll number.";

            } else{
                $payroll_no = trim($_POST["payroll_no"]);


            }
            //Validate email
                if(empty(trim($_POST["email"]))){
                    $email_err = "Please enter your email.";

                } else{
                    $email = trim($_POST["email"]);


                }

                //Validate confirm_password
              if(empty(trim($_POST["confirm_password"]))){
                    $confirm_password_err = "Please confirm password.";

                } elseif(!empty($password) && !empty($confirm_password) && ($confirm_password !== $password)){
                    $confirm_password_err = "The password does not match the first one.";
                } else{

                    $confirm_password = trim($_POST["confirm_password"]);

                }




            /*    //Validate confirm_password
                    if(empty(trim($_POST["confirm_password"]))){
                        $confirm_password_err = "The password doesn't match the first one.";

                    } else{
                        $confirm_password = trim($_POST["confirm_password"]);


                    }*/





    // Check input errors before inserting in database
    if(empty($first_name_err) && empty($region_err) && empty($last_name_err) && empty($email_err) && empty($payroll_no_err)
        && empty($password_err) && empty($confirm_password_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO tbluser (first_name, password, region, last_name, payroll_no, email, confirm_password)
         VALUES (:first_name, :password, :region, :last_name, :payroll_no, :email, :confirm_password)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters


              $stmt->bindParam(":first_name", $param_first_name, PDO::PARAM_STR);
              $stmt->bindParam(":region", $param_region, PDO::PARAM_STR);
              $stmt->bindParam(":last_name", $param_last_name, PDO::PARAM_STR);
              $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
              $stmt->bindParam(":payroll_no", $param_payroll_no, PDO::PARAM_STR);
              $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
              $stmt->bindParam(":confirm_password", $param_confirm_password, PDO::PARAM_STR);


            // Set parameters
            $param_first_name = trim($_POST["first_name"]);
            $param_region = trim($_POST["region"]);
            $param_last_name = trim($_POST["last_name"]);
            $param_payroll_no = trim($_POST["payroll_no"]);
            $param_email = trim($_POST["email"]);
          //  $param_password = trim($_POST["password"]);
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            //$param_confirm_password = trim($_POST["confirm_password"]);
            $param_confirm_password = password_hash($confirm_password, PASSWORD_DEFAULT); // Creates a password hash




            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Stay on this page
              header("location: tbluser2.php");

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
        <title>Register - NCA user</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" target="votar">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>>
                                                        <input class="form-control" name="first_name" id="userFirstName" type="text" value="<?php echo $first_name; ?>" placeholder="Enter your first name" />
                                                        <label for="userFirstName" class="required">First name</label>
                                                        <span class="help-block"><?php echo $first_name_err; ?></span>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating" <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>>
                                                        <input class="form-control" name="last_name" id="userLastName" type="text" value="<?php echo $last_name; ?>" placeholder="Enter your last name" />
                                                        <label for="userLastName" class="required">Last name</label>
                                                        <span class="help-block"><?php echo $last_name_err; ?></span>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3" <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>>
                                                <input class="form-control" name="email" id="userEmail" type="email" value="<?php echo $email; ?>" placeholder="name@example.com" />
                                                <label for="userEmail" class="required">Email address</label>
                                                <span class="help-block"><?php echo $email_err; ?></span>

                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($payroll_no_err)) ? 'has-error' : ''; ?>>
                                                        <input class="form-control" name="payroll_no" id="employeePayrollNo" type="text" value="<?php echo $payroll_no; ?>" placeholder="Enter your Payroll number" />
                                                        <label for="employeePayrollNo" class="required">Employee Payroll.No</label>
                                                        <span class="help-block"><?php echo $payroll_no_err; ?></span>

                                                    </div>
                                                </div>
                                                <div class="col-md-6" <?php echo (!empty($region_err)) ? 'has-error' : ''; ?>>
                                                  <label for="hudumaCenter" >Huduma Center</label>

                                                    <div class="form-floating">

                                                      <select name="region" id="hudumaCenter" value="<?php echo $region; ?>">
                                                        <option value=" ">Select Center...</option>
                                                        <option value="G.P.O">G.P.O</option>
                                                        <option value="CITY SQUARE">CITY SQUARE</option>
                                                        <option value="MAKANDARA">MAKANDARA</option>
                                                        <option value="KITUI">KITUI</option>
                                                        <option value="MURANGA">MURANGA</option>
                                                        <option value="MACHAKO">MACHAKOS</option>
                                                        <option value="EMBU">EMBU</option>
                                                        <option value="MAKUENI">MAKUENI</option>
                                                        <option value="KIAMBU">KIAMBU</option>
                                                        <option value="KAJIADO WEST">KAJIADO WEST</option>
                                                        <option value="KAJIADO EAST">KAJIADO EAST</option>
                                                        <option value="NYERI">NYERI</option>
                                                        <option value="NYANDARUA">NYANDARUA</option>
                                                        <option value="EASTLEIGH">EASTLEIGH</option>
                                                        <option value="KIRINYAGA">KIRINYAGA</option>
                                                        <option value="KIBRA">KIBRA</option>
                                                        <option value="EMBU">EMBU</option>
                                                        <option value="BUNGOMA">BUNGOMA</option>
                                                        <option value="MANDERA">MANDERA</option>
                                                        <option value="KAKAMEGA">KAKAMEGA</option>
                                                        <option value="TURKANA">TURKANA</option>
                                                        <option value="VIHIGA">VIHIGA</option>
                                                        <option value="WEST POKOT">WEST POKOT</option>
                                                        <option value="BUSIA">BUSIA</option>
                                                        <option value="TRANS NZOIA">TRANS NZOIA</option>
                                                        <option value="MERU">MERU</option>
                                                        <option value="UASHIN GISHU">UASHIN GISHU</option>
                                                        <option value="THARAKA NITHI">THARAKA NITHI</option>
                                                        <option value="NANDI">NANDI</option>
                                                        <option value="ISIOLO">ISIOLO</option>
                                                        <option value="ELGEYO MARAKWET">ELGEYO MARAKWET</option>
                                                        <option value="MARSABIT">MARSABIT</option>
                                                        <option value="ITEN">ITEN</option>
                                                        <option value="WAJIR">WAJIR</option>
                                                        <option value="BARINGO">BARINGO</option>
                                                        <option value="GARISSA">GARISSA</option>
                                                        <option value="SAMBURU">SAMBURU</option>
                                                        <option value="KISUMU">KISUMU</option>
                                                        <option value="BOMET">BOMET</option>
                                                        <option value="HOMA BAY">HOMA BAY</option>
                                                        <option value="NAKURU">NAKURU</option>
                                                        <option value="SIAYA">SIAYA</option>
                                                        <option value="KERICHO">KERICHO</option>
                                                        <option value="KISII">KISII</option>
                                                        <option value="NAROK">NAROK</option>
                                                        <option value="MIGORI">MIGORI</option>
                                                        <option value="TAITA TAVETA">TAITA TAVETA</option>
                                                        <option value="KWALE">KWALE</option>
                                                        <option value="LAMU">LAMU</option>
                                                        <option value="KILIFI">KILIFI</option>
                                                        <option value="MOMBASA">MOMBASA</option>
                                                        <option value="NYAMIRA">NYAMIRA</option>
                                                        <option value="TANA RIVER">TANA RIVER</option>
                                                        <option value="LAIKIPIA">LAIKIPIA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>>
                                                        <input class="form-control" name="password" id="userPassword" type="password" value="<?php echo $password; ?>" placeholder="Create a password" />
                                                        <label for="userPassword" class="required">Password</label>
                                                        <span class="help-block"><?php echo $password_err; ?></span>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0" <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>>
                                                        <input class="form-control" name="confirm_password" id="userPasswordConfirmation" type="password" value="<?php echo $confirm_password; ?>" placeholder="Confirm password" />
                                                        <label for="userPasswordConfirmation" class="required">Confirm Password</label>
                                                        <span class="help-block"><?php echo $confirm_password_err; ?></span>

                                                    </div>
                                                </div></br></br></br>
                                          
                                            </div>
                                            <div class="mt-4 mb-0">
                                              <!--  <div class="d-grid"><a class="btn btn-primary btn-block" href="#user_login.html">Create Account</a></div> -->
                                                <button type="submit" class="btn btn-primary">Create account</button>

                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="user_login.html">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; NCA 2022</div>
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
    </body>
</html>
