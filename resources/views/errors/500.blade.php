<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electic Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="/css/cdn.tailwind.css">
    <link rel="icon" href="icon_path" type="image/icon type">
</head>
<body>
<div class="flex items-center justify-center w-screen h-screen">
  <div class="px-4 lg:py-12">
    <div class="lg:gap-4 lg:flex">
      <div
        class="flex flex-col items-center justify-center md:py-24 lg:py-32"
      >
        <h1 class="font-bold text-blue-600 text-9xl">500</h1>
        <p
          class="mb-2 text-2xl font-bold text-center text-gray-800 md:text-3xl"
        >
          <span class="text-red-500">Oops!</span> Server Error
        </p>
        <p class="mb-8 text-center text-gray-500 md:text-lg">
          Server Sedang Dalam Perbaikan !!!
        </p>
        <a
          href="/logout"
          class="px-6 py-2 text-sm font-semibold text-blue-800 bg-blue-100"
          >Go Back</a
        >
      </div>
    </div>
  </div>
</div>
</body>
</html>