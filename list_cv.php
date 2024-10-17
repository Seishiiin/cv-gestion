<?php session_start() ?>

<html lang="en">
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

        <div class="w-full h-[calc(100dvh-5rem)] flex flex-col justify-center items-center">
            <?php
                if (!isset($_SESSION['admin'])) {
                    echo "<h1 class='text-3xl font-black'>You are not logged in</h1>";
                    echo "<a href='login.php' class='w-40 text-center bg-purple-500 text-white rounded my-5 py-2 hover:cursor-pointer'>Login</a>";
                } else {
                    $dir = 'cv/';
                    if (is_dir($dir)) {
                        $files = scandir($dir);

                        $cv_files = array_filter($files, function ($file) use ($dir) {
                            return is_file($dir . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'pdf';
                        });

                        if (count($cv_files) > 0) {
                            echo "<h1 class='text-3xl font-black mb-5'>List of CVs</h1>";
                            echo "<ul class='w-full max-w-lg bg-white shadow rounded-lg p-5'>";
                            foreach ($cv_files as $file) {
                                echo "<li class='py-2 px-4 bg-purple-100 hover:bg-purple-300 text-purple-900 rounded mb-2 duration-300'>$file</li>";
                            }
                            echo "</ul>";
                        } else {
                            echo "<h1 class='text-2xl font-black'>No CVs found</h1>";
                        }
                    } else {
                        echo "<h1 class='text-2xl font-black'>CV directory not found</h1>";
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>