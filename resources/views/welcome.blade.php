<!doctype html>
<html data-theme="dark">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    @vite('resources/css/app.css')


</head>
<body>
<h1 class="text-3xl font-bold underline ">
    Hello world!
</h1>
<div class="w-full h-full bg-base-200 p-4 flex flex-col">
    <div class="hidden bg-primary"></div>
    <h2 class="text-2xl font-bold mb-6">Liste des Contacts</h2>
    <div class="flex-1 overflow-y-auto pr-2 grid grid-cols-1 gap-4">
        <livewire:contacts-list />
    </div>
</div>
<a class="text-primary" href="">test</a>

</body>
</html>
