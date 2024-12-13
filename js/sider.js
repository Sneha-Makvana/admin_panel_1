$(document).ready(function () {
    $('[data-toggle="collapse"]').on('click', function () {
        const arrowIcon = $(this).find('[data-feather="chevron-right"]');
        arrowIcon.toggleClass('rotate'); // Add a CSS class to rotate the arrow
        feather.replace(); // Update feather icons
    });
});
