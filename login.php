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
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['identifiant']) && isset($_POST['password'])) {
                if ($_POST['identifiant'] == "esn" && $_POST['password'] == "1234") {
                    $_SESSION['admin'] = true;
                    header('Location: list_cv.php');
                } else {
                    $message = 'Wrong identifier';
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

        <div class="w-full h-[calc(100dvh-5rem)] flex flex-col justify-center items-center">
            <form action="login.php" method="POST" enctype="multipart/form-data" class="flex flex-col justify-start items-start">
                <h1 class="w-full text-3xl font-black mb-10 text-center">Login</h1>

                <label for="name" class="w-full">Identifiant
                    <input type="text" name="identifiant" id="identifiant" class="border rounded my-2 mx-2" />
                </label>

                <label for="name" class="w-full">Password
                    <input type="password" name="password" id="password" class="border rounded my-2 mx-2" />
                </label>

                <input type="submit" class="w-full bg-purple-500 text-white rounded my-5 py-2 hover:cursor-pointer">

                <?php if (isset($message)) : ?>
                    <p class="w-full text-center py-3 text-white rounded-lg <?php echo 'bg-red-500'; ?>">
                        <?php echo $message; ?>
                    </p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>