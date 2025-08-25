
document.addEventListener("DOMContentLoaded", function () {
  const params = new URLSearchParams(window.location.search);
  if (params.has("message")) {
    let message = params.get("message");
    if (message === "success") {
      alert("Your payment has been paid successfully!");
    } else if (message === "duplicate") {
      alert("You have already done this payment to the selected appointment.");
    } else if (message === "error") {
      alert("There was an error to confirm you payment. Please try again.");
    }
    // Remove query parameters from the URL after showing the message
    history.replaceState({}, document.title, window.location.pathname);
  }
});
