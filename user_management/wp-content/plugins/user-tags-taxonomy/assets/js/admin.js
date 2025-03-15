jQuery(document).ready(function($) {
    $('#filter-button').click(function(e) {
        e.preventDefault(); // Prevent default form submission
        
        var selectedTag = $('#filter_user_tags').val();
        var url = new URL(window.location.href);
        var params = url.searchParams;

        if (selectedTag === 'all') {
            params.delete('filter_user_tags'); // Remove the filter
        } else {
            params.set('filter_user_tags', selectedTag); // Update the filter
        }

        window.location.href = url.toString();
    });
});
