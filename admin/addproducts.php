<?php
include '../connection.php';
include 'adminbase.php';
?>

<style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
    }

    .text-center {
        margin-bottom: 20px;
    }

    form {
        max-width: 100%;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    textarea {
        resize: vertical; /* Allow vertical resizing */
    }

    button {
        background-color: #007bff;
        color: #ffffff;
        border: none;
        padding: 10px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="text-center mb-4">
                    <h2 class="section-title px-5"><span class="px-2">Add Mobile Phones</span></h2>
                </div>

                <form action="process_add_phone.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="brand">Brand:</label>
                        <input type="text" class="form-control" id="brand" name="brand" required>
                    </div>

                    <div class="form-group">
                        <label for="model">Model:</label>
                        <input type="text" class="form-control" id="model" name="model" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>

                    <!-- <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                    </div> -->

                    <div class="form-group">
                        <label for="coverPhoto">Cover Photo:</label>
                        <input type="file" class="form-control-file" id="coverPhoto" name="coverPhoto" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Phone</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
