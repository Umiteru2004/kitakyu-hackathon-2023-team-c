// メニューバーのページリンクをハイライト
const pageLink = document.getElementById("point-link");
pageLink.classList.add("active");

const point = document.getElementById("point");
point.innerText = (Math.floor(totalMovement));
