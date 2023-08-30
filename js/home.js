// メニューバーのページリンクをハイライト
const pageLink = document.getElementById("home-link");
pageLink.classList.add("active");

const record = document.getElementById("record");
record.innerText = "記録: " + totalMovement + " m";
