$(document).ready(function() {

    // 🌟 BONUS SPRINT: Page load animation
    // Fades in all targeted cards over 800 milliseconds
    $('.invisible-on-load').fadeIn(800);

    // 1-4. INTERACTION SYSTEM: Core Mission Logic
    $('.btn-details').click(function() {
        
        // Contextually locate the structural hidden information area tied to THIS specific element
        const $detailsSection = $(this).closest('.card').find('.details');
        const $currentButton = $(this);

        // 2 & 4. Expand and Collapse Details smoothly using slideToggle
        $detailsSection.slideToggle(300, function() {
            
            // This callback fires exactly when the open/close sliding animation completes
            if ($detailsSection.is(':visible')) {
                // 1. Change Button Text when expanded
                $currentButton.text('Hide Details');
                
                // 3. Animate Color on active state toggle using jQuery .css() inline execution
                $currentButton.css('background-color', '#dc2626'); // Transforms to Red when expanded
            } else {
                // 1. Revert Text upon closing collapse container
                $currentButton.text('Show Details');
                
                // 3. Animate Color back to default blue via manual configuration
                $currentButton.css('background-color', '#2563eb'); // Restores baseline primary theme
            }
        });

        // Demonstrating structural tracking: toggle an active helper class simultaneously
        $currentButton.toggleClass('active-state-marker');
    });

});