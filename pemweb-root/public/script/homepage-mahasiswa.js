function toggleProfileMenu() {
    const menu = document.getElementById("profile-menu");
    menu.classList.toggle("hidden");
}

document.addEventListener("click", function (e) {
    const menu = document.getElementById("profile-menu");
    const icon = document.querySelector(".profile-icon");
    if (!menu.contains(e.target) && !icon.contains(e.target)) {
        menu.classList.add("hidden");
    }
})

