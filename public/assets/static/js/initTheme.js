if (typeof body === "undefined" && typeof theme === "undefined") {
    const body = document.body;
    const theme = localStorage.getItem("theme");
    if (theme) document.documentElement.setAttribute("data-bs-theme", theme);
} else {
    if (theme) document.documentElement.setAttribute("data-bs-theme", theme);
}
