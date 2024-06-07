function friend_add(friendId) {
  $.ajax({
    type: "POST",
    url: "friend_add.php",
    data: { friendId: friendId },
    success: function (response) {
      response = JSON.parse(response); // Parse JSON response
      if (response.success) {
      } else {
        alert(response.error);
      }
    },
    error: function () {
      alert("Error adding friend.");
    },
  });
}

function friend_remove(friendId) {
  if (confirm("Are you sure you want to remove this friend?")) {
    $.ajax({
      type: "POST",
      url: "friends_remove.php",
      data: { friendId: friendId },
      success: function (response) {
        response = JSON.parse(response); // Parse JSON response
        if (response.success) {
        } else {
          alert(response.error);
        }
      },
      error: function () {
        alert("Error removing friend.");
      },
    });
  }
}
