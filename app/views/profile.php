<h1 class="text-xl">Welcome, <?= $userName ?></h1>

<? if ((new \App\Middleware\AdminMiddleware())()): ?><h2>admin</h2><? endif; ?>