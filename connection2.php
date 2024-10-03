<?php
	/******************************************************************
	*   This page was created by Nur Atikah binti Arbain (02706)      *
	*   on 04 August 2024, Sunday. It contains a collection of         *
	*   functions that used for Certificate System. Any copy made     *
	*   MUST credit to the owner. Thanks!                             *
	******************************************************************/
	
	require("config.php");
	session_start();
	$con = null;

	//create connection to database
	function connectionDB(){
		$GLOBALS['con'] = mysqli_connect(DB_SERVERNAME,DB_USER,DB_PASSWORD,DB_NAME);
		if(mysqli_connect_error()){
			echo "Failed to connect to MySQL : ".mysqli_connect_error();
		}
	}
		
	function queryDb($sql){
		
		connectionDB();
			
        if(mysqli_connect_error()){
            die(mysqli_connect_error());
        }
        else{
            $result = mysqli_query($GLOBALS['con'],$sql);

            if($result){
                return $result;
            }else{
                return "Error : ".mysqli_error($GLOBALS['con']);
            }
        }
	}

    function funcRecordDownloaded($column1,$column2){
        $status = 0;
        $userid = "";

        if(strpbrk($column1, '0123456789') !== false){
            $query = "SELECT * FROM certificate WHERE matricno = '$column1'";
            $result = queryDb($query);
            if(mysqli_num_rows($result) > 0)
            {
                while($rs = mysqli_fetch_array($result))
                {
                    $userid = $rs['certId'];         
                }
            }
        }else{
            $query = "SELECT * FROM certificate WHERE name LIKE '%$column1%'";          
            $result = queryDb($query);
            if(mysqli_num_rows($result) > 0)
            {
                while($rs = mysqli_fetch_array($result))
                {
                    $userid = $rs['certId'];         
                }
            }
        }
        
        if(!empty($userid)){
            $insert = "INSERT INTO historydownload(status,userId) VALUES ($column2,'$userid')";
            $result = queryDb($insert);

            if($result)
            {
                $status = 1;
            }
        }
        return $status;
    }

    function funcUpload($column1, $column2, $column3, $column4,$column5,$column6,$column7){
        $status = 0;

        $insert = "INSERT INTO certificate(name,matricno,program,nounischool,universitySchool,filename,fileid) 
        VALUES ('$column1', '$column2', '$column3', $column4, '$column5', '$column6','$column7')";
        $result = queryDb($insert);

        if($result)
        {
            $status = 1;
        }

        return $status;
    }

    function funcGuruUrl($name, $selectedValue){
        $status = "";

		if(!empty($selectedValue)){
            if($selectedValue == 1){
                $query = "SELECT * FROM certificate WHERE matricNo = '$name'";
                $result = queryDb($query);

                    if ($result->num_rows > 0) {
                        $rs = $result->fetch_assoc();
                        $status = $rs['fileID'];
                    }   
            }else{
                if($selectedValue === '/')
                {
                    $status = 0;
                }
                else{
                    $query = "SELECT * FROM certificate WHERE nounischool = $selectedValue AND name LIKE '%$name%'";
                    $result = queryDb($query);

                    if ($result->num_rows > 0) {
                        $rs = $result->fetch_assoc();
                        $status = $rs['fileID'];
                    }   
                }            
            } 
		}
		return $status;
    }

	function funcCheck($txtNameOrMatrik, $selectedValue){

        $status = "TIADA";

		if(!empty($txtNameOrMatrik) && !empty($selectedValue)){

            if (strpbrk($txtNameOrMatrik, '0123456789') !== false) {
                $query = "SELECT * FROM certificate WHERE nounischool = $selectedValue AND matricno = '$txtNameOrMatrik'";
                $result = queryDb($query);
                if(mysqli_num_rows($result) > 0)
                {
                    while($rs = mysqli_fetch_array($result))
                    {
                        $status = $rs['name'];         
                    }
                }
            } else {
                $query = "SELECT * FROM certificate WHERE nounischool = $selectedValue";
                $result = queryDb($query);
                while($rs = mysqli_fetch_array($result))
                {
                    if($txtNameOrMatrik === $rs['name']){
                        $status = $rs['name']; 
                    }            
                }
            }                            
		}
		return $status;
	}

    function fetchStudentName($matricno){
        $query = "SELECT * FROM certificate WHERE matricno = '$matricno'";
        $result = queryDb($query);
        while($rs = mysqli_fetch_array($result))
        {
            return $rs['name'];         
        }
}

	function funcRegisterCert($username, $nounischool){
		$status = 0;

        if($nounischool == 1){
            $sekolahUniversiti = "Universiti Teknikal Malaysia Melaka";
        }
        elseif($nounischool == 2){
            $sekolahUniversiti = "SMK Munshi Abdullah";
        }
        elseif($nounischool == 3){
            $sekolahUniversiti = "SMK Paya Rumput";
        }
        elseif($nounischool == 4){
            $sekolahUniversiti = "SMK Pernu";
        }
        elseif($nounischool == 5){
            $sekolahUniversiti = "SMK Iskandar Shah";
        }
        elseif($nounischool == 6){
            $sekolahUniversiti = "SMK Bukit Baru";
        }
        elseif($nounischool == 7){
            $sekolahUniversiti = "SMK Telok Mas";
        }
        elseif($nounischool == 8){
            $sekolahUniversiti = "SMK Tinggi Melaka";
        }

        $insert = "INSERT INTO certificate(name,universitySchool,nounischool) 
                    VALUES ('$username', '$sekolahUniversiti', $nounischool)";
        $result = queryDb($insert);

        if($result)
        {
            $status = 1;
        }

		return $status;
	}
?>
