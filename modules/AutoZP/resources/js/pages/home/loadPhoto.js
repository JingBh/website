const avatarUrl = require("../../utils/images").avatar;
let avatar = $("#userAvatar");

function getPhoto() {
    let agreed = ($("#inputPhotoConfirm").val() === "yes");
    if (agreed) {
        avatar.attr("src", "/autozp/user/photo");
        avatar.css("cursor", "");
    } else $("#photoConfirmModal").modal("show");
}

function defaultAvatar() {
    $("#userAvatar").attr("src", avatarUrl);
}

avatar.on("error", defaultAvatar);
avatar.css("cursor", "pointer");
avatar.click(getPhoto);

defaultAvatar();

$("#photoConfirm").click(function() {
    $("#inputPhotoConfirm").val("yes");
    $("#photoConfirmModal").modal("hide");
    getPhoto();
});
