<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Layout avec DaisyUI</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="drawer drawer-mobile">
    <input id="drawer-toggle" type="checkbox" class="drawer-toggle">
    <div class="drawer-content p-6">
        <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
        <p>Contenu principal ici...</p>
    </div>
    <div class="drawer-side">
        <label for="drawer-toggle" class="drawer-overlay"></label>
        <ul class="menu p-4 w-60 bg-base-200 text-base-content">
            <!-- Logo 1 -->
            <li>
                <a href="#">
                    <img src="https://via.placeholder.com/40" alt="Logo 1" class="w-10 h-10 mr-2">
                    Logo 1
                </a>
            </li>
-            <li>
                <a href="#">
                    <img src="https://via.placeholder.com/40" alt="Logo 2" class="w-10 h-10 mr-2">
                    Logo 2
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="https://via.placeholder.com/40" alt="Logo 3" class="w-10 h-10 mr-2">
                    Logo 3
                </a>
            </li>
            <li>
                <a href="#">
                    <img src="https://via.placeholder.com/40" alt="Logo 4" class="w-10 h-10 mr-2">
                    Logo 4
                </a>
            </li>
        </ul>
    </div>
</div>
</body>
</html>
