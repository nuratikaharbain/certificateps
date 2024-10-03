<?php
require("connection2.php");

if(isset($_POST['btnRegister'])){
    $statusLogin = funcRegisterCert(strtoupper($_POST['username']), strtoupper($_POST['universityschool']));

    switch($statusLogin){
        case 0:
            $msgError = "<center><div class='alert alert-danger' role='alert'><b>WARNING : Please insert name/universitySchool!</div></center>";
        break;
        case $statusLogin:
            $msgError = "<center><div class='alert alert-dark' role='alert'>
            Successfully register.</div></center>";
        break;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <link type="text/css" href="layout.css" rel="stylesheet" media="screen">
    
</head>
<body>
    <br /><br />
    <br />

    <div class="container my-5">
        <div class="row">
            <div class="col-md-12 mb-12">
                <div class="box rules">
                <h2 class="text-center">Certificate Registration Details</h2>
                <div class="row">
                    <div class="col-md-6 mb-6">
                        <div class="box rules">
                        <?php if(isset($msgError)){ echo $msgError; } ?>
                        <h3>For Single Data</h3><br />
                        <form method="POST">
                            <div class="form-group">
                                <input placeholder=" User Full Name" type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <br />
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Select School/University
                                </button>
                                <ul class="dropdown-menu">
                                    <li><button class="dropdown-item" type="button" value="1">UTeM</button></li>
                                    <li><button class="dropdown-item" type="button" value="2">SMK Munshi Abdullah</button></li>
                                    <li><button class="dropdown-item" type="button" value="3">SMK Paya Rumput</button></li>
                                    <li><button class="dropdown-item" type="button" value="4">SMK Pernu</button></li>
                                    <li><button class="dropdown-item" type="button" value="5">SMK Iskandar Shah</button></li>
                                    <li><button class="dropdown-item" type="button" value="6">SMK Bukit Baru</button></li>
                                    <li><button class="dropdown-item" type="button" value="7">SMK Telok Mas</button></li>
                                    <li><button class="dropdown-item" type="button" value="8">SMK Tinggi Melaka</button></li>
                                </ul>
                                <input type="hidden" name="selectedValue" id="selectedValue" value="">
                            </div>
                            <br />
                            <button type="submit" name="btnRegister" class="btn btn-primary btn-block">Register</button>
                        </form>
                        </div>
                    </div>
                    <div class="col-md-6 mb-6">
                        <div class="box rules">
                        <h3>For Many Data</h3><br />
                        <p><strong>Only csv file accepted.</strong><br />Guidelines to upload:</p>
                        <ul class="example-list">
                            <li>If data is not exist. Leave blank and skip to next column.</li>
                            <li>No header column.</li>
                            <li>1st column: matric no </li>
                            <li>2nd column: name</li>
                            <li>3rd column: fulname university/School</li>
                            <li>4th column: no of university/School (refer to dropdown menu)</li>
                        </ul>
                        <form action="readcsvfile.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="file" class="form-control-file" id="csvFile" name="csvFile" required>
                            </div><br />
                            <button type="submit" class="btn btn-primary">Read File</button>
                        </form>
                        </div>
                    </div>   
                </div>
            </div>
        </div>       
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // JavaScript to handle dropdown selection
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownItems = document.querySelectorAll('.dropdown-item');
            const dropdownButton = document.querySelector('#dropdownMenuButton');
            const hiddenInput = document.querySelector('#selectedValue');

            dropdownItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Set the button text to the selected item text
                    dropdownButton.textContent = this.textContent;

                    // Set the hidden input value to the selected item value
                    hiddenInput.value = this.value;

                    // Optionally: Close the dropdown menu after selection
                    const dropdown = new bootstrap.Dropdown(dropdownButton);
                    dropdown.hide();
                });
            });
        });
    </script>
</body>
</html>
