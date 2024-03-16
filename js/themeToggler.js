const btnThemeToggler = document.getElementById("theme-toggler");
const page = document.getElementById("page")
const theme = localStorage.getItem("theme");

if (theme === "dark-mode") {
  document.body.classList.add("dark-mode");
  btnThemeToggler.ariaPressed = "true";
}

btnThemeToggler.addEventListener("click", () => {
  if (btnThemeToggler.getAttribute("aria-pressed") === "true") {
    btnThemeToggler.ariaPressed = "false";
    localStorage.setItem("theme", "default-mode");
    document.body.classList.remove("dark-mode");
  } else {
    localStorage.setItem("theme", "dark-mode");
    btnThemeToggler.ariaPressed = "true";
    document.body.classList.add("dark-mode");
  }
});
