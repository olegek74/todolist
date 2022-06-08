<?php use App\Classes\Helper;
$view = Helper::getView();
?>
<head>
    <title><?php echo $view->page_title; ?><?php ?><?php echo ($page > 1) ? ' page'.$page : ''; ?></title>
    <meta name="description" content="<?php echo $meta['description']; ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="/css/style.css" rel="stylesheet">
    <script src="/js/jquery.js"></script>
    <script src="/js/script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>