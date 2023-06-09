<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" href="style.css">
</head>
<body>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    table th {
        background-color: #f2f2f2;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tr:hover {
        background-color: #f5f5f5;
    }
</style>

    <a href="admin_paneli.php" class="btn btn-primary p-4">Back to admin.php</a>

    <?php

    // DB INFO 

    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");

    if ($conn->connect_error) {
        die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM request_table";
    $result = $conn->query($sql);
    ?>

    <div class="table-responsive-xl">
        <table class="table" id="productTable">
            <thead>
                <tr>

                    <th>ID</th>
                    <th> Collection_id </th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Review</th>
                    <th>Spec Names</th>
                    <th>Spec Values</th>
                    <th>Score</th>
                    <th>Pros</th>
                    <th>Post Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['collection_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['image']; ?></td>
                            <td><?php echo $row['review']; ?></td>
                            <td><?php echo $row['spec_names']; ?></td>
                            <td><?php echo $row['spec_values']; ?></td>
                            <td><?php echo $row['score']; ?></td>
                            <td><?php echo $row['pros']; ?></td>
                            <td><?php echo $row['post_name']; ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm edit-button" data-id="<?php echo $row['id']; ?>">Edit</button>
                                <button class="btn btn-danger btn-sm delete-button" data-id="<?php echo $row['id']; ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">Veritabanında kayıt bulunamadı.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    </div>

    <script>
        $(document).ready(function() {
           
            $('#productTable').DataTable({
                "paging": true,
                "lengthMenu": [5, 10, 15, 20], 
                "searching": true
            });
        });

        $(document).on('click', '.edit-button', function() {
            var modalContent = `
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal içeriği -->
                    </div>
                </div>
            `;

            var id = $(this).data('id');
            var collection_id = $(this).closest('tr').find('td:eq(1)').text();
            var name = $(this).closest('tr').find('td:eq(2)').text();
            var image = $(this).closest('tr').find('td:eq(3)').text();
            var review = $(this).closest('tr').find('td:eq(4)').text();
            var specNames = $(this).closest('tr').find('td:eq(5)').text();
            var specValues = $(this).closest('tr').find('td:eq(6)').text();
            var score = $(this).closest('tr').find('td:eq(7)').text();
            var pros = $(this).closest('tr').find('td:eq(8)').text();
            var postName = $(this).closest('tr').find('td:eq(9)').text();

            var modal = $('#editModal');
            modal.html(modalContent);

            var modalBody = modal.find('.modal-content');
            modalBody.html(`
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="editId" name="id" value="${id}">

                        <div class="mb-1">
                <label for="id" class="form-label">ID</label>
                <input type="text" id="idInput" name="collection_id" class="form-control" required value="${collection_id}">

                   </div>
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" value="${name}">
                        </div>
                        <div class="mb-3">
                            <label for="editImage" class="form-label">Image</label>
                            <input type="text" class="form-control" id="editImage" name="image" value="${image}">
                        </div>
                        <div class="mb-3">
                            <label for="editReview" class="form-label">Review</label>
                            <input type="text" class="form-control" id="editReview" name="review" value="${review}">
                        </div>
                        <div class="mb-3">
                            <label for="editSpecNames" class="form-label">Spec Names</label>
                            <input type="text" class="form-control" id="editSpecNames" name="spec_names" value="${specNames}">
                        </div>
                        <div class="mb-3">
                            <label for="editSpecValues" class="form-label">Spec Values</label>
                            <input type="text" class="form-control" id="editSpecValues" name="spec_values" value="${specValues}">
                        </div>
                        <div class="mb-3">
                            <label for="editScore" class="form-label">Score</label>
                            <input type="text" class="form-control" id="editScore" name="score" value="${score}">
                        </div>
                        <div class="mb-3">
                            <label for="editPros" class="form-label">Pros</label>
                            <input type="text" class="form-control" id="editPros" name="pros" value="${pros}">
                        </div>
                        <div class="mb-3">
                            <label for="editPostName" class="form-label">Post Name</label>
                            <input type="text" class="form-control" id="editPostName" name="post_name" value="${postName}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save Changes</button>
                </div>
            `);

            modal.modal('show');
        });

        $(document).on('click', '#saveChanges', function() {

            var id = $('#editId').val();
            var collection_id = $('#idInput').val();
            var name = $('#editName').val();
            var image = $('#editImage').val();
            var review = $('#editReview').val();
            var specNames = $('#editSpecNames').val();
            var specValues = $('#editSpecValues').val();
            var score = $('#editScore').val();
            var pros = $('#editPros').val();
            var postName = $('#editPostName').val();

            $.ajax({
                url: 'update.php',
                type: 'POST',
                data: {
                    id: id,
                    collection_id: collection_id,
                    name: name,
                    image: image,
                    review: review,
                    spec_names: specNames,
                    spec_values: specValues,
                    score: score,
                    pros: pros,
                    post_name: postName
                },
                success: function(response) {
                    $('#editModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.log('AJAX isteği başarısız: ' + error);
                }
            });
        });

        $(document).on('click', '.delete-button', function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    url: 'delete.php',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(response) {
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX isteği başarısız: ' + error);
                    }
                });
            }
        });
    </script>
</body>
</html>











