document.addEventListener("DOMContentLoaded", () => {
  const updatePictureButton = document.getElementById("update-picture-button");
  const updatePictureForm = document.getElementById("update-picture");
  const editProfileButton = document.getElementById("edit-profile-button");
  const editProfileForm = document.getElementById("edit-profile");
  const addFriendButton = document.getElementById("add-friend-button");
  const addFriendForm = document.getElementById("add-users");
  const removeFriendButton = document.getElementById("remove-friend-button");
  const removeFriendForm = document.getElementById("remove-friend");

  const allForms = [
    updatePictureForm,
    editProfileForm,
    addFriendForm,
    removeFriendForm,
  ];

  function closeAllFormsExcept(formToKeepOpen) {
    allForms.forEach((form) => {
      if (form !== formToKeepOpen) {
        form.style.display = "none";
      }
    });
  }

  updatePictureButton.onclick = function () {
    closeAllFormsExcept(updatePictureForm);
    updatePictureForm.style.display =
      updatePictureForm.style.display === "none" ? "block" : "none";
  };

  editProfileButton.onclick = function () {
    closeAllFormsExcept(editProfileForm);
    editProfileForm.style.display =
      editProfileForm.style.display === "none" ? "block" : "none";
  };

  addFriendButton.onclick = function () {
    closeAllFormsExcept(addFriendForm);
    addFriendForm.style.display =
      addFriendForm.style.display === "none" ? "block" : "none";
  };

  removeFriendButton.onclick = function () {
    closeAllFormsExcept(removeFriendForm);
    removeFriendForm.style.display =
      removeFriendForm.style.display === "none" ? "block" : "none";
  };
});
