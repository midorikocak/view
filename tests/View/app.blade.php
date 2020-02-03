<?php

declare(strict_types=1);

// phpcs:disable

?>
<html>
<head>
    <title>App Name - {{ $title }})</title>
</head>
<body>
@section('sidebar')
    This is the master sidebar.
@show

<div class="container">
    {{ $content }}
</div>
</body>
</html>
