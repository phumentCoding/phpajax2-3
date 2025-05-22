<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Data Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col">
                <h2>Student Data Management</h2>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                    <i class="bi bi-plus-circle me-2"></i>Add Student
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>N.O</td>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <tr>
                        <td>1</td>
                        <td>1001</td>
                        <td>image.jpg</td>
                        <td>Vann Nisa</td>
                        <td>Female</td>
                        <td>03245678</td>
                        <td>nisa@gmail.com</td>
                        <td>Kompong Thom</td>
                        <td>
                            <button onclick="" class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateStudentModal">Edit</button>
                            <button onclick="" class=" btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="noDataMessage" class="text-center py-5 d-none">
            <i class="bi bi-exclamation-circle fs-1 text-secondary"></i>
            <p class="mt-3 text-secondary">No student records found. Click "Add Student" to create a new record.</p>
        </div>
    </div>

    <?php include "modal-add.php" ?>


    <?php include "modal-update.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Init preview in Add Modal
            initImagePreview('#image', '#imagePreview', '#removeImageBtn');

            // Init preview in Edit Modal each time it's opened
            const updateModal = document.getElementById('updateStudentModal');
            updateModal.addEventListener('shown.bs.modal', function() {
                initImagePreview('#editImage', '#editImagePreview', '#editRemoveImageBtn');
            });
        });

        function initImagePreview(imageSelector, previewSelector, removeBtnSelector) {
            const imageInput = document.querySelector(imageSelector);
            const imagePreview = document.querySelector(previewSelector);
            const removeImageBtn = document.querySelector(removeBtnSelector);

            if (!imageInput || !imagePreview || !removeImageBtn) return;

            imageInput.addEventListener('change', function() {
                imagePreview.innerHTML = '';

                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        imagePreview.appendChild(img);
                        removeImageBtn.style.display = 'flex';
                    };

                    reader.readAsDataURL(this.files[0]);
                } else {
                    imagePreview.innerHTML = '<div class="preview-placeholder">Image preview will appear here</div>';
                    removeImageBtn.style.display = 'none';
                }
            });

            removeImageBtn.addEventListener('click', function() {
                imageInput.value = '';
                imagePreview.innerHTML = '<div class="preview-placeholder">Image preview will appear here</div>';
                removeImageBtn.style.display = 'none';
            });
        }
    </script>

    <script src="script.js"></script>


</body>

</html>