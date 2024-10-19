<?php session_start() ?>

<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <style>* {font-family: 'Outfit', sans-serif}</style>


	<title>Savana Job</title>
</head>
<body>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['name']) && isset($_FILES['file'])) {
                $name = $_POST['name'];
                $uploadDir = 'cv/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $uploadedFile = $_FILES['file'];

                if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
                    $timestamp = date('Y-m-d_H-i-s');
                    $destination = $uploadDir . $name . '_' . $timestamp . '.pdf';

                    $fileType = mime_content_type($uploadedFile['tmp_name']);
                    if ($fileType === 'application/pdf') {
                        if (move_uploaded_file($uploadedFile['tmp_name'], $destination)) {
                            $message = 'File uploaded successfully.';
                            $status_code = '200';
                        } else {
                            $message = 'File upload failed.';
                            $status_code = '400';
                        }
                    } else {
                        $message = 'Only PDF files are allowed.';
                    }
                } else {
                    $message = 'File upload error: ' . $uploadedFile['error'];
                }
            }
        }
    ?>

    <div class="w-dvw h-dvh flex flex-col justify-start items-center">
        <div class="w-dvw h-20 flex justify-between items-center px-10 shadow bg-purple-500 text-white">
            <h1 class="text-2xl font-black">Savana Jobs</h1>

            <div class="flex justify-end items-center gap-5">
                <a href="index.php" class="text-sm">Send a file</a>
                <a href="list_cv.php" class="text-sm">View all files</a>
                <?php if (isset($_SESSION['admin'])): ?>
                    <a href="logout.php" class="text-sm bg-white text-purple-500 px-3 py-1 rounded">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="text-sm bg-white text-purple-500 px-3 py-1 rounded">Login</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="w-dvw h-[calc(100dvh-5rem)] flex justify-center items-center">
            <form action="index.php" method="POST" enctype="multipart/form-data" class="flex flex-col justify-start items-start">
                <h1 class="w-full text-3xl font-black mb-10 text-center">Send your CV</h1>

                <label for="name" class="w-full">Your name
                    <input type="text" name="name" id="name" class="border rounded my-2 mx-2" />
                </label>

                <label for="file" class="w-full my-3 text-center bg-white text-purple-500 border-2 border-purpe-500 py-2 px-4 rounded cursor-pointer">Choose a file</label>
                <input type="file" name="file" id="file" class="hidden" />

                <input type="submit" class="w-full bg-purple-500 text-white rounded my-5 py-2 hover:cursor-pointer">

                <?php if (isset($message)) : ?>
                    <p class="w-full text-center py-3 text-white rounded-lg <?php echo ($status_code == '200') ? 'bg-green-500' : 'bg-red-500'; ?>">
                        <?php echo $message; ?>
                    </p>
                <?php endif; ?>
            </form>
        </div>

    </div>
</body>
</html>
