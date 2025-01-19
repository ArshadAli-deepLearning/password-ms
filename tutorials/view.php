<?php
error_reporting(32767);
ini_set('display_errors', 1);

$basepath = realpath(__DIR__ . '/..');

include_once $basepath . "/inc/header.php";

spl_autoload_register(function ($classes) use ($basepath) {
    include $basepath . "/classes/" . $classes . ".php";
});

$tutorials = new Tutorials();

Session::CheckSession();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='alert alert-danger'>Invalid Tutorial ID.</div>";
    exit();
}

$id = (int) $_GET['id'];
$tutorial = $tutorials->getTutorialById($id);

if (!$tutorial) {
    echo "<div class='alert alert-warning'>Tutorial not found.</div>";
    exit();
}

/**
 * Convert URLs to embeddable format if applicable (YouTube, Vimeo).
 */
function getEmbedUrl($url) {
    if (strpos($url, "youtube.com") !== false || strpos($url, "youtu.be") !== false) {
        parse_str(parse_url($url, PHP_URL_QUERY), $query);
        $videoId = $query['v'] ?? basename(parse_url($url, PHP_URL_PATH));
        return "https://www.youtube.com/embed/$videoId";
    }
    if (strpos($url, "vimeo.com") !== false) {
        $videoId = (int) substr(parse_url($url, PHP_URL_PATH), 1);
        return "https://player.vimeo.com/video/$videoId";
    }
    return $url; // Default: return original URL
}

?>

<div class="card">
    <div class="card-header">
        <h3 class="text-center"><?php echo htmlspecialchars($tutorial->title); ?></h3>
    </div>
    <div class="card-body">
        <div style="width:80%; margin:0 auto;">
            <p style="white-space:pre-line;"><?php echo nl2br(htmlspecialchars($tutorial->detail)); ?></p>

            <?php if (!empty($tutorial->link)): ?>
                <div class="mt-3">
                    <?php 
                    $embedUrl = getEmbedUrl($tutorial->link);
                    if ($embedUrl !== $tutorial->link): ?>
                        <!-- Display iframe for embeddable links -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="<?php echo htmlspecialchars($embedUrl); ?>" allowfullscreen></iframe>
                        </div>
                    <?php else: ?>
                        <!-- Open in a new tab if embedding is blocked -->
                        <a href="<?php echo htmlspecialchars($tutorial->link); ?>" target="_blank" class="btn btn-primary">
                            Open Tutorial
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include $basepath . '/inc/footer.php'; ?>
