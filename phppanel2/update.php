<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

// DB INFO 

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}

$id = $_POST['id'];
$collection_id = $_POST['collection_id'];
$name = $_POST['name'];
$image = $_POST['image'];
$review = $_POST['review'];
$spec_names = $_POST['spec_names'];
$spec_values = $_POST['spec_values'];
$score = $_POST['score'];
$pros = $_POST['pros'];
$post_name = $_POST['post_name'];

$sql = "UPDATE request_table SET 
            collection_id = '$collection_id',
            name = '$name',
            image = '$image',
            review = '$review',
            spec_names = '$spec_names',
            spec_values = '$spec_values',
            score = '$score',
            pros = '$pros',
            post_name = '$post_name'
        WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Veri güncellendi";
} else {
    echo "Hata oluştu: " . $conn->error;
}
$conn->close();

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#saveChangesBtn').on('click', function() {
            var id = $('#edit_id').val();
            var collection_id = $('#collection_id').val();
            var name = $('#edit_name').val();
            var image = $('#edit_image').val();
            var review = $('#edit_review').val();
            var spec_names = $('#edit_spec_names').val();
            var spec_values = $('#edit_spec_values').val();
            var score = $('#edit_score').val();
            var pros = $('#edit_pros').val();
            var post_name = $('#edit_post_name').val();

            $.ajax({
                url: 'update.php',
                type: 'POST',
                data: {
                    // id: id,
                    // collection_id : collection_id,
                    // name: name,
                    // image: image,
                    // review: review,
                    // spec_names: spec_names,
                    // spec_values: spec_values,
                    // score: score,
                    // pros: pros,
                    // post_name: post_name
                },
                success: function(response) {
                    $('#request-table').load('admin_paneli.php #request-table');

                    $('#editModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.log('AJAX isteği başarısız: ' + error);
                }
            });
        });
    });
</script>

</body>
</html>
