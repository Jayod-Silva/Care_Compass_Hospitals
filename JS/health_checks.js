
function showHealthChecks(type) {
  document
    .getElementById("men-health-checks")
    .classList.toggle("hidden", type !== "men");
  document
    .getElementById("women-health-checks")
    .classList.toggle("hidden", type !== "women");
  document
    .getElementById("men-tab")
    .classList.toggle("inactive", type !== "men");
  document
    .getElementById("women-tab")
    .classList.toggle("inactive", type !== "women");
}
