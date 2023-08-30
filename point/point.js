// メニューバーのページリンクをハイライト
const pageLink = document.getElementById("point-link");
pageLink.classList.add("active");

// 記録1メートルにつき1ポイント
const point = document.getElementById("point");
point.innerText = (Math.floor(totalMovement));

const record = document.getElementById("record");
record.innerText = "記録: " + totalMovement + " m";
