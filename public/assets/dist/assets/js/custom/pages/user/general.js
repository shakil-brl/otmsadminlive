$(function () {
    // Attach event handlers for the actions
    userTbody.on("click", ".show-action", function (e) {
        e.preventDefault();
        const userId = $(this).data("user-id");
        // Implement the 'Show' action logic using the userId
        window.open("/users/" + userId, "_self");
    });

    userTbody.on("click", ".edit-action", function (e) {
        e.preventDefault();
        const userId = $(this).data("user-id");
        // Implement the 'Edit' action logic using the userId
    });

    userTbody.on("click", ".delete-action", function (e) {
        e.preventDefault();
        const userId = $(this).data("user-id");
        // Implement the 'Delete' action logic using the userId
    });
});
