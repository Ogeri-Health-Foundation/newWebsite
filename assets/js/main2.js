function trackClick(action, url) {
    console.log("Tracking click:", action); // <-- Debug log
    fetch(`/newWebsite/api/v1/track_click.php?action=${action}`)
        .finally(() => {
            setTimeout(() => {
                window.location.href = url;
            }, 100); // 100ms is enough
        });

    return false; // prevent default link action
}
