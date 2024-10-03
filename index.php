<?php
require("connection2.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);


	if(isset($_POST['btnCARI'])){
		$statusLogin = funcCheck(strtoupper($_POST['txtNameOrMatrik']), $_POST['selectedValue']);

        $sekolahUniversiti = "";

        if($_POST['selectedValue'] == 1){
            $sekolahUniversiti = "Universiti Teknikal Malaysia Melaka";
        }
        elseif($_POST['selectedValue'] == 2){
            $sekolahUniversiti = "SMK Munshi Abdullah";
        }
        elseif($_POST['selectedValue'] == 3){
            $sekolahUniversiti = "SMK Paya Rumput";
        }
        elseif($_POST['selectedValue'] == 4){
            $sekolahUniversiti = "SMK Pernu";
        }
        elseif($_POST['selectedValue'] == 5){
            $sekolahUniversiti = "SMK Iskandar Shah";
        }
        elseif($_POST['selectedValue'] == 6){
            $sekolahUniversiti = "SMK Bukit Baru";
        }
        elseif($_POST['selectedValue'] == 7){
            $sekolahUniversiti = "SMK Telok Mas";
        }
        elseif($_POST['selectedValue'] == 8){
            $sekolahUniversiti = "SMK Tinggi Melaka";
        }
        elseif($_POST['selectedValue'] == 9){
            $sekolahUniversiti = "Jabatan Pendidikan Negeri Melaka";
        }

		switch($statusLogin){
			case "TIADA":
				$msgError = "<center><div class='alert alert-danger' role='alert'><b>Perhatian : </b>Data yang dimasuk tiada dalam pangkalan data.</div></center>";
			break;
			case $statusLogin:
				$msgError = "<center><div class='alert alert-dark' role='alert'>
                <p>Data anda dijumpai. <br /><strong>Hi ".$statusLogin.
                "<br />".$sekolahUniversiti."</strong></p>                             
                <form method='POST'>
                <input type='hidden' name='data1' value=".$_POST['txtNameOrMatrik']." />
                <input type='hidden' name='data2' value=".$_POST['selectedValue']." />
                <button class='btn btn-primary' name='btnSchoolUniversiti'>MUAT TURUN</button></form></div></center>";
			break;
		}
	}

    if(isset($_POST['btnSchoolUniversiti']))
	{ 
        $file_id = funcGuruUrl(strtoupper($_POST['data1']), $_POST['data2']); // Replace with your actual URL ID

        if ($file_id) { 
            echo funcRecordDownloaded(strtoupper($_POST['data1']), 1);
              
            //Redirect to the URL
            header('Location: https://drive.google.com/uc?export=download&id='.$file_id);
            exit();
        } else {
            funcRecordDownloaded(strtoupper($_POST['data1']), 0);
            $msgError = "<center><div class='alert alert-dark' role='alert'>Maaf, <b>".strtoupper($_POST['data1']). "</b>.<br />Fail anda tiada dalam rekod.<br />
            Mohon rujuk <b>Tatacara Muat Turun E-sijil</b> semula.<br /> Terima kasih.</div></center>";
        }       
	}
?>

<html>
<head>
	<title>Muat Turun E-Sijil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
	<link type="text/css" href="layout.css" rel="stylesheet" media="screen">
	
</head>
<body>
	<div class="container my-5">
        <div class="row">
            <div class="col-md-12 mb-12">
                <div class="box rules">
                    <h2 class="text-center" style="font-size: clamp(24px, 1.5rem + 1vw, 40px);"><strong>E-SIJIL</strong></h2>
                    <p class="text-center" style="line-height: 1.5;">
                        <strong>PROGRAM SULAM <br />
                        "Memahami Penggunaan Pangkalan Data <br />
                        Dalam Kalangan Pelajar Sekolah"
                        </strong></p>
                    <hr />
                    <div class="row">
                        <div class="col-md-6 mb-6">
                            <div class="box rules">
                            <p><strong>Tatacara Muat Turun E-sijil.</strong></p>
                                <ul class="example-list">
                                    <li>Bagi <strong>GURU</strong>, masukkan nama penuh (tanpa bin/binti). <br />
                                        Bagi <strong>PELAJAR UTeM</strong>, masukkan no matrik.
                                    </li>
                                    <li>Pilih nama sekolah/universiti.</li>
                                    <li>Tekan butang 'CARI'.</li>
                                    <li>Jika status carian berjaya, butang 'MUAT TURUN' akan muncul.</li>
                                </ul>
                                <i>*e-sijil <strong>pelajar sekolah</strong> 
                                akan disertakan bersama dalam muat turun guru masing-masing.</i>
                                <br /><br />
                                <p>Sebarang pertanyaan boleh hubungi: <br /><b>Dr. Nur Atikah -> nur.atikah@utem.edu.my</b></p>

                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <div class="box rules">
                            <p><strong>Muat Turun E-sijil.</strong></p>
                            <form method="POST">
                            <div class="mb-3">
                                <input type="text" name="txtNameOrMatrik" class="form-control" placeholder="Nama Penuh GURU atau No Matrik PELAJAR" id="username" required>
                            </div>
                            <div class="dropdown">
                                <button value="0" class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pilih Nama Sekolah/Universiti
                                </button>
                                <ul class="dropdown-menu">
                                    <li><button class="dropdown-item" type="button" value="1">Universiti Teknikal Malaysia Melaka</button></li>
                                    <li><button class="dropdown-item" type="button" value="2">SMK Munshi Abdullah</button></li>
                                    <li><button class="dropdown-item" type="button" value="3">SMK Paya Rumput</button></li>
                                    <li><button class="dropdown-item" type="button" value="4">SMK Pernu</button></li>
                                    <li><button class="dropdown-item" type="button" value="5">SMK Iskandar Shah</button></li>
                                    <li><button class="dropdown-item" type="button" value="6">SMK Bukit Baru</button></li>
                                    <li><button class="dropdown-item" type="button" value="7">SMK Telok Mas</button></li>
                                    <li><button class="dropdown-item" type="button" value="8">SMK Tinggi Melaka</button></li>
                                    <li><button class="dropdown-item" type="button" value="9">Jabatan Pendidikan Negeri Melaka</button></li>
                                </ul>
                                <input type="hidden" name="selectedValue" id="selectedValue" value="">
                            </div>
                            
                            <br />
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" name="btnCARI">CARI</button>
                            </div>
                        </form>
                            <br />
                                <?php if(isset($msgError)){ echo $msgError; } ?>
                            </div>
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