
document.addEventListener("DOMContentLoaded", function () {
  const params = new URLSearchParams(window.location.search);
  if (params.has("message")) {
    let message = params.get("message");
    if (message === "success") {
      alert("Your appointment has been booked successfully!");
    } else if (message === "duplicate") {
      alert(
        "You already have an appointment with this test on the selected date."
      );
    } else if (message === "error") {
      alert("There was an error booking your appointment. Please try again.");
    }
    // Remove query parameters from the URL after showing the message
    history.replaceState({}, document.title, window.location.pathname);
  }
});
