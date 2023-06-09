<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
?>



<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Paneli</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <link rel="stylesheet" href="style.css">
    
        
    </head>
    <body>

        <div class="container">
            <h1 class="mt-5">Admin Panel</h1>
            <p class="mt-3">Welcome, <?php echo $_SESSION['username']; ?>!</p>
            <a href="cikis.php" class="btn btn-primary"> logout</a>

            <script>
    // function showSelectedValue(event) {
    //     event.preventDefault(); 
    //     var selectBox = document.getElementById("collectionSelect");
    //     var nameInput = document.getElementById("nameInput");
    //     var selectedValue = selectBox.value;
    //     nameInput.value = selectedValue;
    // }

</script>

            <form  onsubmit="showSelectedValue(event)"  enctype="multipart/form-data" action="" method="POST" class="mt-3">
            <style>
body {
  background-color: #f8f9fa;
  overflow: hi;
}

.container {
  max-width: 460px;
  margin: 0 auto;
  padding-top: 0px;
  position: relative;
  z-index: 1;
}

.container h1 {
  text-align: center;
  margin-bottom: 30px;
}

.container form {
  background-color: #fff;
  padding: 10px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.container form .form-group {
  margin-bottom: 20px;
}

.container form .form-group label {
  font-weight: bold;
}

.container form .form-group input {
  border: 1px solid #ced4da;
  border-radius: 3px;
  padding: 8px;
  width: 100%;
}

.container form .form-group input:focus {
  outline: none;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  border-color: #80bdff;
}

.container form .btn-primary {
  width: 100%;
}

.container form .btn-primary:hover {
  background-color: #0069d9;
  border-color: #0062cc;
}

.container form .text-center {
  margin-top: 0px;
}

.container form .text-center a {
  color: #999;
}

.container form .text-center a:hover {
  color: #000;
}

.background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 0;
}

.select2-dropdown .select2-dropdown--below {

left: 360px;

}

</style>



<script>



</script>

                
<form class="">

<!--                      
        
                <div class="mb-1">
                    <label for="name" class="form-label">Collection_id</label>
                    <select name="" id="" form=""> </select>

                </div>  -->

                <div class="mb-1">
                <label for="id" class="form-label">ID</label>
                <input type="text" id="idInput" name="collection_id" class="form-control" required value="<?php echo isset($_POST['collection_id']) ? $_POST['collection_id'] : ''; ?>">
            </div>
                    <div class="mb-3">
                 <label for="name" class="form-label">Name</label>
                <input type="text" id="nameInput" name="name" class="form-control" required>
                 </div>

                <div class="mb-4">
                    <label for="image" class="form-label">Image</label>
                    <input type="text" name="image" class="form-control" required>
                </div>
            
                

                <div class="form-floating mb-2">
                 <textarea name="review" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                <label for="floatingTextarea">review</label>
                </div>

                <div class="mb-1">
                    <label for="spec_names" class="form-label">Specnames</label>
                    <input type="text" name="spec_names" class="form-control" required>
                </div>
            
                <div class="mb-1">
                    <label for="spec_values" class="form-label">Spec_values</label>
                    <input type="text" name="spec_values" class="form-control" required>
                </div>
            
                <div class="mb-1">
                    <label for="score" class="form-label">Score</label>
                    <input type="textbox" name="score" class="form-control" required>
                </div>
            
                <div class="mb-1">
                    <label for="pros" class="form-label">Pros</label>
                    <input type="text" name="pros" class="form-control" required>
                </div>
            
                <div class="mb-1">
                    <label for="cons" class="form-label">Cons</label>
                    <input type="text" name="cons" class="form-control" required>
                </div>

                <div class="mb-1">
                    <label for="post_name" class="form-label">Post_name</label>
                    <input type="text" name="post_name" class="form-control" required>
                </div>
            
                

                <button type="submit" name="submit" class="btn btn-primary mb-3">Save</button>
                            <a href="rename.php"  style="float:right; margin-bottom:15rem;"class="btn btn-primary"> Edit </a>

            </form>



<?php


            // MySQL 

        // DB INFO 

        $conn = new mysqli($servername, $username, $password, $dbname);

        $conn->set_charset("utf8");



        if ($conn->connect_error) {
            die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){

            // $id = $_POST['id'];
            $collection_id = $_POST['collection_id'];
            $name = $_POST['name'];
            $image = $_POST['image'];
            $review = $_POST['review'];
            $spec_names = $_POST['spec_names'];
            $spec_values = $_POST['spec_values'];
            $score = $_POST['score'];
            $pros = $_POST['pros'];
            $cons = $_POST['cons'];
            $post_name = $_POST['post_name'];

           

            
            $sql = "INSERT INTO request_table (collection_id,name, image, review, spec_names, spec_values, score, pros, cons, post_name) VALUES ('$collection_id','$name', '$image', '$review', '$spec_names', '$spec_values', '$score', '$pros','$cons', '$post_name')";

            
            
            if ($conn->query($sql) === true) {
                $success = "Kayıt başarıyla eklendi.";
                echo '<script>window.location.href = "admin_paneli.php";</script>';
                exit; 
            } else {
                $error = "Kayıt eklenirken hata oluştu: " . $conn->error;
            }
        }

        
        

// collection 





$query = "SELECT id, name FROM collection";
  $result = $conn->query($query);
  $collectionData = array();

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $collectionData[] = array(
              'id' => $row['id'],
              'ad' => $row['name']
          );
      }
  }

  $conn->close();
  ?>
  

  
  <script>
    $(document).ready(function() {
      $('.collection').select2({
        
        placeholder: 'Search',
        allowClear: true,
        
      });
      
      $('.collection').on('change', function() {
        var selectedValue = $(this).val();
        var idInput = $('#idInput');
        var nameInput = $('#nameInput');

        if (selectedValue === '') {
          idInput.prop('disabled', true);
          nameInput.prop('disabled', true);
          idInput.val('');
          nameInput.val('');
        } else {
          var values = selectedValue.split(" - ");
          var idValue = values[0];
          var nameValue = values[1];
          idInput.val(idValue);
          nameInput.val(nameValue);
          idInput.prop('disabled', false);
          nameInput.prop('disabled', false);
        }
      });
    });
  </script>
  
  <style>

.select2-container {
  position: absostlute;
  bottom: 1170px;
  left: 100px !important;
  width: 300px !important;
  
}
@media (max-width: 768px) {
  .select2-container {
    position: absolute;
    bottom: 2000px;
     left: 200px;
  
  }

}



        </style>

  <div class="bbb"  
>
  <select id="collectionSelect" class="collection" ria-label=".form-select-lg example" name="id">
    <option></option>
    <?php foreach ($collectionData as $data): ?>
        <option value="<?php echo $data['id'] . ' - ' . $data['ad']; ?>"><?php echo $data['id'] . ' - ' . $data['ad']; ?></option>
    <?php endforeach; ?>
  </select>
  </div>

  <style>
    


  </style>

<!-- collection end  -->


        </div>
    </body>
</html>


