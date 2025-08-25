
document.addEventListener("DOMContentLoaded", function () {
  const params = new URLSearchParams(window.location.search);
  if (params.has("message")) {
    let message = params.get("message");
    if (message === "success") {
      alert("Your Message has been booked successfully!");
    } else if (message === "duplicate") {
      alert(
        "You already Submitted a Message."
      );
    } else if (message === "error") {
      alert("There was an error submitting. Please try again.");
    }
    // Remove query parameters from the URL after showing the message
    history.replaceState({}, document.title, window.location.pathname);
  }
});
