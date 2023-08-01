<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'My App' ?></title>

    <link rel="stylesheet" href="/public/css/app.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="overflow-x-hidden m-0 p-0 flex flex-col min-h-screen">
    <header class="p-4 sticky bg-gray-800 top-0 z-50 text-white flex justify-between">
        <nav>
            <ul class="flex gap-5">
                <li class="hover:text-gray-300"><a href="/">Home</a></li>

                <? if ((new \App\Middleware\AdminMiddleware())()): ?>
                    <li class="hover:text-gray-300"><a href="/admin">Admin panel</a></li>
                <? endif; ?>
            </ul>
        </nav>
        <div class="flex gap-5">
            <? if ((new \App\Middleware\AuthMiddleware())()): ?>
                <a class="hover:text-gray-300" href="/logout">Logout</a>
            <? else: ?>
                <a class="hover:text-gray-300" href="/login">Login</a>
                <a class="hover:text-gray-300" href="/register">Register</a>
            <? endif; ?>
        </div>
    </header>

    <main class="p-6 flex-1">
        <?= $content ?>
    </main>

    <footer class="bg-gray-800 text-white text-right p-6 w-full flex justify-end gap-5">
        <p>&copy; <?php echo date('Y'); ?> </p> 
        <div>
            <a class="hover:text-gray-300" href="https://github.com/mishkozyr">GitHub</a>
        </div>
    </footer>

    <script src="/public/js/app.js"></script>
</body>
</html>