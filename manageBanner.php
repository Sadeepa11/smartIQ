<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Banner</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <style>
        .banner-container {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .image-preview {
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
            overflow: hidden;
            border-radius: 0.75rem;
            height: 200px;
            margin-bottom: 1rem;
        }

        .image-preview:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0.75rem;
        }

        .upload-btn {
            background: linear-gradient(45deg, #4a90e2, #357abd);
            border: none;
            padding: 1rem 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .upload-btn:hover {
            background: linear-gradient(45deg, #357abd, #2d6da3);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
        }

        .section-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: #4a90e2;
            border-radius: 3px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="banner-container">
            <div class="row">
                <div class="col-12 mb-4">
                    <h2 class="section-title">Banner Management</h2>
                </div>
                <div class="col-12">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="image-preview border-0">
                                <img src="resource/addproductimg.svg" class="img-fluid" id="si0" alt="Banner preview 1"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="image-preview border-0">
                                <img src="resource/addproductimg.svg" class="img-fluid" id="si1" alt="Banner preview 2"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="image-preview border-0">
                                <img src="resource/addproductimg.svg" class="img-fluid" id="si2" alt="Banner preview 3"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <input type="file" class="d-none" id="simageuploader" multiple />
                    <label for="simageuploader" class="upload-btn btn btn-primary d-block w-100" onclick="changeBannerImage();">
                        <i class="bi bi-cloud-upload me-2"></i>Upload Banner Images
                    </label>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>
</html>